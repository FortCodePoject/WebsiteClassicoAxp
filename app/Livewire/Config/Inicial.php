<?php

namespace App\Livewire\Config;

use App\Models\Documentation;
use App\Models\hero;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Component;

class Inicial extends Component
{
    public $title,$databout, $description, $image, $hero;
    
    use LivewireAlert, WithFileUploads;

    public function render()
    {
        $this->mount();
        return view('livewire.config.inicial');
    }

    public function loadHeroData($itemId)
    {
        $item = hero::find($itemId);
        $this->title = $item->title;
        $this->description = $item->description;
        $this->image = $item->img;
    }

    public function mount()
    {
        $this->hero = hero::where("company_id", auth()->user()->company->id)->get();
        $this->databout = Documentation::where("panel", "PAINEL DO ADMINISTRADOR")->where("section", "SOBRE")->get();
    }

    public function registerdatas()
    {
        try {
            $data = new hero();
            
            //manipulacao de arquivo;
            if ($this->image != null and !is_string($this->image)) {
                $filaName = rand(2000, 3000) .".".$this->image->getClientOriginalExtension();
                $this->image->storeAs("public/arquivos",$filaName);
            }

            $data->title = $this->title;
            $data->description = $this->description;
            $data->company_id = auth()->user()->company->id;
            $data->img = $filaName;

            $data->save();
            $this->mount();
            
            $this->alert('success', 'SUCESSO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text'=>'Informações Inseridas'
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

    public function updateHero($getId)
    {
        try {
            $data = hero::find($getId);

            //manipulacao de arquivo;
            if ($this->image != null and !is_string($this->image)) {
                $fileName = rand(2000, 3000) .".".$this->image->getClientOriginalExtension();
                $this->image->storeAs("public/arquivos",$fileName);
            }

            $data->title = $this->title;
            $data->description = $this->description;
            $data->img = $fileName ?? $this->image;

            $data->update();
            $this->mount();
            
            $this->alert('success', 'SUCESSO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text'=>'Informações Actualizadas'
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
}