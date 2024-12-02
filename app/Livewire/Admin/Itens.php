<?php
namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Itens extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $cost, $description, $longdescription, $price,$imagePath,
    $image, $category_id, $qtd, $editing = false, $getItens = [],
    $itemId;

    protected $listeners = ['refreshItems' => 'getItens'];

    public function render()
    {
        $this->getItens = $this->getItens();
        return view('livewire.admin.itens', ["categories" => $this->getCategories()])
        ->layout('layouts.config.app');
    }

    public function getToken()
    {
        return [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . auth()->user()->company->companytokenapi
        ];
    }

    public function getItens()
    {
        try {
            $response = Http::withHeaders($this->getToken())
                ->get("https://kytutes.com/api/items")->json();

            if ($response != null) {
                return $response;
            } else {
                $this->alert('error', 'ERRO', [
                    'text' => ' Conexão Internet Instavel',
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK'
                ]);
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação. Por favor, tente novamente.'
            ]);
        }
    }

    public function getCategories()
    {
        try {
            $response = Http::withHeaders($this->getToken())
                ->get("https://kytutes.com/api/categories")->json();

            if ($response != null) {
                return $response;
            } else {
                $this->alert('error', 'Erro ao carregar categorias!', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK',
                ]);
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação. Por favor, tente novamente.'
            ]);
        }
    }

    public function createItem()
    {
        DB::beginTransaction();
        try {
            //manipulacao de arquivo;
            if ($this->image != null and !is_string($this->image)) {
                $filaName = rand(2000, 3000) .".".$this->image->getClientOriginalExtension();
                $this->image->storeAs("public/items",$filaName);
            }

            $infoItem = [
                "iva" => 0,
                "cost" => $this->cost ?? 0,
                "price" => $this->price,
                "quantity" => $this->qtd,
                "description" => $this->description,
                "category" => $this->category_id,
                "longDescription" => $this->longdescription,
                "image" => $filaName
            ];

            $response = Http::withHeaders($this->getToken())
                ->post("https://kytutes.com/api/items", $infoItem)->json();

            if ($response != null) {
                $this->resetForm();
                $this->editing = false;

                $this->alert('success', 'Item Cadastrado!', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => false,
                    'confirmButtonText' => 'OK',
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação. Por favor, tente novamente.'
            ]);
        }
    }

    public function editItem($id)
    {
        // Filtra o item na lista de dados vindos da API
        $existingItem = collect($this->getItens())->firstWhere('reference', $id);

        if ($existingItem) {
            // Carrega os dados do item no formulário
            $this->itemId = $existingItem['reference'];
            $this->description = $existingItem['description'];
            $this->price = $existingItem['price'];
            $this->qtd = $existingItem['quantity'];
            $this->category_id = $existingItem['category'];
            $this->image = null; // Resetar imagem, pois não é carregada diretamente da API
            $this->editing = true;
        } else {
            $this->alert('error', 'Item não encontrado!', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
            ]);
        }
    }

    public function deleteItem($getId)
    {
        try {
            $response = Http::withHeaders($this->getToken())
            ->delete("https://kytutes.com/api/items", ["reference" => $getId])->json();

            if ($response != null) {
                $this->alert('success', 'Item Eliminado', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => false,
                    'confirmButtonText' => 'OK',
                ]);
            }

        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação. Por favor, tente novamente.'
            ]);
        }
    }

    public function resetForm()
    {
        $this->price = "";
        $this->qtd = "";
        $this->description = "";
        $this->category_id = "";
        $this->longdescription = "";
        $this->image = null;
    }

    public function updateItem()
    {
        try {
            $fileName = null;
            if ($this->image !== null && !is_string($this->image)) {
                $fileName = rand(2000, 3000) . "." . $this->image->getClientOriginalExtension();
                $this->image->storeAs("public/items", $fileName);
            }            

            $infoItem = [
                "id" => $this->itemId,
                "iva" => 0,
                "cost" => $this->cost ?? 0,
                "price" => $this->price,
                "quantity" => $this->qtd,
                "description" => $this->description,
                "category" => $this->category_id,
                "longDescription" => $this->longdescription,
                "image" => $fileName
            ];

            $response = Http::withHeaders($this->getToken())
                ->put("https://kytutes.com/api/items", $infoItem)->json();

                if ($response != null) {
                    # code...
                    dd($response);

                    $this->alert('success', 'Item Cadastrado!', [
                        'toast' => false,
                        'position' => 'center',
                        'showConfirmButton' => false,
                        'confirmButtonText' => 'OK',
                    ]);
                }

        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO!', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
            ]);
        }
    }
}