<?php

namespace App\Livewire\Loja;

use App\Models\company;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Deliverystatus extends Component
{
    public $deliveries, $id;

    public function status()
    {
        try {
            $id = Request("id");
            $company = company::where("companyhashtoken", session("companyapi"))->first();
            //Acesso a API com um token
            $headers = [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => $company->companytokenapi,
            ];

            $response = Http::withHeaders($headers)
            ->get("https://kytutes.com/api/deliveries?reference=$id");
            return collect(json_decode($response));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function render()
    {
        return view('livewire.loja.deliverystatus',[
            "data" => $this->status()
        ])->extends('layouts.status');
    }
}
