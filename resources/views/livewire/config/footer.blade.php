<div>
    <div class="d-flex">
        <div><h3>Rodapé</h3></div>
        <div class="form-group mx-4">
            <button class="btn btn-primary px-4" wire:click="toggleEditMode()">
                {{ $isEditing ? 'Cancelar' : 'Editar' }}
            </button>
            @if ($isEditing)
                <button class="btn btn-success px-4 mx-2" wire:click="save()">Salvar</button>
            @endif
        </div>
    </div>
    <hr>    

    <div class="form-group">
        <h5 class="form-label">Telefone</h5>
        <input type="text" class="form-control" wire:model.defer="telefone" {{ $isEditing ? '' : 'disabled' }} placeholder="Insira o seu contacto..">
        @error('telefone') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <h5 class="form-label">Email</h5>
        <input type="email" class="form-control" wire:model.defer="email" {{ $isEditing ? '' : 'disabled' }} placeholder="Insira o seu email..">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <h5 class="form-label">Endereço</h5>
        <input type="text" class="form-control" wire:model.defer="endereco" {{ $isEditing ? '' : 'disabled' }} placeholder="Insira o seu endereço..">
        @error('endereco') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <h5 class="form-label">Destaque</h5>
        <input type="text" class="form-control" wire:model.defer="atendimento" {{ $isEditing ? '' : 'disabled' }} placeholder="Insira uma frase em destaque..">
        @error('atendimento') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

</div>
