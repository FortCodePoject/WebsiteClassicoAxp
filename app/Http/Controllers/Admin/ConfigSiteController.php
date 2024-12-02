<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\company;
use App\Models\Documentation;
use App\Models\Termpb;
use App\Models\Termpb_has_Company;
use App\Models\TermsCompany;
use Illuminate\Http\Request;

class ConfigSiteController extends Controller
{
    public function configView(){
        $config = Documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "CONFIGURAÇÕES")->get();
        $company_id = auth()->user()->company_id;
        $termos = TermsCompany::where("company_id", isset($company_id) ? $company_id : "")->first();
        $statusSite = company::where("id", $company_id)->first();
        return view("site.Config", compact("statusSite", "termos", "config"));
    }

    //Create - save terms and privacity
    public function conditionsCreate(Request $request){
        try {
            $conditions = new TermsCompany();

            $conditions->privacity = $request->privacity;
            $conditions->term = $request->term;
            $conditions->company_id = auth()->user()->company_id;
            $conditions->save();

            if ($conditions) {
                return redirect()->back()->with("success", "Termo Criado");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Campos Vazios");
        }
    }

    public function termoStatus(Request $request)
    {
        try {
            $termPbs = Termpb::first();
            $termspb_has_company = new Termpb_has_Company();
            $termspb_has_company->company_id = auth()->user()->company_id;
            $termspb_has_company->termpb_id = $termPbs->id;
            $termspb_has_company->save();

            $company = company::find(auth()->user()->company_id);
            // Atualiza o estado baseado no valor do checkbox
            $company->status = $request->input('status') ? 'active' : 'inactive';
            $company->save();

            return redirect()->back()->with('success', 'Termos e Politicas Aceites');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Ocorreu um erro', $th->getMessage());
        }
    }

    public function updateStatus(Request $request)
    {
        $company_id = auth()->user()->company_id;
        $item = company::find($company_id);
        
        // Atualiza o estado baseado no valor do checkbox
        $item->status = $request->input('status') ? 'active' : 'inactive';
        $item->save();
        
        return redirect()->back()->with('success', 'Estado atualizado com sucesso!');
    }
}