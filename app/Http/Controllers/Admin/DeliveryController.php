<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    //
    public function index()
    {
        return view("sbadmin.delivery.app");
    }
}