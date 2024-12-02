<div wire:ignore>
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
                                <label for="tab1">Personalizar Website </label>
                                    
                                <input id="tab2" type="radio" name="tabs">
                                <label for="tab2">Paleta de Cores</label>
                                    
                                <input id="tab3" type="radio" name="tabs">
                                <label for="tab3">Fotos de Fundo</label>
                                    
                                <input id="tab4" type="radio" name="tabs">
                                <label for="tab4">Habilitar Website</label>
                                
                                <input id="tab5" type="radio" name="tabs">
                                <label for="tab5">Minha Conta</label>
                                
                                {{-- <input id="tab6" type="radio" name="tabs">
                                <label for="tab6"></label> --}}
                                    
                                <section id="content1">@livewire("definition.support")</section>
                                <section id="content2">@livewire("definition.color") </section>
                                <section id="content3">@livewire("definition.background")</section>
                                <section id="content4">@livewire("definition.adjust")</section>
                                <section id="content5">@livewire("definition.my-account")</section>
                            </main>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>