<?php

namespace App\Livewire\Definition;

use Livewire\Component;

class DefinitionGeneral extends Component
{
    public function render()
    {
        return view('livewire.definition.definition-general')->layout('layouts.config.app');
    }
}
