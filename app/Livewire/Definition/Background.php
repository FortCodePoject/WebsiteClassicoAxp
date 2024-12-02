<?php

namespace App\Livewire\Definition;

use App\Models\Fundo;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Background extends Component
{
    public $fundo, $image, $type, $fundoId, $currentImage;
    use LivewireAlert;
    use WithFileUploads;
    
    public function mount()
    {
        $this->fundo = Fundo::where("company_id", auth()->user()->company->id)->get();
    }

    public function render()
    {
        return view('livewire.definition.background');
    }

    public function load($id) 
    {
        $background = Fundo::find($id);
        $this->fundoId = $background->id;
        $this->currentImage = $background->image;  // Carrega a imagem atual
        $this->type = $background->tipo;
    }

    public function imagebackgroundstore()
    {
        try {
            // Se fundoId estiver definido, é uma atualização, caso contrário, é uma criação
            if ($this->fundoId) {
                $fundo = Fundo::find($this->fundoId);
            } else {
                $fundo = new Fundo();
                $fundo->company_id = auth()->user()->company->id;
            }

            $fundo->tipo = $this->type;

            // Manipulação de arquivo
            if ($this->image != null && $this->image instanceof \Illuminate\Http\UploadedFile) {
                $fileName = uniqid() . "." . $this->image->getClientOriginalExtension();
                $this->image->storeAs("public/arquivos/background", $fileName);
                $fundo->image = $fileName;
            }

            $fundo->save();
            $this->resetform();
            $this->mount();

            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => $this->fundoId ? 'Imagem Atualizada' : 'Imagem Cadastrada'
            ]);

        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Falha na operação'
            ]);
        }
    }

    public function resetform()
    {
        $this->image = null;
        $this->type = "";
        $this->fundoId = null;
    }
}