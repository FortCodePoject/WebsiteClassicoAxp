<?php

namespace App\Livewire\SuperAdmin;

use App\Models\company;
use App\Models\visitor as ModelsVisitor;
use Livewire\Component;
use Livewire\WithPagination;

class Visitor extends Component
{
    use WithPagination;
    public $company, $moth, 
    $companydados, $companyselect, $perPage = 8;

    public function mount()
    {
        $this->company = company::get();
    }

    public function render()
    {
        return view('livewire.super-admin.visitor', [
            "visitors" => ModelsVisitor::orderBy('created_at', 'desc')->paginate($this->perPage)
        ])->layout('layouts.config.app');
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
