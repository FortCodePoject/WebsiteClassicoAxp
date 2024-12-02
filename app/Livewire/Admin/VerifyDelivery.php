<?php

namespace App\Livewire\Admin;

use App\Models\VerifyStock;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class VerifyDelivery extends Component
{
    use LivewireAlert;
    public $stockDelivery = [], $qtd= [], $status = [];

    public function mount()
    {
        $this->stockDelivery = [];
        $this->stockDelivery = VerifyStock::where("company_id", auth()->user()->company_id)
        ->select("id","product", "price", "availableQuantity", "availablePrice", "quantity", "status")
        ->where("isverifyed", 0)
        ->get();
    }

    public function render()
    {
        $this->mount();
        return view('livewire.admin.verify-delivery')->layout('layouts.config.app');
    }

    public function alterStatus()
    {
        try {
        
           if (isset($this->qtd) and count($this->qtd) > 0) {
            foreach ($this->qtd as $key => $value) {
               $finded =  VerifyStock::find($key);
               if ($finded != null) {
                    if ($this->status[$key] == 1 and $this->qtd[$key] != null) {
                      $finded->quantity = $this->qtd[$key];
                      $finded->status = $this->status[$key];
                      $finded->save();
                    }
               }
            }
           }

           $isverifyed = VerifyStock::where("company_id", auth()->user()->company_id)->get();
           if (isset($isverifyed) and count($isverifyed) > 0) {
            # code...
            foreach ($isverifyed as $key => $value) {
               $value->isverifyed = 1;
               $value->save();
            }
           }

           $this->mount();
           
            $this->alert('success', 'Verificado', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Produto Verificado com sucesso!'
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}