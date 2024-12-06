<div>
    <style>
        input{
            box-shadow: none !important;
            border: 1px solid #000;
        }
    </style>
    <div class="form-group d-flex">
        <h3>Sobre Mim</h3>
        <button class="btn px-4 mx-2 {{ $editMode ? 'btn-danger' : 'btn-primary' }}" wire:click="toggleEditMode()">
            {{ $editMode ? 'Cancelar' : 'Editar' }}
        </button>

        @if ($editMode)
            <button class="btn btn-success px-4 mx-2" wire:click="save()">Salvar</button>
        @endif
        <button class="btn btn-primary mx-2" onclick="openTab(event, 'service')"> Proximo </button>

    </div>
    <hr>

    <form wire:submit.prevent="{{ $editMode ? 'updateAbout' : 'storeAbout' }}">
        <div class="form-group">
            <h5 class="form-label">Nome:</h5>
            <input type="text" class="form-control" {{ $editMode ? '' : 'disabled' }} wire:model.defer="nome" name="nome" placeholder="Insira o seu nome...">
            @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <h5 class="form-label">Profissão:</h5>
            <input type="text" class="form-control" {{ $editMode ? '' : 'disabled' }} wire:model.defer="perfil" name="perfil" placeholder="Insira a sua profissão...">
            @error('perfil') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <div class="form-group">
                <h5 class="form-label">Descrição:</h5>
                <textarea name="p1" wire:model.defer="p1" {{ $editMode ? '' : 'disabled' }} class="form-control" cols="30" rows="4" placeholder="Insira uma breve descrição..."></textarea>
                @error('p1') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <h5 class="form-label">Descrição 1:</h5>
                <textarea name="p2" wire:model.defer="p2" {{ $editMode ? '' : 'disabled' }} class="form-control" cols="30" rows="4" placeholder="Insira uma segunda descrição..."></textarea>
                @error('p2') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </form>
</div>