<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class GeneralShopping extends Component
{
    public function render()
    {
        return view('livewire.admin.general-shopping')->layout('layouts.config.app');
    }
}