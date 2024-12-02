@extends("layouts.index")
@section("title", "Painel Admin - Hero")
@section("content")
@include("sweetalert::alert")
    {{-- side bar --}}
    @include("sbadmin.includes.sidebar")

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include("sbadmin.includes.topbar")

            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12 col-lg-6">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header bg-primary py-3 flex-row align-items-center justify-content-between col-xl-12">
                                <div class="col-xl-12 d-flex justify-content-between">
                                    <div>
                                        <h6 class="m-0 font-weight-bold text-white">Perguntas Frequentes</h6>
                                    </div>
                                    <div>
                                        <svg data-toggle="modal" data-target="#exampleModal" style="color: #fff; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body d-flex">
                                <div class="col-xl-6">
                                    <div>
                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                              <div class="card-header" id="headingOne">
                                                <h2 class="mb-0">
                                                  <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    1) Posso mudar o conteúdo do meu website?
                                                  </button>
                                                </h2>
                                              </div>
                                          
                                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <p> - Sim! Use o seu painel de administrador para mudar textos, imagens e cores.
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
    
                                            <div class="card">
                                              <div class="card-header" id="headingTwo">
                                                <h2 class="mb-0">
                                                  <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#politica" aria-expanded="false" aria-controls="collapseTwo">
                                                    2) Existem alguns erros no conteúdo do meu website, porque?
                                                  </button>
                                                </h2>
                                              </div>
                                              <div id="politica" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-body">          
                                                    <p>- O set-up inicial é cortesia da nossa equipa e fizemos o melhor esforço. Contudo, é sua responsabilidade certificar que o conteúdo está certo e modificar via o painel de administrador o que for necessário.
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
    
                                            <div class="card">
                                              <div class="card-header" id="headingThree">
                                                <h2 class="mb-0">
                                                  <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    3) Como posso adicionar WhatsApp no meu website?
                                                  </button>
                                                </h2>
                                              </div>
                                              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <p>- No painel de administrador vá para “[Nome da secção da Loja]” e adira ao WhatsApp. Como elemento premium tem um custo mensal
                                                    </p>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                  <h2 class="mb-0">
                                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#quetion1" aria-expanded="false" aria-controls="collapseThree">
                                                        4) Existem outros elementos que gostaria de adicionar - como faço?
                                                    </button>
                                                  </h2>
                                                </div>
                                                <div id="quetion1" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                  <div class="card-body">
                                                      <p>
                                                        - No painel de administrador vá para “[Nome da secção da Loja]” e adira ao elemento premiums que deseja. Todos elementos premium têm um custo. Se não encontrar o que precisa use a secção de Ajuda no painel (canto superior XXX) e a nossa equipa ajudará assim que possível.
                                                      </p>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                  <h2 class="mb-0">
                                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#question2" aria-expanded="false" aria-controls="collapseThree">
                                                        5) Como posso modificar a estrutura do meu website?
                                                    </button>
                                                  </h2>
                                                </div>
                                                <div id="question2" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                  <div class="card-body">
                                                      <p>
                                                        - Mudanças de estrutura estão fora do escopo dos websites clássicos. Pedidos de mudanças na estrutura são avaliadas e cotados como “Websites à Medida”. Para requisitar mudanças use a secção de Ajuda no painel (canto superior XXX) e a nossa equipa entrará em contacto consigo.
                                                      </p>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                  <h2 class="mb-0">
                                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#question3" aria-expanded="false" aria-controls="collapseThree">
                                                        6) Preciso de ajuda - como posso receber ajuda?
                                                    </button>
                                                  </h2>
                                                </div>
                                                <div id="question3" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                  <div class="card-body">
                                                      <p>
                                                        - Entre no seu painel de administrador use a secção de Ajuda(canto superior XXX) e a nossa equipa entrará em contacto consigo.
                                                      </p>
                                                  </div>
                                                </div>
                                            </div>

                                          </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div style="width: 5rem">
                                        <img width="600" src="{{asset("assets/img/question.svg")}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection