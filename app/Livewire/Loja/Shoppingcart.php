<?php

namespace App\Livewire\Loja;

use App\Mail\SendEmail;
use Livewire\Component;
use App\Models\company;
use App\Models\VerifyStock;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Shoppingcart extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $number = 0, $localizacao, $cartContent, $getTotal, $getSubTotal,
        $getTotalQuantity, $location, $cupon, $taxapb = 0, $finalCompra,
        $totalFinal = 0, $code, $delveryId,$qtd = [];

    //propriedades de checkout
    public $name, $lastname, $province, $municipality, $street, $phone, $otherPhone,
        $email, $deliveryPrice = 0, $paymentType = "Trasnferencia",  $taxPayer, $receipt, $otherAddress;
    public $company;

    protected $listeners = ["updatecart" => "updatecart", "isVerifyed" => "isVerifyed", "refresh" => "refresh", "refreshCart" => "refreshCart"];

    public function mount()
    {
        try {

            if (count(CartFacade::getContent()) > 0) {
                foreach (CartFacade::getContent() as $key => $value) {
                    $this->qtd[$key] = $value->quantity;
                }
            }

            $this->getTotal = CartFacade::getTotal();
            $this->getSubTotal = CartFacade::getSubTotal();
            $this->getTotalQuantity = CartFacade::getTotalQuantity();
            $this->finalCompra = $this->getSubTotal + $this->localizacao;
            $this->taxapb = ($this->finalCompra * 14) / 100;
            $this->totalFinal = $this->finalCompra + $this->taxapb;
            $this->cartContent = CartFacade::getContent();
          
        } catch (\Throwable $th) {
        }
    }

    public function refreshCart()
    {
        $this->mount();
    }
    
    public function render()
    {
        $this->mount();
        return view('livewire.loja.shoppingcart', [
            'locationMap' => $this->getAllLocations(),
            'verifyQuantity'=>$this->productExist() 
        ]);
    }


    public function productExist()
    {
        try {
            return VerifyStock::where("company_id", $this->getCompany()->id)
            ->where("ipaddress",  $_SERVER['REMOTE_ADDR'])
            ->where("status", 1)->count();

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getHeaders()
    {
        return [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->getCompany()->companytokenapi,
        ];
    }

    public function getCompany()
    {
        return company::where("companyhashtoken", session("companyhashtoken"))->first();
    }

    //logica para aplicar cupon de desconto
    public function cuponDiscount()
    {
        //Acesso a API com um token        
        $response = Http::withHeaders($this->getHeaders())
            ->post("https://kytutes.com/api/cupons", [
                "code" => $this->code,
                "total" => $this->totalFinal,
            ]);
        $cupon = collect(json_decode($response));

        if (isset($cupon['discount'])) {
            session()->put('discountvalue', $cupon['discount']);
            $this->code = "";
        }
    }

    public function checkout($company)
    {
        try {
            //manipulacao de arquivo;
            $filaName = null;
            if ($this->receipt != null and !is_string($this->receipt)) {
                $filaName = md5($this->receipt->getClientOriginalName())
                    . "." . $this->receipt->getClientOriginalExtension();
                $this->receipt->storeAs("public/recibos", $filaName);
            }

            //Acesso a API com um token
            $items = [];
            if (count(CartFacade::getContent()) > 0) {
                foreach (CartFacade::getContent() as $key => $item) {
                    array_push($items, [
                        "name" => $item->name,
                        "price" => $item->price,
                        "quantity" => $item->quantity,
                    ]);
                }
            }

            $data = [
                "clientName" => $this->name,
                "clientLastName" => $this->lastname,
                "province" => $this->province,
                "municipality" => $this->municipality,
                "street" => $this->street,
                "cupon" => "",
                "deliveryPrice" => 0,
                "phone" => $this->phone,
                "otherPhone" => $this->otherPhone,
                "email" => $this->email,
                "taxPayer" => $this->taxPayer,
                "receipt" => $filaName,
                "paymentType" => $this->paymentType,
                "items" => $items,
            ];

            //Chamada a API
            $response = Http::withHeaders($this->getHeaders())
                ->post("https://kytutes.com/api/deliveries", $data);

            $result  = collect(json_decode($response, true));

            if ($result) {
                session()->put("idDelivery", $result['reference']);
                session()->put("companyapi", $this->getCompany()->companyhashtoken);
            }

            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Encomenda Finalizada'
            ]);

            return redirect()->route("site.delivery.status", [
                $result['reference']
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação ' . $th->getMessage()
            ]);
        }
    }

    public function remove($id)
    {
        try {
            $itenDelete = CartFacade::remove($id);
            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'timer' => '1500',
                'text' => 'Item Eliminado'
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação '
            ]);
        }
    }


    public function updateQuantity($name,$id)
    {
        try {
                     
            CartFacade::remove($id);
            $getItemCart = Http::withHeaders($this->getHeaders())
            ->get("https://kytutes.com/api/items?description=$name")
            ->json();
        
            if ($getItemCart != null) {
               
                # code...
                CartFacade::add(array(
                    'id' => $getItemCart[0]["reference"],
                    'name' => $getItemCart[0]["name"],
                    'price' => $getItemCart[0]["price"],
                    'quantity' => $this->qtd[$id],
                    'attributes' => array(
                        'image' => $getItemCart[0]["image"],
                    )
                ));
            }
            $this->dispatch("refresh");
            
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação '
            ]);
        }
    }

    public function createFacturaXzero()
    {
        try {
            //Acesso a API com um token
            $items = [];

            //code...
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ',
            ])->post('https://xzero.ao/api/invoice/create', [

                "isBackoffice" => '0',
                "type" => 'FR',
                "customerName" => $this->name,
                "customerPhone" => $this->phone,
                "taxpayerNumber" => $this->taxPayer,
                "customerEmail" => $this->email,
                "customerAddress" => $this->province ?? "Luanda,Angola",
                "paymentType" => $this->paymentType ?? '',
                "items" => $items

            ])->json();

            return $response;
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação '
            ]);
        }
    }

    public function getAllLocations()
    {
        try {

            $response = Http::withHeaders([
                    "Accept" => "application/json",
                    "Content-Type" => "application/json",
                    "Authorization" => "Bearer 11|n4DjjV8bSDyaNYRhU30Fz19lpvLkoLsa5EiH0CLga6719c59",
                ])
                ->get("https://kytutes.com/api/location/map")->json();

            if ($response != null) {
                return $response;
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação '
            ]);
        }
    }

    public function selectLocation($customerLocation)
    {

        $company = Company::where("companyhashtoken", session("companyhashtoken"))
        ->select("companytokenapi")
        ->first();
       
        $this->localizacao = 0;
        try {

                //Chamada a API
                $response =  Http::withHeaders(
                    [
                        "Accept" => "application/json",
                        "Content-Type" => "application/json",
                        "Authorization" => "Bearer ". $company->companytokenapi,
                    ]
                )
                ->get("https://kytutes.com/api/company",[
                    "token"=>$company->companytokenapi
                ])->json()['data'];
            
                if ($response != null) {
                   
                     $result = Http::withHeaders([
                         "Accept" => "application/json",
                         "Content-Type" => "application/json",
                         "Authorization" => "Bearer ".$company->companytokenapi,
                     ])->get("https://kytutes.com/api/location/price",[
                        "customerLocation"=>$customerLocation, 
                        "storeLocation"=>$response[0]["zone"], 
                     ])->json();

                   $this->localizacao = $result["price"];
                   $this->mount();
                   $this->dispatch("refreshCart");
                }
            
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação '
            ]);
        }
    }

    public function verifyStockWithProvider()
    {
        try {
            $company = Company::where("companyhashtoken", session("companyhashtoken"))
                ->select("id", "companyemail")
                ->first();

            if ($company) {
                if (count(CartFacade::getContent()) > 0) {
                    foreach (CartFacade::getContent() as $key => $item) {
                        # Adicionar items para verificação de existencia com Artista
                        VerifyStock::create([
                            "product" => $item->name,
                            "price" => $item->price,
                            "quantity" => $item->quantity,
                            "ipaddress" => $_SERVER['REMOTE_ADDR'],
                            "company_id" => $company->id,
                            "image" => $item->attributes["image"] ?? Null,
                        ]);
                    }

                    Mail::to($company->companyemail)->send(new SendEmail(null));
                }
            }

            $this->dispatch("isVerifyed");
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    /** 
     * VERIFICAR SE O ARTISTA CONFIRMOU A EXISTENCIA DOS QUADROS
     */

    public function isProductVerifyed()
    {
        try {
            $company = Company::where("companyhashtoken", session("companyhashtoken"))
                ->select("id")
                ->first();

            if ($company) {
                $data =  VerifyStock::where("ipaddress", $_SERVER['REMOTE_ADDR'])
                    ->where("company_id", $company->id)
                    ->where("status", 1)
                    ->count();

                if ($data <= 0) {
                    return 0;
                }
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    public function clearProduct()
    {
        try {
            $company = Company::where("companyhashtoken", session("companyhashtoken"))
                ->select("id")
                ->first();

            if ($company) {
                  VerifyStock::where("ipaddress", $_SERVER['REMOTE_ADDR'])
                    ->where("company_id", $company->id)
                    ->delete();
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação'
            ]);
        }
    }

    public function Verifyed()
    {
          try {
        CartFacade::clear();

        $company = Company::where("companyhashtoken", session("companyhashtoken"))
            ->select("id")
            ->first();

        if ($company) {
            $data =  VerifyStock::where("ipaddress", $_SERVER['REMOTE_ADDR'])
                ->where("company_id", $company->id)
                ->where("status", 1)
                ->get();

            if ($data->count() > 0) {

                foreach ($data as $key => $value) {
                    CartFacade::add(array(
                        'id' => $value->id,
                        'name' => $value->product,
                        'price' => ($value->availablePrice != null) ? $value->availablePrice : $value->price,
                        'quantity' => ($value->availableQuantity != null) ? $value->availableQuantity : $value->quantity,
                        'attributes' => array(
                            'image' => $value->image ?? "",
                        )
                    ));
                }

              
            }
        }

          } catch (\Throwable $th) {
              $this->alert('error', 'ERRO', [
                  'toast' => false,
                  'position' => 'center',
                  'showConfirmButton' => true,
                  'confirmButtonText' => 'OK',
                  'text' => 'Falha ao realizar operação'
              ]);
          }
    }
}
