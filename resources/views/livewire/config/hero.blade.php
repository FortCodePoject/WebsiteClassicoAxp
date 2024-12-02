<div wire:ignore>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-6">
                <div class="card mb-4">
                    <!-- Card Header -->
                    <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-white">Configurações de Conteúdo do site - Click em cada imagem para editar o seu site</h6>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <!-- Sidebar com Imagens -->
                            <div class="col-md-5">
                                <table class="tab">
                                    <tr class="tablinks active" onclick="openTab(event, 'hero')">
                                        <td><img src="{{ asset('wireframe/images/Hero.jpg') }}" width="400" height="100" alt=""></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="tablinks" onclick="openTab(event, 'competencias')">
                                                <img src="{{ asset('wireframe/images/Competencias.png') }}" width="200" height="100" />
                                            </a>
                                            <a href="#" class="tablinks" onclick="openTab(event, 'about')">
                                                <img src="{{ asset('wireframe/images/Sobre-mim.png') }}" width="200" height="100" />
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="tablinks" onclick="openTab(event, 'service')">
                                        <td><img src="{{ asset('wireframe/images/service.png') }}" width="400" height="100" alt=""></td>
                                    </tr>
                                    <tr class="tablinks" onclick="openTab(event, 'components')">
                                        <td><img src="{{ asset('wireframe/images/Componentes.png') }}" width="400" height="100" alt=""></td>
                                    </tr>
                                    <tr class="tablinks" onclick="openTab(event, 'works')">
                                        <td><img src="{{ asset('wireframe/images/Trabalhos.png') }}" width="400" height="100" alt=""></td>
                                    </tr>
                                    <tr class="tablinks" onclick="openTab(event, 'footer')">
                                        <td><img src="{{ asset('wireframe/images/footer.png') }}" width="400" height="100" alt=""></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Conteúdo Dinâmico -->
                            <div class="col-md-6 mt-3">
                                <div id="hero" class="tabcontent" style="display: block;">@livewire("config.inicial")</div>
                                <div id="competencias" class="tabcontent">@livewire("config.competence")</div>
                                <div id="about" class="tabcontent">@livewire("config.about")</div>
                                <div id="service" class="tabcontent">@livewire("config.service")</div>
                                <div id="components" class="tabcontent">@livewire("config.componente")</div>
                                <div id="works" class="tabcontent">@livewire("config.project")</div>
                                <div id="footer" class="tabcontent">@livewire("config.footer")</div>
                            </div>
                            
                        </div>

                        <!-- External Stylesheet -->
                        <link rel="stylesheet" href="{{ asset('css/tabs.css') }}" />

                        <!-- External JavaScript -->
                        <script src="{{ asset('js/tabs.js') }}"></script>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>