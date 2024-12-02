<?php

namespace App\Livewire\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyAccount extends Component
{
    public $verification_code;

    protected $rules = [
        'verification_code' => ['required', 'string', 'size:6']
    ];

    public function render()
    {
        return view('livewire.account.verify-account');
    }

    public function verify()
    {
        try {
            $user = Auth::user();

            if ($user->verification_code == $this->verification_code) {
                $user->is_verified = true;
                $user->verification_code = null;
                $user->save();

                $this->alert('success', 'SUCESSO', [
                    'toast'=>false,
                    'position'=>'center',
                    'timer' => '3500',
                    'text'=>'Conta verificada com sucesso!',
                ]);

                return redirect()->route('admin.index');
            }

            return back()->withErrors(['verification_code' => 'Código de verificação inválido.']);
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'timer' => '1500',
                'text'=>'Ocorreu um erro'
            ]);
        }
    }
}
