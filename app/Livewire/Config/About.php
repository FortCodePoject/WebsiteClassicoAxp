<?php

namespace App\Livewire\Config;

use App\Models\About as ModelsAbout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class About extends Component
{
    public $getAbout, $nome, $perfil, $p1, $p2, $itemId;
    public $editMode = false;
    use WithFileUploads;
    use LivewireAlert;

    public function mount()
    {
        $getAbout = ModelsAbout::where("company_id", auth()->user()->company_id)->first();
        if ($getAbout) {
            $this->itemId = $getAbout->id;
            $this->nome = $getAbout->nome;
            $this->perfil = $getAbout->perfil;
            $this->p1 = $getAbout->p1;
            $this->p2 = $getAbout->p2;
        } else {
            // Defina valores padrão caso $user seja null (nenhum contato encontrado)
            $this->itemId = null;
            $this->nome = null;
            $this->perfil = null;
            $this->p1 = null;
            $this->p2 = null;
        }
    }

    public function toggleEditMode()
    {
        $this->editMode = !$this->editMode;
    }

    public function save()
    {
        try {
            $getAbout = ModelsAbout::find($this->itemId);
            if (!$getAbout) {
                $getAbout = new ModelsAbout();
            }

            $getAbout->nome = $this->nome;
            $getAbout->perfil = $this->perfil;
            $getAbout->p1 = $this->p1;
            $getAbout->p2 = $this->p2;
            $getAbout->company_id = auth()->user()->company_id;

            $getAbout->save();

            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Informação Criada'
            ]);
            
            $this->toggleEditMode();
        
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Falha na operação: '
            ]);
        }
    }

    // public function storeAbout()
    // {
    //     try {
    //         $this->validate([
    //             'nome' => 'required',
    //             'perfil' => 'required',
    //             'p1' => 'required',
    //             'p2' => 'required',
    //         ]);
    
    //         ModelsAbout::create([
    //             'nome' => $this->nome,
    //             'perfil' => $this->perfil,
    //             'p1' => $this->p1,
    //             'p2' => $this->p2,
    //             'company_id' => auth()->user()->company_id
    //         ]);
    
    //         $this->resetFields();
    //         $this->mount(); // Atualiza a lista
    
    //         $this->alert('success', 'SUCESSO', [
    //             'toast'=>false,
    //             'position'=>'center',
    //             'showConfirmButton' => false,
    //             'confirmButtonText' => 'OK',
    //             'text'=>'Informações Inseridas'
    //         ]);
    //         $this->toggleEditMode();

    //     } catch (\Throwable $th) {
    //         $this->alert('error', 'ERRO
    //         ', [
    //             'toast'=>false,
    //             'position'=>'center',
    //             'showConfirmButton' => false,
    //             'confirmButtonText' => 'OK',
    //             'text'=>'Falha na Operação'
    //         ]);
    //     }
    // }

    // public function editAbout($id)
    // {
    //     $about = ModelsAbout::findOrFail($id);
    //     $this->itemId = $about->id;
    //     $this->nome = $about->nome;
    //     $this->perfil = $about->perfil;
    //     $this->p1 = $about->p1;
    //     $this->p2 = $about->p2;
    //     $this->editMode = true;
    // }

    // public function updateAbout()
    // {
    //     try {
    //         $this->validate([
    //             'nome' => 'required',
    //             'perfil' => 'required',
    //             'p1' => 'required',
    //             'p2' => 'required',
    //         ]);
    
    //         $about = ModelsAbout::findOrFail($this->itemId);
    //         $about->update([
    //             'nome' => $this->nome,
    //             'perfil' => $this->perfil,
    //             'p1' => $this->p1,
    //             'p2' => $this->p2,
    //         ]);
    
    //         $this->alert('success', 'SUCESSO', [
    //             'toast'=>false,
    //             'position'=>'center',
    //             'showConfirmButton' => false,
    //             'confirmButtonText' => 'OK',
    //             'text'=>'Sobre Actualizado'
    //         ]);
    
    //         $this->resetFields();
    //         $this->mount(); // Atualiza a lista
    //         $this->editMode = false;
    //     } catch (\Throwable $th) {
    //         $this->alert('error', 'ERRO
    //         ', [
    //             'toast'=>false,
    //             'position'=>'center',
    //             'showConfirmButton' => false,
    //             'confirmButtonText' => 'OK',
    //             'text'=>'Falha na operação'
    //         ]);
    //     }
    // }

    public function deleteAbout($id)
    {
        ModelsAbout::destroy($id);
        $this->mount(); // Atualiza a lista
    }

    // public function resetFields()
    // {
    //     $this->nome = '';
    //     $this->perfil = '';
    //     $this->p1 = '';
    //     $this->p2 = '';
    //     $this->editMode = false;
    // }

    public function render()
    {
        return view('livewire.config.about');
    }
}