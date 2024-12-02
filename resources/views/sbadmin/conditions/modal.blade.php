<!-- Modal -->
<div class="modal fade" id="conditions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="exampleModalLabel">Termos e Condições</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route("admin.conditions.create")}}" method="post">
            @csrf
            <div class="">
                <div class="form-group">
                    <label class="form-label">Escreva a sua Politica de privacidade</label>
                    <textarea name="privacy" class="form-control" placeholder="Insira uma descrição...."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Escreva o seu Termo de Condições</label>
                    <textarea name="condition" class="form-control" placeholder="Insira uma descrição...."></textarea>
                </div>
            </div>
            <style>
                textarea{
                    width: 35rem;
                    height: 100px;
                    margin: 10px;
                }
            </style>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Cadastrar">
       </div>
    </form>
        </div>
      </div>
    </div>
  </div>
  