<div class="modal fade" id="staticBackdrop{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Footer</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="">
                <form action="{{route("admin.contact.update", $item->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" name="telefone" placeholder="Insira o seu contacto.." value="{{$item->telefone}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Insira o seu email.." value="{{$item->email}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="endereco" placeholder="Insira o seu endereço.." value="{{$item->endereco}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Destaque</label>
                        <input type="text" class="form-control" name="atendimento" placeholder="Insira uma frase em destaque.." value="{{$item->atendimento}}">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>