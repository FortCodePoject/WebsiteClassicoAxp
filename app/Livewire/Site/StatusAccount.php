<?php

namespace App\Livewire\Site;

use Livewire\Component;

class StatusAccount extends Component
{
    public function render()
    {
        return view('livewire.site.status-account')->layout("layouts.subscription.app");
    }
}
