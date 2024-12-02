<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\company;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    //Chamar a pagina principal do painel
    public function index(){
        return view("superadmin.home");
    }
    //criar a conta de cada portfolio
    public function accountView(){
        $companies = company::paginate(6);
        return view("superadmin.account", ["companies" => $companies]);
    }
}