<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\company;
use App\Models\GenerateImage;
use App\Models\pacote;
use Illuminate\Http\Request;

class PacoteController extends Controller
{
    //main page elements premium
    public function mainView(){
        $pacotes = pacote::get();
        $packges = GenerateImage::get();
        $companies = company::get();
        return view("superadmin.pacote.main", 
        [
            "companies" => $companies,
            "pacotes" => $pacotes,
            "packges" => $packges,
        ]);
    }

    //atribuir elemto a empresa
    public function store(Request $request){
        try {
            $pacote = new pacote();
            $packges = GenerateImage::find($request->packgeid);

            $pacote->pacote = $packges->packgename;
            $pacote->company_id = $request->company_id;
            $pacote->generate_images_id = $request->packgeid;

            $pacote->save();
            return redirect()->back()->with("success", "Elemento Adicionado");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Não é possivél");
        }
    }

    public function updatePacote(Request $request){
        pacote::where(["id" => $request->id])->update([
            "status" => $request->status,
            "id" => $request->id,
        ]);
        return redirect()->back()->with("success", "Elemento actualizado");
    }
}
