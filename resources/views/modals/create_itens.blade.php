<div wire:ignore.self class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header bg-primary text-white">
              <h5 class="modal-title text-uppercase" id="exampleModalLabel">
                  {{ $editing ? 'Editar Item' : 'Cadastrar Novo Item' }}
              </h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
              <div class="form-group">
                  <h5 for="image" class="form-label">Imagem</h5>
                  <input class="form-control" type="file" wire:model="image">
                  @error('image') <span class="text-danger">{{ $message }}</span> @enderror
              </div>

              <div class="form-group">
                  <h5 for="category_id" class="form-label">Categoria</h5>
                  <select class="form-control" wire:model="category_id">
                      <option>Selecione a categoria</option>
                      @if (isset($categories) and count($categories) > 0)
                        @foreach ($categories as $category)
                            <option value="{{ $category['category'] ?? '' }}">{{ $category['category'] ?? '' }}</option>
                        @endforeach
                      @endif
                  </select>
                  @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
              </div>

              <div class="form-group">
                  <h5 for="description" class="form-label">Nome do Item</h5>
                  <input class="form-control" type="text" placeholder="Insira o nome do item" wire:model="description">
                  @error('description') <span class="text-danger">{{ $message }}</span> @enderror
              </div>

              <div class="form-group">
                  <h5 for="longDescription">Descrição</h5>
                  <textarea wire:model="longdescription" class="form-control" id="longDescription" cols="30" rows="2"></textarea>
                  @error('longdescription') <span class="text-danger">{{ $message }}</span> @enderror
              </div>

              <div class="form-group">
                  <h5 for="price" class="form-label">Preço</h5>
                  <input class="form-control" min="1" type="number" placeholder="Insira o preço" wire:model="price">
                  @error('price') <span class="text-danger">{{ $message }}</span> @enderror
              </div>

              <div class="form-group">
                  <h5 for="qtd" class="form-label">Quantidade</h5>
                  <input class="form-control" min="1" type="number" placeholder="Quantidade" wire:model="qtd">
                  @error('qtd') <span class="text-danger">{{ $message }}</span> @enderror
              </div>

          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <button wire:click.prevent="{{ $editing ? 'updateItem' : 'createItem' }}" type="button" class="btn btn-primary">
                  {{ $editing ? 'Salvar Alterações' : 'Salvar' }}
              </button>
          </div>

      </div>
  </div>
</div>