<?php

namespace App\Livewire\SuperAdmin;

use App\Models\company;
use App\Models\visitor as ModelsVisitor;
use Livewire\Component;
use Livewire\WithPagination;

class Visitor extends Component
{
    use WithPagination;
    public $visitors, $company, $moth, 
    $companydados, $companyselect;

    public function mount()
    {
        $this->visitors = ModelsVisitor::get();
        $this->company = company::get();
    }

    public function render()
    {
        return view('livewire.super-admin.visitor');
    }

    public function getVisitorCompany()
    {
        try {
            $this->companydados = ModelsVisitor::where("company", $this->companyselect)
            ->whereMonth('created_at', $this->moth)->count();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
