<?php

use App\Http\Controllers\Api\V1\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(\App\Http\Controllers\Api\V\Company::class)->group(function(){
    Route::get("/show/link","index")->name('get.link');
});
