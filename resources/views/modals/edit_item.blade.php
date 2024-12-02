<div wire:ignore.self class="modal fade" id="editItem{{$item['reference'] ?? ''}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">Editar Item</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="" class="form-label">Categoria</label>
            <select disabled class="form-control" wire:model="category_id">
                <option value=""></option> 
            </select>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Nome do Item</label>
            <input class="form-control" type="text" placeholder="Insira o nome do item" wire:model="description">
          </div>

          <div class="form-group">
            <label for="longDescription">Descrição</label>
            <textarea wire:model="longdescription" class="form-control" id="longDescription" cols="30" rows="2"></textarea>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Imagem</label>
            <input class="form-control" type="file" wire:model="image">
          </div>

          <div class="form-group">
            <label for="" class="form-label">Preço</label>
            <input class="form-control" min="1" type="number" placeholder="Insira o preço" wire:model="price">
          </div>

          <div class="form-group">
            <label for="" class="form-label">Quantidade</label>
            <input class="form-control" min="1" type="number" placeholder="Quantidade" wire:model="qtd">
          </div>

        </div>

        <div class="card-footer">
          <div class="form-group">
            <button wire:click="" class="btn btn-primary">Salvar</button>
          </div>
        </div>

      </div>
    </div>
</div>