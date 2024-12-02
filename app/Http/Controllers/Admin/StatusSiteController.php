<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StatusSiteController extends Controller
{
    public function status(){
        Alert::error("Website Indisponivel");
        return view("site.App");
    }
}
