<?php

namespace App\Livewire\Site;

use Livewire\Component;

class VerifyEmail extends Component
{
    public function render()
    {
        return view('livewire.site.verify-email')->layout("layouts.subscription.app");
    }
}
