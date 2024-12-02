<?php

namespace App\Livewire\Config;

use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        return view('livewire.config.hero')->layout('layouts.config.app');
    }
}
