@extends('layouts.index')
@section('title', 'Painel Administrativo')
@section('content')
    @include('sbadmin.includes.sidebar')
    <link rel="stylesheet" href="{{asset("css/home.css")}}">
    <!-- Content Wrapper -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            @include('sbadmin.includes.topbar')
            <!-- End of Topbar -->
            @include('sbadmin.active.app')

            <!-- Begin Page Content -->
            <div class="container-fluid" style="margin-top: 3rem">
                <div class="row col-xl-12 d-flex justify-content-center align-content-center">
                  
                    <div class="text-center">
                        <h2>Bem vindo ao painel administrativo do seu site <span class="text-primary">{{auth()->user()->name}}</span></h2>
                        <h5>Link de acesso do seu site para partilhar nas redes socias: <a target="_blank" href="https://axp.fortcodedev.com/{{Str::lower(auth()->user()->company->companyhashtoken)}}">https://axp.fortcodedev.com/{{Str::lower(auth()->user()->company->companyhashtoken)}}</a></h5>
                    </div>

                    <div class="col-xl-6">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headinghopping">
                                <h6 style="cursor: pointer;" class="mb-0" data-toggle="collapse" data-target="#hopping" aria-expanded="true" aria-controls="hopping">
                                    1) Como Adicionar itens na loja?
                                </h6>
                                </div>
                            
                                <div id="hopping" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p> Adicionar na loja</p>
                                </div>
                                </div>
                            </div>
                
                            <div class="card">
                                <div class="card-header" id="headingmarketing">
                                <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#marketing" aria-expanded="false" aria-controls="marketing">
                                    1) Serviços de marketing
                                </h6>
                                </div>
                                <div id="marketing" class="collapse" aria-labelledby="marketing" data-parent="#accordionExample">
                                <div class="card-body">          
                                    <p> Marketing </p>
                                </div>
                                </div>
                            </div>
                
                            <div class="card">
                                <div class="card-header" id="headingpremium">
                                <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#premium" aria-expanded="false" aria-controls="premium">
                                    3) Elementos premium
                                </h6>
                                </div>
                                <div id="premium" class="collapse" aria-labelledby="premium" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>
                                        Elementos Premium
                                    </p>
                                </div>
                                </div>
                            </div>
                
                            <div class="card">
                                <div class="card-header" id="headinganuncio">
                                    <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#anuncio" aria-expanded="false" aria-controls="anuncio">
                                        4) Serviço de Anúncio
                                    </h6>
                                </div>
                                <div id="anuncio" class="collapse" aria-labelledby="anuncio" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>
                                        No painel de administrador vá para “[Nome da secção da Loja]” e adira ao elemento premiums que deseja. Todos elementos premium têm um custo. Se não encontrar o que precisa use a secção de Ajuda no painel (canto superior XXX) e a nossa equipa ajudará assim que possível.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-xl-6">
                      <div class="accordion" id="accordionExample">
                          <div class="card">
                              <div class="card-header" id="headingOne">
                                  <h6 style="cursor: pointer;" class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                      1) Posso mudar o conteúdo do meu website?
                                  </h6>
                              </div>
                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                  <div class="card-body">
                                      <p>Sim! Use o seu painel de administrador para mudar textos, imagens e cores.</p>
                                  </div>
                              </div>
                          </div>
                  
                          <div class="card">
                              <div class="card-header" id="headingError">
                                  <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseTwoError" aria-expanded="true" aria-controls="collapseTwo">
                                      2) Existem alguns erros no conteúdo do meu website, por quê?
                                  </h6>
                              </div>
                              <div id="collapseTwoError" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                  <div class="card-body">
                                      <p>O set-up inicial é cortesia da nossa equipa e fizemos o melhor esforço. Contudo, é sua responsabilidade certificar que o conteúdo está certo e modificar via o painel de administrador o que for necessário.</p>
                                  </div>
                              </div>
                          </div>
                  
                          <div class="card">
                              <div class="card-header" id="headingThree">
                                  <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                      3) Como posso adicionar WhatsApp no meu website?
                                  </h6>
                              </div>
                              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                  <div class="card-body">
                                      <p>No painel de administrador vá para “[Nome da secção da Loja]” e adicione o WhatsApp. Como elemento premium, tem um custo mensal.</p>
                                  </div>
                              </div>
                          </div>
                  
                          <div class="card">
                              <div class="card-header" id="headingFour">
                                  <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                      4) Existem outros elementos que gostaria de adicionar - como faço?
                                  </h6>
                              </div>
                              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                  <div class="card-body">
                                      <p>No painel de administrador vá para “[Nome da secção da Loja]” e adicione os elementos premium que desejar. Todos os elementos premium têm um custo. Se não encontrar o que precisa, use a secção de Ajuda no painel (canto superior XXX), e nossa equipa ajudará assim que possível.</p>
                                  </div>
                              </div>
                          </div>
                  
                          <div class="card">
                              <div class="card-header" id="headingmodify">
                                  <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#modify" aria-expanded="true" aria-controls="modify">
                                      5) Como posso modificar a estrutura do meu website?
                                  </h6>
                              </div>
                              <div id="modify" class="collapse" aria-labelledby="modify" data-parent="#accordionExample">
                                  <div class="card-body">
                                      <p>Mudanças na estrutura estão fora do escopo dos websites clássicos. Pedidos de mudanças na estrutura são avaliados e cotados como “Websites à Medida”. Para requisitar mudanças, use a secção de Ajuda no painel (canto superior XXX), e nossa equipa entrará em contacto consigo.</p>
                                  </div>
                              </div>
                          </div>
                  
                          <div class="card">
                              <div class="card-header" id="headinghelp">
                                  <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#help" aria-expanded="true" aria-controls="help">
                                      6) Preciso de ajuda - como posso receber ajuda?
                                  </h6>
                              </div>
                              <div id="help" class="collapse" aria-labelledby="help" data-parent="#help">
                                  <div class="card-body">
                                      <p>Entre no seu painel de administrador e use a secção de Ajuda (canto superior XXX), e nossa equipa entrará em contacto consigo.</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>

                </div>
            </div> 
            
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
@endsection