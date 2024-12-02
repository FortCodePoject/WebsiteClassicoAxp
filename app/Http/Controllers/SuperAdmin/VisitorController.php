<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    //
    public function index()
    {
        try {
            return view("superadmin.visitor.app");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
