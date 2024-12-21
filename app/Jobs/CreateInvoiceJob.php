<?php

namespace App\Jobs;

use App\Models\company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CreateInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            //captura das informações do artista
            $dataCompany = company::where("companyhashtoken", "Diolinda2917")->first();

            //Dados da PB
            $clientPb = \App\Services\Request::getPB("5001048759");

            //Chamada à API para atualizar o status
            $deliveries = \App\Services\Request::verifyDeliveryStatus("ENTREGUE", "11|n4DjjV8bSDyaNYRhU30Fz19lpvLkoLsa5EiH0CLga6719c59");
            // $deliveries = \App\Services\Request::verifyDeliveryStatus("ENTREGUE", $dataCompany->companytokenapi);

            if (isset($deliveries) and $deliveries != null) {
            foreach ($deliveries as $delivery) {
            /** Criar items */
            $items = [];
            if (isset($delivery["products"])) {
                foreach ($delivery["products"] as $key => $item) {
                array_push($items, [
                    "description" => $item['item'],
                    "tax" => 0,
                    "price" => (int) $item['price'],
                    "quantity" => $item['quantity'],
                    "discount" => 0,
                    "retension" => 0,
                    "productType" => "Unidade",
                    "exemption_code" => "M10",
                ]);
                }
            }
            
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer 10|NeK7hEiyZi5boujA1B3nWGSPQgb7Adt3u6EUA0Swd75947f0',
                // 'Authorization' => 'Bearer ' . $dataCompany->token_xzero,
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

            Log::info("message",[$response]);

                }
            }
        } catch (\Throwable $th) {
            Log::info("message",[$th->getMessage()]);
        }
    }
}