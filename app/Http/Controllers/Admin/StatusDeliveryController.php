<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StatusDeliveryController extends Controller
{
    public function index()
    {
        $itensColletions = collect();
        $id = request('codereference');
        // Check for search input
        if ($id) {

            $headers = [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "Bearer 2|KLgAGFkyGxcwcMQIg1GAPPPBvR64BwtRxw9oTWsRd9fee9ee",
            ];
            
            //Chamada a API
            $response = Http::withHeaders($headers)
            ->get("https://kytutes.com/api/deliveries?reference=$id");

            $itensColletions = collect(json_decode($response));
        } else {
            $itensColletions = collect();
        }

        return view("sbadmin.shooping.status.app",
            compact("itensColletions") 
        );
    }
}
