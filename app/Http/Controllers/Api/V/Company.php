<?php

namespace App\Http\Controllers\Api\V;

use App\Http\Controllers\Controller;
use App\Models\company as ModelsCompany;
use Illuminate\Http\Request;

class Company extends Controller
{
    public function index(Request $request)
    {
       
        try {
            if ($request->token  != null) {
                $data = ModelsCompany::select("companyhashtoken")->where("companytokenapi",$request->token)->first();
                return response(["link"=>$data->companyhashtoken],200);
            }
            return response(["message"=>"Result Not Found"],200);
        } catch (\Throwable $th) {
            return response(["error"=>"Fail to search website"],401);
        }
    }
}