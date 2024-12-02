<?php

namespace App\Livewire\Config;

use App\Models\Skill;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Componente extends Component
{
    public $elements, $getComponents, $level, $selectedComponentId = null;
    use LivewireAlert;

    public function mount()
    {
        $this->getComponents = Skill::where("company_id", auth()->user()->company_id);
    }

    public function storeOrUpdateComponent()
    {
        try {
            if ($this->selectedComponentId) {
                // Atualiza o componente existente
                $component = Skill::find($this->selectedComponentId);
                $component->update([
                    'elements' => $this->elements,
                    'level' => $this->level,
                ]);
    
                $this->alert('success', 'SUCESSO', [
                    'toast'=>false,
                    'position'=>'center',
                    'showConfirmButton' => false,
                    'confirmButtonText' => 'OK',
                    'text'=>'Elemento Actualizada'
                ]);
            } else {
                // Cria um novo componente
                Skill::create([
                    'elements' => $this->elements,
                    'level' => $this->level,
                    'company_id' => auth()->user()->company_id,
                ]);
    
                $this->alert('success', 'SUCESSO', [
                    'toast'=>false,
                    'position'=>'center',
                    'showConfirmButton' => false,
                    'confirmButtonText' => 'OK',
                    'text'=>'Elemento Inserido'
                ]);
            }
    
            $this->reset(['selectedComponentId', 'elements', 'level']);
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

    public function editComponent($id)
    {
        $component = Skill::find($id);
        $this->selectedComponentId = $component->id;
        $this->elements = $component->elements;
        $this->level = $component->level;
    }

    public function render()
    {
        return view('livewire.config.componente', $this->getComponents = Skill::where("company_id", auth()->user()->company_id)->get());
    }
}