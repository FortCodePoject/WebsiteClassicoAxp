<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PortalPbCOntroller extends Controller
{
    public function index()
    {
        $headers = [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer 2|KLgAGFkyGxcwcMQIg1GAPPPBvR64BwtRxw9oTWsRd9fee9ee",
        ];

        $response = Http::withHeaders($headers)
        ->get("https://kytutes.com/api/items");

        $data = collect(json_decode($response, true));
        return view("sbadmin.shooping.portalpb.App",compact("data"));
    }
}