<div>
    <link rel="stylesheet" href="{{asset("css/definition.css")}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-6">
                <div class="card mb-4">
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            
                            <main>
                                <input id="tab1" type="radio" name="tabs" checked>
                                <label for="tab1"> Categorias </label>
                                    
                                <input id="tab2" type="radio" name="tabs">
                                <label for="tab2"> Itens </label>
                                    
                                <input id="tab3" type="radio" name="tabs">
                                <label for="tab3">Controle de Encomenda</label>

                                <input id="tab4" type="radio" name="tabs">
                                <label for="tab4">Verificação de Encomenda</label>
                                    
                                <section id="content1">@livewire("admin.category")</section>
                                <section id="content2">@livewire("admin.itens") </section>
                                <section id="content3">@livewire("admin.encomenda")</section>
                                <section id="content4">@livewire("admin.verify-delivery")</section>
                            </main>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>