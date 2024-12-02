<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\documentation;
use App\Models\documentation_info;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DocumentationController extends Controller
{
    //
    public function index(){
        $documentations = documentation::all();
        return view("superadmin.documentation.App", compact("documentations"));
    }

    public function store(Request $request){
        try {
            //code...
            $documentation = new documentation();
            $documentation->panel = $request->painel;
            $documentation->section = $request->section;
            $documentation->action = $request->action;
            $documentation->save();

            $documentation_info = new documentation_info();
            $documentation_info->description = $request->description;
            $documentation_info->documentation_id = $documentation->id;
            $documentation_info->save();

            Alert::success("Documentação criada");
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}