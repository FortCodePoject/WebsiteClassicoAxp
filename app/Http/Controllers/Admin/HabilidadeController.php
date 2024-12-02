<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Habilidade;
use Illuminate\Http\Request;

class HabilidadeController extends Controller
{
    //ver as habilidades
    public function habilityview()
    {
        return view("sbadmin.hability.App");
    }

    public function habilityCriar(Request $request)
    {
        try {

            $company_id = auth()->user()->company->id;
            $hability = new Habilidade();
            $hability->hability = $request->hability;
            $hability->level = $request->level;
            $hability->company_id = $company_id;
            $hability->save();

            return redirect()->back()->with('success', 'Habilidade Criada');
        } catch (\Throwable $th) {
        }
    }
}