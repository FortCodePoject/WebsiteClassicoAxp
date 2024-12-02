<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\{company, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterCompanyController extends Controller
{
    public function companyRegister(Request $request) {
        DB::beginTransaction();
        try {
            // Create token for company
            $tokenCompany = $request->name. rand(2000, 3000);
    
            $company = new company();
            $company->companyname = $request->name;
            $company->companyemail = $request->email;
            $company->companynif = $request->nif;
            $company->companybusiness = $request->type;
            $company->companyhashtoken = $tokenCompany;
            $company->companytokenapi = $request->apitoken;
            $company->save();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('f0rtc0d3'); 
            $user->role = "Administrador";
            $user->company_id = $company->id;
            $user->save();

            DB::commit();
    
            return response()->json(['message' => 'sucesso']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("error", "Erro ao adicionar empresa: " . $th->getMessage());
        }
    }

    public function deleteCompany($companyid){
        $company = company::find($companyid);
        $company->delete();
        return redirect()->back();
    }

    public function companyUpdate(Request $request) {
        DB::beginTransaction();
        try {
            
            $company = company::find($request->id);
            $company->companyname = $request->name;
            $company->companyemail = $request->email;
            $company->companynif = $request->nif;
            $company->companybusiness = $request->type;
            $company->companytokenapi = $request->apitoken;
            $company->update();

            DB::commit();
            Alert::success("Empresa Actualizada");
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("error", "Erro ao actualizar empresa: " . $th->getMessage());
        }
    }
    
}
