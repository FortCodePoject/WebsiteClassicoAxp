<!-- Modal -->
<div class="modal fade" id="companyedit{{$company->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Editar Empresa</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route("super.admin.update.empresa")}}">
                @csrf
                <input type="hidden" name="id" value="{{$company->id}}">
                <div class="form-group">
                    <label class="form-label">Nome da Empresa</label>
                    <input type="text" value="{{$company->companyname}}" name="name" class="form-control" placeholder="Insira o nome da empresa...">
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" value="{{$company->companyemail}}" name="email" class="form-control" placeholder="Insira o email...">
                </div>

                <div class="form-group">
                    <label class="form-label">NIF</label>
                    <input type="text" value="{{$company->companynif}}" name="nif" class="form-control" placeholder="Insira o nif...">
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo de Negócio</label>
                    <input type="text" value="{{$company->companybusiness}}" name="type" class="form-control" placeholder="Insira o tipo de negócio...">
                </div>

                <div class="form-group">
                    <label class="form-label">Token API</label>
                    <input type="text" name="apitoken" class="form-control" placeholder="Insira o token da api...">
                </div>
            
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>