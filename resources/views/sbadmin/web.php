<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

    //Routes do site 
    Route::controller(SiteController::class)->group(function(){
        Route::get("/", "index")->name("site.karamba.index");
        Route::get("/about", "about")->name("site.karamba.about");
        Route::get("/produtos", "products")->name("site.karamba.products");
        Route::get("/contactos", "contact")->name("site.karamba.contact");
        Route::get("/bilhetes", "bilhete")->name("site.karamba.bilhete");
        Route::get("/bilhete/{id}", "FormBilhetes")->name("admin.get.bilhete");
        Route::post("/comprar/bilhete", "payment")->name("site.karamba.payment.bilhete");
        Route::post("/envio/email/client", "sendEmail")->name("site.karamba.send.email");

        Route::get("/api/datas", "api");
    });

    //Routes do administrador do site para manipulação
Route::middleware("auth")->controller(AdminController::class)->prefix("/admin/")->group(function(){
    Route::get("index", "index")->name("admin.index");
    Route::get("hero", "hero")->name("admin.index.hero");
    Route::post("register/", "registerdatas")->name("admin.register");
    Route::get("edit/data/{id}", "edit")->name("admin.edit.data");
    Route::post("update/{id}", "update")->name("admin.update");

    Route::get("serviços", "viewservice")->name("admin.view.service");
    Route::post("serviços", "storeservice")->name("admin.store.service");
    
    Route::get("detail", "detailview")->name("admin.detail");
    Route::post("detail/store", "storeDetail")->name("admin.store.detail");
    Route::get("detail/{id}", "deleteDetail")->name("admin.detail.delete");
    Route::get("infowhy", "infowhy")->name("admin.infowhy");
    Route::get("infowhy/edit/{id}", "editwhy")->name("admin.infowhy.edit");
    Route::post("infowhy/update/{id}", "actualizar")->name("admin.infowhy.update");
    Route::post("infowhy/store", "storeinfowhy")->name("store.infowhy");

    //Contacto e Footer
    Route::get("footer", "footer")->name("admin.footer");
    Route::post("contacto", "contactStore")->name("admin.footer.store");
    Route::get("contact/{id}", "editContact")->name("admin.edit.conatct");
    Route::post("contact/update/{id}", "actualizarContact")->name("admin.contact.update");
    
    //Detalhes
    Route::get("datalhes/{id}", "editDetalhes")->name("admin.edit.detalhes");
    Route::post("Detalhes/update/{id}", "actualizarDetalhes")->name("admin.detalhes.update");

    //About
    Route::get("about", "about")->name("admin.about");
    Route::post("about/store", "storeAbout")->name("admin.store.about");
    Route::get("about/edit/{id}", "editAbout")->name("admin.edit.about");
    Route::post("about/actualizar/{id}", "actualizarAbout")->name("admin.about.update");
    
    //Bilohetes
    Route::get("criar/bilhete/", "createBilhete")->name("admin.get.form.bilhete");
    Route::post("gravar/bilhete", "storeBilhete")->name("admin.post.store.bilhete");
    
    //Anúncios
    Route::get("anuncio/retangulo", "anuncioRetangulo")->name("anuncio.management.view.retangulo");
    Route::post("store", "store")->name("anuncio.management.store");
    Route::post("update", "updateAnuncio")->name("anuncio.management.update");
    Route::post("store/anuncio", "storeQ")->name("anuncio.management.store.quadrado");
    Route::post("update/anuncio/", "updateQ")->name("anuncio.management.update.quadrado");
    Route::get("delete/{id}", "anuncioDelete")->name("anuncio.management.delete");
    Route::get("lista/anuncio/q", "anuncioQuadrado")->name("anuncio.management.lista.quadrado");
    Route::get("lista/anuncio/v", "anuncioVertical")->name("anuncio.management.lista.vertical");
    Route::get("lista/anuncio/h", "anuncioHorizontal")->name("anuncio.management.lista.horizontal");
    
    Route::get("users", "users")->name("anuncio.management.users");
    Route::post("user/store", "storeUser")->name("anuncio.management.user.store");
    Route::get("user/{id}", "deleteUser")->name("anuncio.management.delete.user");

    //Alteração de cores do website
    Route::get("cor", "colorview")->name("anuncio.management.view.color");
    Route::post("cor/save", "storecolor")->name("anuncio.management.store.color");
    Route::post("cor/actualizar", "selectColor")->name("anuncio.management.actualizar.color");
    Route::get("fundo", "imagebackground")->name("anuncio.management.view.fundo");
    Route::post("fundo/save", "imagebackgroundstore")->name("anuncio.management.store.fundo");
    Route::post("fundo/actualizar", "imageactualizar")->name("anuncio.mamnagement.actualizar.fundo");
});

Route::controller(LoginController::class)->group(function(){
    Route::get("/login/view", "loginview")->name("anuncio.login.view");
    Route::post("/login", "login")->name("anuncio.login");
    Route::get("/sair", "logout")->name("anuncio.logout");
});