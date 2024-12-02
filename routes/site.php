<?php

use App\Http\Controllers\Admin\StatusSiteController;
use App\Http\Controllers\SiteController;
use App\Livewire\Loja\Deliverystatus;
use App\Livewire\Site\DeliveryStatusComponent;
use Illuminate\Support\Facades\Route;

Route::controller(SiteController::class)->group(function(){
    Route::get("/{company}", "index")->name("site.portfolio.index");
    Route::post("/envio/email/client", "sendEmail")->name("site.portfolio.send.email");
    Route::get("/senha", "senha")->name("site.portfolio.senha");
    Route::get("/{company}/shopping/produtos", "getShopping")->name("site.portfolio.shopping");
    Route::get("/{company}/shopping/cart", "getShoppingcart")->name("site.portfolio.shopping.cart");
});

Route::controller(StatusSiteController::class)->group(function(){
    Route::get("/site/status", "status")->name("site.status");
});

Route::get("/encomenda/estado/{id}", Deliverystatus::class)->name("site.delivery.status");