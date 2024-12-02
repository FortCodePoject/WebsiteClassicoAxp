<?php

namespace App\Livewire\Loja;

use App\Mail\SendEmail;
use Livewire\Component;
use App\Models\Company;
use App\Models\VerifyStock;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Shoppingcart extends Component
{
    use LivewireAlert, WithFileUploads;

    // Propriedades Gerais
    public $cartContent, $qtd = [], $code, $localizacao = 0;

    // Propriedades de Checkout
    public $name, $lastname, $province, $municipality, $street, $phone, $otherPhone, $email,
        $paymentType = "Transferencia", $taxPayer, $receipt, $otherAddress;

    protected $listeners = ["refreshCart" => "refreshCart"];

    // Computed Properties
    public function getFinalCompraProperty()
    {
        return $this->getSubTotal + $this->localizacao;
    }

    public function getTaxapbProperty()
    {
        return ($this->finalCompra * 14) / 100;
    }

    public function getTotalFinalProperty()
    {
        return $this->finalCompra + $this->taxapb;
    }

    public function getGetTotalProperty()
    {
        return CartFacade::getTotal();
    }

    public function getGetSubTotalProperty()
    {
        return CartFacade::getSubTotal();
    }

    public function getGetTotalQuantityProperty()
    {
        return CartFacade::getTotalQuantity();
    }

    public function mount()
    {
        $this->cartContent = CartFacade::getContent();
        $this->qtd = $this->cartContent->mapWithKeys(fn($item) => [$item->id => $item->quantity])->toArray();
    }

    public function render()
    {
        return view('livewire.loja.shoppingcart', [
            'locationMap' => $this->getAllLocations(),
            'verifyQuantity' => $this->productExist(),
        ]);
    }

    public function refreshCart()
    {
        $this->mount();
    }

    public function productExist()
    {
        return VerifyStock::where("company_id", $this->getCompany()->id)
            ->where("ipaddress", $_SERVER['REMOTE_ADDR'])
            ->where("status", 1)
            ->count();
    }

    public function getHeaders()
    {
        return [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $this->getCompany()->companytokenapi,
        ];
    }

    public function getCompany()
    {
        return Company::where("companyhashtoken", session("companyhashtoken"))->first();
    }

    public function uploadReceipt()
    {
        if ($this->receipt && !is_string($this->receipt)) {
            $filename = md5($this->receipt->getClientOriginalName()) . '.' . $this->receipt->getClientOriginalExtension();
            $this->receipt->storeAs('public/recibos', $filename);
            return $filename;
        }
        return null;
    }

    public function checkout()
    {
        try {
            $filaName = $this->uploadReceipt();
            $items = $this->cartContent->map(fn($item) => [
                "name" => $item->name,
                "price" => $item->price,
                "quantity" => $item->quantity,
            ])->toArray();

            $data = [
                "clientName" => $this->name,
                "clientLastName" => $this->lastname,
                "province" => $this->province,
                "municipality" => $this->municipality,
                "street" => $this->street,
                "deliveryPrice" => $this->localizacao,
                "phone" => $this->phone,
                "otherPhone" => $this->otherPhone,
                "email" => $this->email,
                "taxPayer" => $this->taxPayer,
                "receipt" => $filaName,
                "paymentType" => $this->paymentType,
                "items" => $items,
            ];

            $response = Http::withHeaders($this->getHeaders())
                ->post("https://kytutes.com/api/deliveries", $data)
                ->json();

            session()->put("idDelivery", $response['reference']);
            session()->put("companyapi", $this->getCompany()->companyhashtoken);

            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'text' => 'Encomenda Finalizada',
            ]);

            return redirect()->route("site.delivery.status", [$response['reference']]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Erro ao finalizar compra', [
                'toast' => false,
                'position' => 'center',
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function updateQuantity($id)
    {
        try {
            $item = CartFacade::get($id);
            if ($item) {
                CartFacade::update($id, ['quantity' => $this->qtd[$id]]);
                $this->emit('refreshCart');
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'Erro ao atualizar quantidade');
        }
    }

    public function remove($id)
    {
        try {
            CartFacade::remove($id);
            $this->emit('refreshCart');
            $this->alert('success', 'Item removido com sucesso');
        } catch (\Throwable $th) {
            $this->alert('error', 'Erro ao remover item');
        }
    }

    public function getAllLocations()
    {
        try {
            return Http::withHeaders([
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "Bearer 11|n4DjjV8bSDyaNYRhU30Fz19lpvLkoLsa5EiH0CLga6719c59",
            ])->get("https://kytutes.com/api/location/map")->json();
        } catch (\Throwable $th) {
            return [];
        }
    }
}
