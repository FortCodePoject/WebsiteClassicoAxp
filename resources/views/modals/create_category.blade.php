<div wire:ignore.self 
class="modal fade" 
id="addcategory{{ $editMode && isset($category['reference']) ? $category['reference'] : '' }}" 
tabindex="-1" 
role="dialog" 
aria-labelledby="exampleModalLabel" 
aria-hidden="true">

    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{$editMode ?  "Editar" : "Cadastrar"}} Categoria</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <h5 for="" class="form-label">Categoria</h5>
            <input class="form-control" type="text" placeholder="Insira o nome da categoria" wire:model="description">
          </div>
          
        </div>

        <div class="card-footer">
          <div class="form-group">
            <button wire:click="createCategory()" class="btn btn-primary">Cadastrar</button>
          </div>
        </div>

      </div>
    </div>
</div>