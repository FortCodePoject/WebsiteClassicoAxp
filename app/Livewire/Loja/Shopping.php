<?php

namespace App\Livewire\Loja;

use App\Models\company;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;

class Shopping extends Component
{
    public $company, $category, $itemid;
    use LivewireAlert;

    public function mount()
    {
        $this->company = company::where("companyhashtoken", session("companyhashtoken"))->first();
    }

    public function render()
    {
        //dd($this->getItems($this->category));
        return view('livewire.loja.shopping', [
            "categories" => $this->getCategories(),
            "getCollectionsItens" => $this->getItems($this->category),
        ]);
    }

    public function getHeaders()
    {
        return [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->company->companytokenapi,
        ];
    }

    //Pegar todas as categorias 
    public function getCategories()
    {
        try {
            //Chamada a API
            $response = Http::withHeaders($this->getHeaders())
            ->get("https://kytutes.com/api/categories");
    
            return collect(json_decode($response, true));
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text'=>'Falha ao realizar operação'
            ]);
        }
    }
    
    // Pegar os Itens pertencentes à categoria selecionada
    public function getItems($category)
    {
        try {
                $this->category = $category;

                // Define a URL com ou sem a categoria
                $url = $category 
                ? "https://kytutes.com/api/items?category=$category"
                : "https://kytutes.com/api/items";
            
            // Chamada à API
            $response = Http::withHeaders($this->getHeaders())->get($url)->json();

            // Verifica se a resposta foi bem-sucedida antes de processá-la
            if ($response != null) {
                return $response;
            }

        } catch (\Throwable $th) {
            // Mostra um alerta com uma mensagem de erro personalizada
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação: ' . $th->getMessage(),
            ]);
        }
    }

    //adicionar no carrinho
    public function addToCart($itemid)
    {
        try {
            $getItemCart = Http::withHeaders($this->getHeaders())
            ->get("https://kytutes.com/api/items?description=$itemid")
            ->json();

            $itemReference = $getItemCart[0]["reference"];
            
            // Verifica se o item já está no carrinho
            $cartItem = Cart::getContent()->firstWhere('id', $itemReference);

            if ($cartItem && $cartItem->quantity >= 1) {
                $this->alert('info', 'AVISO', [
                    'toast' => false,
                    'position' => 'center',
                    'timer' => '3000',
                    'text' => 'O item ' . $getItemCart[0]["name"] . ' já está no carrinho'
                ]);
                return;
            }
        
            if ($getItemCart != null) {
                # code...
                Cart::add(array(
                    'id' => $getItemCart[0]["reference"],
                    'name' => $getItemCart[0]["name"],
                    'price' => $getItemCart[0]["price"],
                    'quantity' => 1,
                    'attributes' => array(
                        'image' => $getItemCart[0]["image"],
                    )
                ));
            }

            $this->alert('success', 'SUCESSO', [
                'toast'=>false,
                'position'=>'center',
                'timer' => '1500',
                'text'=>'Item '.$getItemCart[0]["name"].', adicionado'
            ]);

        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text'=>'Falha ao realizar operação'
            ]);
        }
    }

    public function locations()
    {
        try {
            return Http::withHeaders($this->getHeaders())
            ->get("https://kytutes.com/api/location/map")
            ->json() ?? [];
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}