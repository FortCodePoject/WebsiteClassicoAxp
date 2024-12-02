<?php

namespace App\Livewire\Site;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DeliveryStatusComponent extends Component
{
    public $deliveries, $id;

    public function render()
    {
        return view('livewire.site.delivery-status-component', [
            "data" => $this->status($this->id)
        ])->extends('layouts.index');
    }

    public function status(){
        $id = Request("id");
        //Acesso a API com um token
        $headers = [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer 2|KLgAGFkyGxcwcMQIg1GAPPPBvR64BwtRxw9oTWsRd9fee9ee",
        ];

        $response = Http::withHeaders($headers)
        ->get("https://kytutes.com/api/deliveries?reference=$id");
        return collect(json_decode($response));
    }
}