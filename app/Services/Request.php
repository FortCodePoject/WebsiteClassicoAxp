<?php

namespace App\Services;

use App\Models\company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Request{

    /** metodo para verificar estados de encomendas encomendas */
    public static function verifyDeliveryStatus($status, $tokenShopping)
    {
        try {
            // Chamada à API para atualizar o status
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                'Authorization' => 'Bearer ' .$tokenShopping,
            ])->get("https://kytutes.com/api/deliveries", [
                'status' => $status
            ])->json();

            if ($response != null) {
                return $response;
            }
        } catch (\Throwable $th) {
           return response(["Erro"=>"Falha ao realizar operação"],400);
        }
    }

    public static function changeDeliveryStatus($reference, $tokenShopping)
    {
        DB::beginTransaction();
        try {
            // Chamada à API para atualizar o status
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                'Authorization' => 'Bearer ' .$tokenShopping,
            ])->put("https://kytutes.com/api/deliveries?reference=$reference", [
                'switch' => "estado"
            ])->json();

            return $response;
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
           return response(["Erro"=>"Falha ao realizar operação"],400);
     }
    }

    public static function getPb($taxPayer)
    {
        try {
            return Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer 10|NeK7hEiyZi5boujA1B3nWGSPQgb7Adt3u6EUA0Swd75947f0',
            ])->post('http://192.168.100.130:8000/api/company/show', [
                "TaxPayer" => $taxPayer,
            ])->json();
        } catch (\Throwable $th) {

        }
    }
}