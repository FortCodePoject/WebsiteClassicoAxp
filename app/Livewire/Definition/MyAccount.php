<?php

namespace App\Livewire\Definition;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MyAccount extends Component
{
    public $name, $email, $password, $userId;
    public $isEditing = false; // Variável de estado para controle de edição

    use LivewireAlert;

    // Método para inicializar o componente com dados do usuário autenticado
    public function mount()
    {
        $user = auth()->user(); // Obtém o usuário autenticado
        $this->userId = $user->id; // Armazena o ID do usuário
        $this->name = $user->name; // Inicializa o nome
        $this->email = $user->email; // Inicializa o email
    }

    public function render()
    {
        return view('livewire.definition.my-account');
    }

    public function toggleEditMode()
    {
        $this->isEditing = !$this->isEditing; // Alterna o modo de edição
    }

    public function saveProfile()
    {
        
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'password' => 'nullable|string',
        ]);

        try {
            $user = User::find($this->userId);
            if (!$user) {
                // Cria um novo usuário se não existir
                $user = new User();
            }

            $user->name = $this->name;
            $user->email = $this->email;

            // Atualiza a senha apenas se fornecida
            if ($this->password) {
                $user->password = bcrypt($this->password);
            }

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
}
