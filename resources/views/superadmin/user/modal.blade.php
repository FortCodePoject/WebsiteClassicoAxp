<!-- Modal -->
<div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5 text-black" id="exampleModalLabel">Actualizar utilizador</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-dark">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nome da Empresa</label>
                    <input type="text" name="name" class="form-control" placeholder="Insira o nome da empresa...">
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Insira o email...">
                </div>

                <div class="form-group">
                    <label class="form-label">NIF</label>
                    <input type="text" name="nif" class="form-control" placeholder="Insira o nif...">
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo de Negócio</label>
                    <input type="text" name="type" class="form-control" placeholder="Insira o tipo de negócio...">
                </div>
            
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>