<?php

namespace App\Livewire\Definition;

use App\Models\Color as ModelsColor;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Color extends Component
{
    public $codigo, $letra;
    use LivewireAlert;

    public function render()
    {
        return view('livewire.definition.color');
    }

    public function storecolor()
    {
        try {
            // Verifica se existe uma cor cadastrada para a empresa autenticada
            $selectColor = ModelsColor::where('company_id', auth()->user()->company->id)->first();

            if ($selectColor) {
                // Atualiza a cor existente
                $selectColor->codigo = $this->codigo;
                $selectColor->letra = $this->letra;
                $selectColor->save();

                $this->alert('success', 'SUCESSO', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => false,
                    'confirmButtonText' => 'OK',
                    'text' => 'Cores Atualizadas'
                ]);
            } else {
                // Cria uma nova cor para a empresa
                $color = new ModelsColor();
                $color->codigo = $this->codigo;
                $color->letra = $this->letra;
                $color->company_id = auth()->user()->company->id;
                $color->save();

                $this->alert('success', 'SUCESSO', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => false,
                    'confirmButtonText' => 'OK',
                    'text' => 'Cores Adicionadas'
                ]);
            }
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

}
