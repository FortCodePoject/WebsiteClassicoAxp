<?php

namespace App\Livewire\Loja;

use Livewire\Component;
use App\Models\Company;
use App\Models\VerifyStock;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Shoppingcart extends Component
{
    use LivewireAlert, WithFileUploads;

    // Propriedades do carrinho
    public $cartContent, $qtd = [];
    public $getTotal = 0, $getSubTotal = 0, $getTotalQuantity = 0;
    public $localizacao = 0, $taxapb = 0, $totalFinal = 0;

    // Propriedades de checkout
    public $name, $lastname, $province, $municipality, $street, $phone, $otherPhone, $email;
    public $deliveryPrice = 0, $paymentType = "Trasnferencia", $taxPayer, $receipt, $otherAddress;

    // Propriedades de cupom e localização
    public $code, $cupon;

    protected $listeners = ['refreshCart' => 'refreshCart', 'cartUpdated' => 'refreshCart'];

    public function mount()
    {
        $this->refreshCart();
    }

    public function render()
    {
        return view('livewire.loja.shoppingcart', [
            'locations' => $this->getAllLocations(),
            'verifyQuantity' => $this->productExist(),
        ]);
    }

    // Atualiza os totais do carrinho
    private function updateCartTotals()
    {
        $this->getTotal = CartFacade::getTotal();
        $this->getSubTotal = CartFacade::getSubTotal();
        $this->getTotalQuantity = CartFacade::getTotalQuantity();
        $this->taxapb = ($this->getSubTotal * 14) / 100;
        $this->totalFinal = $this->getSubTotal + $this->taxapb + $this->localizacao;
    }

    // Atualiza o conteúdo do carrinho
    public function refreshCart()
    {
        try {
            $this->cartContent = CartFacade::getContent();
            foreach ($this->cartContent as $key => $item) {
                $this->qtd[$key] = $item->quantity;
            }
            $this->updateCartTotals();
        } catch (\Throwable $th) {
            $this->alert('error', 'Erro ao carregar o carrinho.');
        }
    }

    // Atualiza a quantidade de um item
    public function updateQuantity($name, $id)
    {
        try {
            $item = Http::withHeaders($this->getHeaders())
                ->get("https://kytutes.com/api/items?description=$name")
                ->json();

            if ($item) {
                CartFacade::update($id, [
                    'quantity' => ['relative' => false, 'value' => $this->qtd[$id]],
                ]);
            }
            $this->refreshCart();
        } catch (\Throwable $th) {
            $this->alert('error', 'Erro ao atualizar a quantidade.');
        }
    }

    // Remove um item do carrinho
    public function remove($id)
    {
        try {
            CartFacade::remove($id);
            $this->refreshCart();
            $this->alert('success', 'Item removido com sucesso.');
        } catch (\Throwable $th) {
            $this->alert('error', 'Erro ao remover o item.');
        }
    }

    // Aplica um cupom de desconto
    public function applyCoupon()
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post("https://kytutes.com/api/cupons", [
                    'code' => $this->code,
                    'total' => $this->totalFinal,
                ])->json();

            if (isset($response['discount'])) {
                session()->put('discountvalue', $response['discount']);
                $this->code = "";
                $this->alert('success', 'Cupom aplicado com sucesso!');
                $this->refreshCart();
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'Erro ao aplicar o cupom.');
        }
    }

    // Finaliza o checkout
    public function checkout()
    {
        try {
            $items = $this->cartContent->map(function ($item) {
                return [
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                ];
            })->toArray();

            $data = [
                'clientName' => $this->name,
                'clientLastName' => $this->lastname,
                'province' => $this->province,
                'municipality' => $this->municipality,
                'street' => $this->street,
                'phone' => $this->phone,
                'email' => $this->email,
                'paymentType' => $this->paymentType,
                'items' => $items,
            ];

            $response = Http::withHeaders($this->getHeaders())
                ->post('https://kytutes.com/api/deliveries', $data)
                ->json();

            if ($response) {
                session()->put('idDelivery', $response['reference']);
                $this->alert('success', 'Pedido realizado com sucesso!');
                return redirect()->route('site.delivery.status', $response['reference']);
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'Erro ao finalizar o pedido.');
        }
    }

    // Obtém o cabeçalho para requisições HTTP
    private function getHeaders()
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getCompany()->companytokenapi,
        ];
    }

    // Obtém a empresa do token de sessão
    private function getCompany()
    {
        return Company::where('companyhashtoken', session('companyhashtoken'))->first();
    }

    // Obtém todas as localizações
    public function getAllLocations()
    {
        try {
            return Http::withHeaders($this->getHeaders())
                ->get('https://kytutes.com/api/locations')
                ->json();
        } catch (\Throwable $th) {
            return [];
        }
    }

    // Verifica se o produto existe
    public function productExist()
    {
        try {
            return VerifyStock::where('company_id', $this->getCompany()->id)
                ->where('ipaddress', $_SERVER['REMOTE_ADDR'])
                ->where('status', 1)
                ->count();
        } catch (\Throwable $th) {
            return 0;
        }
    }
}
