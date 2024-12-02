<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Dados Pessoais e Historicos</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="">
                <form action="{{route("admin.about.update", $item->id)}}" method="post">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <div class="form-group col-xl-6">
                            <label class="form-label">Nome:</label>
                            <input type="text" class="form-control" name="nome" placeholder="Insira o seu nome..." value="{{$item->nome}}">
                        </div>

                        <div class="form-group col-xl-6">
                            <label class="form-label">Profissão:</label>
                            <input type="text" class="form-control" name="perfil" placeholder="Insira o seu nome..." value="{{$item->perfil}}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-group col-xl-6">
                            <label class="form-label">Descrição:</label>
                            <textarea name="p1" class="form-control" id="" cols="30" rows="5" placeholder="Insira uma breve Descrição...">{{$item->p1}}</textarea>
                        </div>

                        <div class="form-group col-xl-6">
                            <label class="form-label">Descrição 1:</label>
                            <textarea name="p2" class="form-control" id="" cols="30" rows="5" placeholder="Insira uma breve Descrição...">{{$item->p2}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Actualizar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
  