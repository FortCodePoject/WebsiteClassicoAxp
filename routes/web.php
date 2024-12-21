<?php

use App\Models\company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

require __DIR__ . "/site.php";
require __DIR__ . "/account/routes.php";
require __DIR__ . "/admin.php";
require __DIR__ . "/SuperAdmin/routes.php";
require __DIR__ . "/subscription/routes.php";

Route::get('/email/verify/{id}/{hash}', function () {
    $auth = Request("id");
    if ($auth != null) {
        $user = User::find($auth);
        Auth::login($user);
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route("admin.index",["id"=>auth()->user()->id]);
    }
})->name('verification.verify');

Route::match(['get', 'post'],"/faturas/xzero", function () {
    //captura das informações do artista
    $dataCompany = company::query()
    ->where("companyhashtoken", "Diolinda2917")
    ->select("token_xzero", "companytokenapi", "companynif")
    ->first();


    //Dados da PB
    $clientPb = \App\Services\Request::getPB("5001048759");

    //Chamada à API para atualizar o status
    $deliveries = \App\Services\Request::verifyDeliveryStatus("ENTREGUE", $dataCompany->companytokenapi);

    if (isset($deliveries) and $deliveries != null) {
    foreach ($deliveries as $delivery) {
    /** Criar items */
    $items = [];
    if (isset($delivery["products"])) {
        foreach ($delivery["products"] as $item) {
            array_push($items, [
                "description" => $item['item'],
                "tax" => 0,
                "price" => (int)$item['price'],
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

        Log::info("message",[$response]);

        }
    }

});
