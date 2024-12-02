<div class="modal fade" id="staticBackdrop{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Serviço</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="">
                <form action="{{route("admin.infowhy.update", $item->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nome do Projecto:</label>
                        <input type="text" class="form-control" name="title" placeholder="Insira o nome dpo projecto..." value="{{$item->title}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Fotografia</label>
                        <input type="file" name="image" class="form-control">
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