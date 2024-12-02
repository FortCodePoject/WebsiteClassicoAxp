<!-- Modal -->
<div class="modal fade" id="createImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Criar Pacote</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route("super.admin.generate.image.save")}}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nome do Pacote</label>
                    <input type="text" name="name" class="form-control" placeholder="Insira o nome do pacote...">
                </div>

                <div class="form-group">
                    <label class="form-label">Quantidade</label>
                    <input type="text" name="qtd" class="form-control" placeholder="Insira a quantidade de imagens a serem geradas...">
                </div>

                <div class="form-group">
                    <label class="form-label">Preço</label>
                    <input type="text" name="price" class="form-control" placeholder="Insira o preço...">
                </div>

                <div class="form-group">
                    <label class="form-label">Descrição</label>
                    <input type="text" name="description" class="form-control" placeholder="Insira uma descrição...">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            </form>
        </div>
      </div>
    </div>
</div>