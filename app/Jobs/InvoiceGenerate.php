<?php

namespace App\Jobs;

use App\Models\company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InvoiceGenerate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            //CAPTURA DAS INFORMAÇÕES DA CONTA DO ARTISTA
            $dataCompany = company::where("companyhashtoken", Cache::get('company_token'))->first();
            //BUSCAR DADOS DA PB VIA API - XZERO
            $clientPb = \App\Services\Request::getPB("5001048759");
            //BUSCAR A EMCOMENDAS VIA API - KYTUTES
            $deliveries = \App\Services\Request::verifyDeliveryStatus("ENTREGUE", $dataCompany->companytokenapi);

            if (isset($deliveries) and $deliveries != null) {
                foreach ($deliveries as $delivery) {
                $reference = $delivery['delivery']['reference'];
                //BUSCAR DADOS DO PARCEIRO LOGISTICO VIA API - XZERO
                //$logisticPartner = \App\Services\Request::getPB($delivery['delivery']['logisticPartner']);
                //ALTERAR ESTADO DAS ENCOMENDAS
                //$changeStatus = \App\Services\Request::changeDeliveryStatus($reference, $dataCompany->companytokenapi);
                /** Criar items */
                 $items = [];
                 if (isset($delivery["products"])) {
                     foreach ($delivery["products"] as $item) {
                        Log::info("Price", [(int)$item['price']]);
                        // Log::info("Price", [str_replace(['.'],[''],$item['price'])]);
                        array_push($items, [
                            "description" => $item['item'],
                            "tax" => 0,
                            "price" => 37000,
                            //"price" => rtrim($item['price'], "."),
                            "quantity" => $item['quantity'],
                            "discount" => 0,
                            "retension" => 0,
                            "productType" => "Unidade",
                            "exemption_code" => "M10",
                        ]);
                    }
                 }
                
                // if (isset($changeStatus["message"])) {
                //if (true) {
                    //EMISSÃO DE FATURA DO ARTISTA PARA PB
                    $artistPb = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $dataCompany->token_xzero,
                    ])->post('http://192.168.100.130:8000/api/invoice/create', [
                        "isBackoffice" => "0",
                        "type" => "FR",
                        "customerName" => $clientPb["Company"],
                        "customerPhone" => $clientPb["Phone"],
                        "taxpayerNumber" => $clientPb["TaxPayer"],
                        "customerEmail" => $clientPb["Email"],
                        "customerAddress" => $clientPb["Address"],
                        "paymentType" => "Transferencia",
                        "items" => $items
                    ])->json();
                    
                    //EMISSÃO DE FATURA DA PB PARA O CLIENTE
                    $pbClient = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer 10|NeK7hEiyZi5boujA1B3nWGSPQgb7Adt3u6EUA0Swd75947f0',
                    ])->post('http://192.168.100.130:8000/api/invoice/create', [
                         "isBackoffice" => "0",
                         "type" => "FR",
                         "customerName" => $delivery['delivery']['client'],
                         "customerPhone" => $delivery['delivery']['phone'],
                         "taxpayerNumber" => $delivery['delivery']['taxPayer'],
                         "customerEmail" => $delivery['delivery']['email'],
                         "customerAddress" => $delivery['delivery']['address'],
                         "paymentType" => $delivery['delivery']['paymentType'],
                         "items" => $items
                    ])->json();
                    
                    // //EMISSÃO DE FACTURA DO PARCEIRO LOGISTICO PARA PB
                    // $logisticPartner = Http::withHeaders([
                    //     'Accept' => 'application/json',
                    //     'Content-Type' => 'application/json',
                    //     'Authorization' => 'Bearer ' . $logisticPartner[""],
                    // ])->post('http://192.168.100.130:8000/api/invoice/create', [
                    //     "isBackoffice" => "0",
                    //     "type" => "FR",
                    //     "customerName" => $clientPb["Company"],
                    //     "customerPhone" => $clientPb["Phone"],
                    //     "taxpayerNumber" => $clientPb["TaxPayer"],
                    //     "customerEmail" => $clientPb["Email"],
                    //     "customerAddress" => $clientPb["Address"],
                    //     "paymentType" => "Transferencia",
                    //     "items" => $items
                    // ])->json();
                //}

                Log::info("CreateInvoive",[$pbClient, $artistPb]);

                }
            }
        } catch (\Throwable $th) {
            Log::info("error catch", [$th->getMessage()]);
        }
    }
}