<?php

namespace App\Livewire\Config;

use App\Models\Service as ModelsService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Service extends Component
{
    public $getService, $title, $description,$editMode = false, $serviceId;
    use LivewireAlert;

    public function mount()
    {
        $this->getService = ModelsService::where("company_id", auth()->user()->company_id)->get(); // Carrega os serviços do banco
    }

    public function storeService()
    {
        try {
            $this->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
    
            ModelsService::create([
                'title' => $this->title,
                'description' => $this->description,
                "company_id" => auth()->user()->company_id,
            ]);
    
            $this->resetFields();
            $this->mount(); // Atualiza a lista de serviços
            
            $this->alert('success', 
                'CADASTRADO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
            ]);

        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text'=>'Falha na operação'
            ]);
        }
    }

    public function editService($id)
    {
        $service = ModelsService::findOrFail($id);
        $this->serviceId = $service->id;
        $this->title = $service->title;
        $this->description = $service->description;
        $this->editMode = true;
    }

    public function updateService()
    {
        try {
            $this->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
    
            $service = ModelsService::find($this->serviceId);
            $service->update([
                'title' => $this->title,
                'description' => $this->description,
            ]);
    
            $this->resetFields();
            $this->mount(); // Atualiza a lista de serviços
            $this->alert('success', 
                'CADASTRADO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
            ]);
            $this->editMode = false;
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text'=>'Falha na operação'
            ]);
        }
    }

    public function deleteService($id)
    {
        ModelsService::destroy($id);
        $this->mount(); // Atualiza a lista de serviços
    }

    public function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->editMode = false;
    }

    public function render()
    {
        return view('livewire.config.service');
    }
}