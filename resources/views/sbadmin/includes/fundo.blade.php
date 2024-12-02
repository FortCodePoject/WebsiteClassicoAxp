<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$item->id ?? ""}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Imagem</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="imagebackgroundupdate({{$item->id ?? ""}})" enctype="multipart/form-data">

                <div class="form-group">
                    <label class="form-label">Carregar Imagem</label>
                    <input type="file" wire:model="image" name="image" class="form-control" placeholder="Insira a informação...">
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo/Formato</label>
                    <select wire:model="tipo" class="form-control" name="tipo" id="" disabled="disabled">
                        <option value=""></option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>