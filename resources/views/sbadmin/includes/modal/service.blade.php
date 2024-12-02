<div class="modal fade" id="staticBackdrop{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Serviço</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="">
                <form action="{{route("admin.update.service", $item->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nome do serviço</label>
                        <input type="text" class="form-control" name="title" placeholder="Insira o nome de um serviço..." value="{{$item->title}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Descrição: </label>
                        <input type="text" class="form-control" name="description" placeholder="Descreva o seu serviço..." value="{{$item->description}}">
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