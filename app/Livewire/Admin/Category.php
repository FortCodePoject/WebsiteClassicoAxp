<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\{DB, Http};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Category extends Component
{
    public $company, $description, $idcategory, $editMode = false, $categoryId;
  
    use LivewireAlert;

    public function render()
    {
        return view('livewire.admin.category',
        ['categories' => $this->getCategories()])
        ->layout('layouts.config.app');
    }

    public function getHeaders()
    {
        return [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".auth()->user()->company->companytokenapi,
        ];
    }

    public function getCategories()
    {   
        try { 
            //Chamada a API
            $response =  Http::withHeaders($this->getHeaders())
            ->get("https://kytutes.com/api/categories")->json();

            if ($response != null) {
                return $response;
            }

        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text'=>'Falha ao realizar operação' . $th->getMessage()
            ]);
        }
    }

    public function createCategory()
    {
        DB::beginTransaction();
        try {

            $infoCategory = [
                "description" => $this->description
            ];

            //Chamada a API
            Http::withHeaders($this->getHeaders())
            ->post("https://kytutes.com/api/categories", $infoCategory);

            $this->description = '';
            
            $this->alert('success', 'Cadastrado', 
            [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação' . $th->getMessage()
            ]);
        }
    }

    public function updateCategory($idcategory)
    {
        DB::beginTransaction();
        try {

            $infoCategory = [
                "reference" => $idcategory,
                "description" => $this->description
            ];

            //Chamada a API
            Http::withHeaders($this->getHeaders())
            ->put("https://kytutes.com/api/categories", $infoCategory);

            
            $this->alert('success', 'Cadastrado', 
            [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação' . $th->getMessage()
            ]);
        }
    }

    public function deleteCategory($id)
    {
        DB::beginTransaction();
        try {

            //Chamada a API
            Http::withHeaders($this->getHeaders())
            ->delete("https://kytutes.com/api/categories", ["reference" => $id]);

            
            $this->alert('success', 'Eliminado', 
            [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação' . $th->getMessage()
            ]);
        }
    }
}