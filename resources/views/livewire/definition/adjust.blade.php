<div class="container-fluid p-4">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="form-group mb-4">
                <h4>Habilitar site</h4>
                <div>
                    <div class="item">
                        <div class="toggle-pill-color mb-2">
                            <input type="checkbox" id="siteStatus" wire:change="updateStatus" {{ $statusSite->status === 'active' ? 'checked' : '' }}>
                            <label for="siteStatus"></label> Desativar | Ativar 
                        </div> 
                        @if ($statusSite->status === 'active')
                            <p class="text-success">O site está ativo.</p>
                        @else
                            <p class="text-danger">O site está desativado.</p>
                        @endif
                    </div>                
                </div>
            </div>
    
            <div class="form-group">
                <h4>Termos PB</h4>
                <div>
                    <div class="item">
                        <div class="toggle-pill-color mb-2">
                            <input type="checkbox" id="termStatus" wire:change="termoStatus" {{ isset($this->terms) && $this->terms->accept === 'yes' ? 'checked' : '' }}>
                            <label for="termStatus"></label> 
                        </div>
                        @if (isset($terms) && isset($terms->accept) && $terms->accept === 'yes')
                            <p class="text-success">Termos PB aceites.</p>
                        @else
                            <p class="text-danger">Termos PB rejeitados</p>
                            <div class="mb-2">
                                <button data-toggle="modal" data-target="#termsCompany" class=" btn btn-primary bg-white text-primary">Cadastrar meus termos</button>                           
                                <button data-toggle="modal" data-target="#readMyTerms" class=" btn btn-primary bg-white text-primary" wire:click="loadTerms()">Ler termos</button>
                            </div>
                        @endif
                        <button data-toggle="modal" data-target="#read" class="btn btn-primary bg-white text-primary">Ler termos PB</button>
                        <svg data-toggle="modal" data-target="#exampleModal" style="color: #fff; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                        </svg>
                        @include("site.create")
                        @include("modals.read")
                        @include("modals.readmyterms") 
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="form-group">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                1) Funcionamento do Mecanismo de Aceitação de Termos PB.
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Quando um usuário acessa o website pela primeira vez ou após uma atualização significativa nos termos e condições, uma janela pop-up, banner ou uma página intermediária é apresentada. Esta interface contém o texto completo dos Termos de Uso e da Política de Privacidade, que deve ser lido e compreendido pelo usuário.</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#politica" aria-expanded="false" aria-controls="collapseTwo">
                                2) Opção de Aceitação ou Recusa.
                            </h6>
                        </div>
                        <div id="politica" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Dentro dessa interface, o usuário encontrará opções claras para aceitar ou recusar os termos. Normalmente, isso é feito por meio de botões ou checkboxes com legendas como "Aceito os Termos e Condições" e "Não Aceito".</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                3) Bloqueio de Acesso sem Aceitação.
                            </h6>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Se o usuário escolhe não aceitar os termos e condições, o mecanismo impede que ele prossiga para acessar o conteúdo ou serviços do website. Isso é realizado bloqueando a navegação além da página de termos e condições.</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h6 class="mb-0" style="cursor: pointer;" data-toggle="collapse" data-target="#quetion1" aria-expanded="false" aria-controls="collapseThree">
                                4) Ativação do Website com Aceitação.
                            </h6>
                        </div>
                        <div id="quetion1" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Se o usuário aceita os termos, o sistema registra essa aceitação. Após essa confirmação, o usuário é redirecionado automaticamente para a página inicial.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>