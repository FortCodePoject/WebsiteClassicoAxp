<!-- Modal -->
<div wire:ignore.self class="modal fade" id="staticBackdrop{{ $item->id }}" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Atualizar Meus Dados</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updateHero({{ $item->id }})" enctype="multipart/form-data">
                    
                    <div class="form-group mt-3">
                        <h5 class="form-label">Fotografia do perfil</h5>
                        <input type="file" wire:model="image" class="form-control">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <h5 class="form-label">Título</h5>
                        <input type="text" wire:model="title" class="form-control" placeholder="Insira a informação...">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <h5 class="form-label">Descrição</h5>
                        <textarea wire:model="description" class="form-control" cols="30" rows="8" placeholder="Insira uma descrição..."></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
