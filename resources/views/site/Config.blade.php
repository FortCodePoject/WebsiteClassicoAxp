@extends("layouts.index")
@section("title", "Painel Admin - Definições")
@section("content")
@include("sweetalert::alert")
@include("sbadmin.documentation.config.App")

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{-- @include("sbadmin.documentation.config.App") --}}
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
                                        <h6 class="m-0 font-weight-bold text-white">Configurações</h6>
                                    </div>

                                    <div>
                                        <button data-toggle="modal" data-target="#termsCompany" class=" btn btn-primary bg-white text-primary">Cadastrar</button>
                                        <svg data-toggle="modal" data-target="#exampleModal" style="color: #fff; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body d-flex">
                                <div class="col-md-4 col-4 col-xl-4">
                                    <div class="form-group mb-4">
                                        <div>
                                            <h3>Habilitar site</h3>
                                        </div>
                                        <div>
                                            <form id="statusForm" action="{{ route('admin.update.status.company') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="status" id="statusCheckbox" {{ $statusSite->status === 'active' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="statusCheckbox">
                                                        Ativar/Desativar
                                                    </label>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $(document).ready(function(){
                                                $('#statusCheckbox').change(function(){
                                                    $('#statusForm').submit();
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <h3>Termos PB</h3>
                                        </div>
                                        <form id="status" action="{{ route('items.updateStatus') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="status" id="statusTerm" {{ isset($termPbs->status) === 'active' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="statusTerm">
                                                    Aceito / Não Aceito
                                                </label>
                                            </div>
                                        </form>
                                        
                                        <script>
                                            $(document).ready(function(){
                                                $('#statusTerm').change(function(){
                                                    $('#status').submit();
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>

                                <div class="col-md-8 col-8 col-xl-8">
                                    <div class="form-group">
                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                              <div class="card-header" id="headingOne">
                                                <h2 class="mb-0">
                                                  <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    1) Funcionamento do Mecanismo de Aceitação de Termos PB.
                                                  </button>
                                                </h2>
                                              </div>
                                          
                                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <p> - Quando um usuário acessa o website pela primeira vez ou após uma atualização significativa nos termos e condições, uma janela pop-up, banner ou uma página intermediária é apresentada. Esta interface contém o texto completo dos Termos de Uso e da Política de Privacidade, que deve ser lido e compreendido pelo usuário.
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
    
                                            <div class="card">
                                              <div class="card-header" id="headingTwo">
                                                <h2 class="mb-0">
                                                  <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#politica" aria-expanded="false" aria-controls="collapseTwo">
                                                    2) Opção de Aceitação ou Recusa.
                                                  </button>
                                                </h2>
                                              </div>
                                              <div id="politica" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-body">          
                                                    <p> - Dentro dessa interface, o usuário encontrará opções claras para aceitar ou recusar os termos. Normalmente, isso é feito por meio de botões ou checkboxes com legendas como "Aceito os Termos e Condições" e "Não Aceito".                                                        .
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
    
                                            <div class="card">
                                              <div class="card-header" id="headingThree">
                                                <h2 class="mb-0">
                                                  <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    3) Bloqueio de Acesso sem Aceitação.
                                                  </button>
                                                </h2>
                                              </div>
                                              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <p> 
                                                        - Se o usuário escolhe não aceitar os termos e condições, o mecanismo impede que ele prossiga para acessar o conteúdo ou serviços do website. Isso é realizado bloqueando a navegação além da página de termos e condições. O usuário pode ser redirecionado para uma mensagem informativa explicando que, sem a aceitação dos termos, o uso do site não é permitido.
                                                    </p>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                  <h2 class="mb-0">
                                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#quetion1" aria-expanded="false" aria-controls="collapseThree">
                                                        4) Ativação do Website com Aceitação.
                                                    </button>
                                                  </h2>
                                                </div>
                                                <div id="quetion1" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                  <div class="card-body">
                                                      <p>
                                                        - Se o usuário aceita os termos, o sistema registra essa aceitação (geralmente através de um cookie ou uma entrada no banco de dados que armazena a aceitação vinculada ao perfil do usuário ou endereço IP). Após essa confirmação, o usuário é redirecionado automaticamente para a página inicial ou para a seção do website que desejava acessar, com o acesso completo ativado.
                                                      </p>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("site.create")
@endsection