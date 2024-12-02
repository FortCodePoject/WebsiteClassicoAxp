<?php

namespace App\Livewire\Config;

use App\Models\contact;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Footer extends Component
{
    public $telefone, $email, $endereco, $atendimento, $rodapeId, $isEditing = false;
    use LivewireAlert;

    // Método para inicializar o componente com dados do usuário autenticado
    public function mount()
    {
        $user = contact::where("company_id", auth()->user()->company_id)->first();
        if ($user) {
            $this->rodapeId = $user->id;
            $this->telefone = $user->telefone;
            $this->email = $user->email;
            $this->endereco = $user->endereco;
            $this->atendimento = $user->atendimento;
        } else {
            // Defina valores padrão caso $user seja null (nenhum contato encontrado)
            $this->rodapeId = null;
            $this->telefone = null;
            $this->email = null;
            $this->endereco = null;
            $this->atendimento = null;
        }
    }

    public function toggleEditMode()
    {
        $this->isEditing = !$this->isEditing;
    }

    public function save()
    {
        try {
            $user = contact::find($this->rodapeId);
            if (!$user) {
                // Cria um novo usuário se não existir
                $user = new contact();

            }

            $user->email = $this->email;
            $user->telefone = $this->telefone;
            $user->atendimento = $this->atendimento;
            $user->endereco = $this->endereco;
            $user->company_id = auth()->user()->company_id;

            $user->save();

            $this->alert('success', 'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Credenciais atualizadas'
            ]);
            
            $this->toggleEditMode(); // Desativa o modo de edição após salvar
        
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text' => 'Falha na operação: ' . $th->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.config.footer');
    }
}