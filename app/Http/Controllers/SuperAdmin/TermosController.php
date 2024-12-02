<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Termpb;
use Illuminate\Http\Request;

class TermosController extends Controller
{
    public function privacyView(){
        $termos = Termpb::get();
        return view("superadmin.termos.privacy", compact("termos"));
    }

    public function privacyStore(Request $request){
        try {
            $termos = new Termpb();

            $termos->term = $request->term;
            $termos->privacity = $request->privacity;

            $termos->save();

            return response()->json();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Erros de Validações');
        }
    }
}
