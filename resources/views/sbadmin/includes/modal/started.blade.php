@include("components.style")
<!-- Modal -->
<div class="modal fade" id="started" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="">
                Bem Vindo ao Painel do seu Website, começe a configura-ló. 
            </h5>
        </div>
        <div class="modal-body">
            <form action="{{route("admin.management.store.started")}}" class="form" enctype="multipart/form-data" method="POST">

                <!-- Progress bar -->
                @csrf
                {{-- <div class="progressbar">
                  <div class="progress" id="progress"></div>
                  <div class="progress-step progress-step-active" data-title="Hero"></div>
                  <div class="progress-step" data-title="Sobre"></div>
                  <div class="progress-step" data-title="ID"></div>
                  <div class="progress-step" data-title="Password"></div>
                </div> --}}
          
                <!-- Steps -->
                <div class="form-step form-step-active">
                  <div class="col-12 row">
                    
                    <div class="col-md-6">
                      {{-- <img src="{{url("/Sbadmin/img/step-one.png")}}" alt="" style="width: 100%;"> --}}
                      <div class="input-group">
                        <h4 class=" text-uppercase">Intro - Informações Iniciais</h4>
                      </div>
                      <div class="input-group">
                        <label for="username">Titulo</label>
                        <input type="text" name="title" id="title" />
                      </div>
                      <div class="input-group">
                        <label for="position">Descrição</label>
                        <input type="text" name="description" id="description" />
                      </div>

                      <div class="input-group">
                        <label for="position">Carregue uma Imagem </label>
                        <input type="file" name="img" id="img" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      {{-- <img src="{{url("/Sbadmin/img/paragraph.png")}}" alt="" style="width: 100%;"> --}}
                      <div class="input-group">
                        <h4 class=" text-uppercase">Sobre a Sua Empresa</h4>
                      </div>
                      <div class="input-group">
                        <label for="username">Descrição</label>
                        <input type="text" name="p1" id="p1" />
                      </div>
                      <div class="input-group">
                        <label for="position">Descrição - 2</label>
                        <input type="text" name="p2" id="p1" />
                      </div>
                    </div>
                  </div>
                  <div class="">
                    <a href="#" class="btn btn-next width-50 ml-auto">Seguinte</a>
                  </div>
                </div>

                <div class="form-step">
                  <div class="row col-12">
                    <div class="input-group">
                      <h4 class=" text-uppercase">Contactos</h4>
                    </div>
                    {{-- <img src="{{url("/Sbadmin/img/step-true.png")}}" alt="" style="width: 100%;"> --}}

                    <div class="col-md-6">

                      <div class="input-group">
                        <label for="phone">Telefone</label>
                        <input type="text" name="telefone" id="telefone" />
                      </div>
                      <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" />
                      </div>
                      <div class="input-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" />
                      </div>
                    </div>
                    <div class="col-md-6">

                      <div class="input-group">
                        <label for="atendimento">Atendimento</label>
                        <input type="text" name="atendimento" id="atendimento" />
                      </div>
  
                      <div class="input-group">
                        <label for="pergunta">Questão</label>
                        <input type="text" name="pergunta" id="pergunta" />
                      </div>
  
                      <div class="input-group">
                        <label for="resposta">Resposta</label>
                        <input type="text" name="resposta" id="resposta" />
                      </div>
  
                    </div>
                  </div>
                  <div class="btns-group">
                    <a href="#" class="btn btn-prev">Voltar</a>
                    <a href="#" class="btn btn-next">Seguinte</a>
                  </div>
                </div>

                <div class="form-step">
                  <div class="row col-12">
                    <div class="col-md-6">
                      <h4 class=" text-uppercase">Caracteristica da sua empresa</h4>

                      <div class="input-group">
                        <label for="detalhe">Caracteristica</label>
                        <input type="text" name="detalhe" id="detalhe" />
                      </div>

                      <div class="input-group">
                        <label for="descriptionDetalhe">Descrição da Caracteristica</label>
                        <input type="text" name="descriptionDetalhe" id="descriptionDetalhe" />
                      </div>
                    </div>

                  <div class="col-md-6">
                      <h4 class=" text-uppercase mb-5">Cores do Website</h4>

                  <div class="form-group">
                        <label class="form-label">Selecione uma cor Backgroud</label>
                        <input type="color" name="codigo" class="form-control form-control-color">
                  </div>

                  <div class="form-group">
                      <label class="form-label">Selecionar cor das letras</label>
                      <input type="color" name="color" class="form-control form-control-color">
                  </div>

                    </div>
                  </div>
                  <div class="btns-group">
                    <a href="#" class="btn btn-prev">Voltar</a>
                    <a href="#" class="btn btn-next">Seguinte</a>
                  </div>
                </div>
                <div class="form-step">
                  <h4 class=" text-uppercase">Carregar Imagem de Fundo</h4>
                  <div class="input-group">
                    <label for="fundo">Carregar Imagem de Fundo</label>
                    <input type="file" name="fundo" id="fundo" />
                  </div>
                  
                  <div class="form-group">
                    <label class="form-label" for="seccao">Secção</label>
                    <select name="seccao" class="form-control">
                      <option value="Start">Inicial</option>
                      <option value="About">Sobre</option>
                      <option value="Aboutp">Detalhes Sobre</option>
                    </select>
                  </div>

                  <div class="btns-group">
                    <a href="#" class="btn btn-prev">Antes</a>
                    <input type="submit" value="Finalizar" class="btn" />
                  </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const prevBtns = document.querySelectorAll(".btn-prev");
    const nextBtns = document.querySelectorAll(".btn-next");
    const progress = document.getElementById("progress");
    const formSteps = document.querySelectorAll(".form-step");
    const progressSteps = document.querySelectorAll(".progress-step");
    
    let formStepsNum = 0;
    
    nextBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        formStepsNum++;
        updateFormSteps();
        updateProgressbar();
      });
    });
    
    prevBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        formStepsNum--;
        updateFormSteps();
        updateProgressbar();
      });
    });
    
    function updateFormSteps() {
      formSteps.forEach((formStep) => {
        formStep.classList.contains("form-step-active") &&
          formStep.classList.remove("form-step-active");
      });
    
      formSteps[formStepsNum].classList.add("form-step-active");
    }
    
    function updateProgressbar() {
      progressSteps.forEach((progressStep, idx) => {
        if (idx < formStepsNum + 1) {
          progressStep.classList.add("progress-step-active");
        } else {
          progressStep.classList.remove("progress-step-active");
        }
      });
    
      const progressActive = document.querySelectorAll(".progress-step-active");
    
      progress.style.width =
        ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
    }
      </script>