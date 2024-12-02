<?php

namespace App\Livewire\Config;

use App\Models\Habilidade;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Competence extends Component
{
    public $habilityId, $hability, $level, $gethability;
    use LivewireAlert;

    public function mount() {
        $this->gethability = Habilidade::where("company_id", auth()->user()->company->id)->get();
    }

    public function habilityCriar() {
        try {
            if ($this->habilityId) {
                // Atualizar
                $hability = Habilidade::find($this->habilityId);
                $hability->update(['hability' => $this->hability, 'level' => $this->level]);
    
                $this->alert('success', 'SUCESSO', [
                    'toast'=>false,
                    'position'=>'center',
                    'showConfirmButton' => false,
                    'confirmButtonText' => 'OK',
                    'text'=>'Habilidade Actualizada'
                ]);
    
            } else {
                // Adicionar
                Habilidade::create([
                    'hability' => $this->hability, 
                    'level' => $this->level, 
                    'company_id' => auth()->user()->company_id
                ]);
    
                $this->alert('success', 'SUCESSO', [
                    'toast'=>false,
                    'position'=>'center',
                    'showConfirmButton' => false,
                    'confirmButtonText' => 'OK',
                    'text'=>'Habilidade Cadastrada'
                ]);
            }
    
            // Limpar os campos
            $this->reset(['habilityId', 'hability', 'level']);
            $this->gethability = Habilidade::where("company_id", auth()->user()->company->id)->get();
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

    public function editHability($id) {
        $hability = Habilidade::find($id);
        $this->habilityId = $hability->id;
        $this->hability = $hability->hability;
        $this->level = $hability->level;
    }

    public function deleteHability($id) {
        Habilidade::destroy($id);
        $this->gethability = Habilidade::where("company_id", auth()->user()->company->id)->get();
        $this->alert('success', 'SUCESSO', [
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
            'confirmButtonText' => 'OK',
            'text'=>'Habilidade Eliminada'
        ]);
    }

    public function render()
    {
        return view('livewire.config.competence');
    }

}