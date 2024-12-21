<?php

use App\Http\Controllers\Admin\{ConditionsController, ConfigSiteController, DeliveryController};
use App\Http\Controllers\Admin\{HabilidadeController, PortalPbCOntroller, QuestionControll};
use App\Http\Controllers\Admin\{ShoopingController, StatusDeliveryController};
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Livewire\Admin\{Category, GeneralShopping, Itens, VerifyDelivery};
use App\Livewire\Config\Hero;
use App\Livewire\Definition\DefinitionGeneral;
use App\Livewire\Site\DeliveryStatusComponent;
use Illuminate\Support\Facades\Route;

Route::middleware("verified")->prefix("/admin/")->group(function(){
    //Routes do administrador do site para manipulação
    Route::controller(AdminController::class)->group(function(){
        Route::get("index/{id?}", "index")->name("admin.index");
        Route::get("hero/", "heroview")->name("admin.view.hero");
        Route::post("register/", "registerdatas")->name("admin.store.hero");
        Route::get("edit/data/{id}", "edit")->name("admin.edit.data");
        Route::post("update/{id}", "update")->name("admin.update");
        
        Route::get("detail", "detailview")->name("admin.detail");
        Route::post("detail/store", "storeDetail")->name("admin.store.detail");
        Route::post("detaol/{id}", "actualizarDetalhes")->name("admin.detalhes.update");

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
        Route::get("admin/datalhes/{id}", "editDetalhes")->name("admin.edit.detalhes");

        //About
        Route::get("about", "about")->name("admin.about");
        Route::post("about/store", "storeAbout")->name("admin.store.about");
        Route::get("about/edit/{id}", "editAbout")->name("admin.edit.about");
        Route::post("about/actualizar/{id}", "actualizarAbout")->name("admin.about.update");
        
        Route::get("service", "viewservice")->name("admin.view.services");
        Route::post("service", "storeservice")->name("admin.store.service");
        Route::get("service/{id}", "editservice")->name("admin.view.edit.service");
        Route::post("actualizar/{id}", "actualizarservice")->name("admin.update.service");

        //Alteração de cores do website
        Route::get("cor", "colorview")->name("anuncio.management.view.color");
        Route::post("cor/save", "storecolor")->name("anuncio.management.store.color");
        Route::post("cor/actualizar", "selectColor")->name("anuncio.management.actualizar.color");
        Route::get("fundo", "imagebackground")->name("anuncio.management.view.fundo");
        Route::post("fundo/save", "imagebackgroundstore")->name("anuncio.management.store.fundo");
        Route::post("fundo/actualizar", "imageactualizar")->name("anuncio.mamnagement.actualizar.fundo");

        Route::post("started/store/", "storeStarted")->name("admin.management.store.started");

        //profile
        Route::get("perfi/", "profileUser")->name("admin.management.user.profile");
        Route::post("perfi/edit/{id}", "updateProfile")->name("admin.management.update.profile");

        //configurações
        Route::get("config/", Hero::class)->name("admin.management.config");
        Route::get("definicao/geral", DefinitionGeneral::class)->name("denition.general");

        //movimentação da loja
        Route::get("/categorias", Category::class)->name("admin.shopping.category");
        Route::get("/itens", Itens::class)->name("admin.shopping.itens");
        Route::get("/verificar", VerifyDelivery::class)->name("admin.verify.delivery");
        Route::get("/loja", GeneralShopping::class)->name("admin.general.shopping");
    });

    Route::controller(ConditionsController::class)->group(function(){
        Route::get("termos/condições", "conditionsView")->name("admin.conditions.view");
        Route::post("termos/condições/save", "conditionsCreate")->name("admin.conditions.create");
        Route::put('/items/update-status', 'termoStatus')->name('items.updateStatus');
    });

    Route::controller(ConfigSiteController::class)->group(function(){
        Route::get("/config/site", "configView")->name("admin.config.view");
        Route::put("/config/status", "updateStatus")->name("admin.update.status.company");
    });

    Route::controller(QuestionControll::class)->group(function(){
        Route::get("/perguntas/frequentes", "index")->name("admin.panel.question");
    });

    Route::controller(ShoopingController::class)->group(function(){
        Route::get("/elementos/premium", "index")->name("loja.online");
        Route::get("/add/cart/{id}", "addCart")->name("loja.add.cart");
        Route::get("/lista/Carrinho/", "getTotalCart")->name("loja.get.cart.total");
    });

    Route::controller(PortalPbCOntroller::class)->group(function(){
        Route::get("/portal/pb", "index")->name("admin.portal.pb");
    });

    Route::controller(HabilidadeController::class)->group(function(){
        Route::get("/habilidades/ver", "habilityview")->name("admin.hability.view");
        Route::post("/criar/habilidade", "habilityCriar")->name("admin.hability.criar");
    });

    Route::get("/encomenda/estado/{id}", DeliveryStatusComponent::class)->name("delivery.status");

    //Verificar estado do pedido
    Route::controller(StatusDeliveryController::class)->group(function(){
        Route::get("/delivery/status", "index")->name("plataform.portfolio.admin.delivery.status");
    });

    Route::controller(DeliveryController::class)->group(function(){
        Route::get("/lista/encomeda", "index")->name("plataform.portfolio.admin.delivery.list");
    });

    //visitantes
})->middleware("auth", "administrador");

Route::controller(LoginController::class)->group(function(){
    Route::get("/login/view", "loginview")->name("anuncio.login.view");
    Route::post("/login", "login")->name("anuncio.login");
    Route::get("/terminar/sessao", "logout")->name("anuncio.logout");
});