<div class="modal fade" id="staticBackdrop{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Serviço</h4>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="">
              <form action="{{route("admin.detalhes.update", $item->id)}}" method="post">

                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Elementos</label>
                    <input type="text" class="form-control" name="elements" value="{{$item->elements}}" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label">Quantidade</label>
                    <input type="text" value="{{$item->level}}" name="level" class="form-control" placeholder="Insira o numero correspondente...">
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