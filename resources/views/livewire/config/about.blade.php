<div>
    <h3>Sobre Mim</h3>
    <hr>

    <form wire:submit.prevent="{{ $editMode ? 'updateAbout' : 'storeAbout' }}">
        <div class="form-group">
            <h5 class="form-label">Nome:</h5>
            <input type="text" class="form-control" wire:model="nome" name="nome" placeholder="Insira o seu nome...">
            @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <h5 class="form-label">Profissão:</h5>
            <input type="text" class="form-control" wire:model="perfil" name="perfil" placeholder="Insira a sua profissão...">
            @error('perfil') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <div class="form-group">
                <h5 class="form-label">Descrição:</h5>
                <textarea name="p1" wire:model="p1" class="form-control" cols="30" rows="4" placeholder="Insira uma breve descrição..."></textarea>
                @error('p1') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <h5 class="form-label">Descrição 1:</h5>
                <textarea name="p2" wire:model="p2" class="form-control" cols="30" rows="4" placeholder="Insira uma segunda descrição..."></textarea>
                @error('p2') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ $editMode ? 'Atualizar' : 'Cadastrar' }}</button>
        </div>
    </form>

    <!-- Lista de registros já cadastrados -->
    @if($getAbout->isNotEmpty())
        <hr>
        @foreach ($getAbout as $item)
            <div class="form-group">
                <label class="form-label">Nome: </label>
                <h5>{{ $item->nome }}</h5>
            </div>

            <div class="form-group">
                <label class="form-label">Perfil: </label>
                <h5>{{ $item->perfil }}</h5>
            </div>

            <div class="form-group">
                <label class="form-label">Descrição: </label>
                <p>{{ $item->p1 }}</p>
            </div>

            <div class="form-group">
                <p>{{ $item->p2 }}</p>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" wire:click="editAbout({{ $item->id }})">Editar</button>
                <button class="btn btn-danger" wire:click="deleteAbout({{ $item->id }})">Excluir</button>
            </div>
        @endforeach
    @endif
</div>