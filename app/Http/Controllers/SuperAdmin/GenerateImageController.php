<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\GenerateImage;
use App\Models\pacote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenerateImageController extends Controller
{
    public function index()
    {
        try {
            //retornar a view
            $categoryPacote = pacote::get();
            $packgeImages = GenerateImage::get();
            return view("superadmin.generate.app", 
            compact("categoryPacote", "packgeImages"));
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function packgeSave(Request $request)
    {
        try {
            DB::beginTransaction();
            $packge = new GenerateImage();
            $packge->packgename = $request->name;
            $packge->packgeprice = $request->price;
            $packge->packgedescription = $request->description;
            $packge->packgeqtd = $request->qtd;

            $packge->save();
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}