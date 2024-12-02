<div>
    <h3>Serviços</h3>
    <hr>

    <!-- Formulário para Cadastrar ou Editar Serviços -->
    <form wire:submit.prevent="{{ $editMode ? 'updateService' : 'storeService' }}">
        <div class="form-group">
            <h5 class="form-label">Nome do serviço</h5>
            <input type="text" class="form-control" wire:model="title" name="title" placeholder="Insira o nome de um serviço...">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <h5 class="form-label">Descrição:</h5>
            <input type="text" class="form-control" wire:model="description" name="description" placeholder="Descreva o seu serviço...">
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ $editMode ? 'Atualizar' : 'Cadastrar' }}</button>
        </div>
    </form>

    <hr>
    
    <!-- Tabela de Serviços -->
    <div class="table-responsive">
        <table class="table">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">Serviço</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($getService as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <button class="btn btn-primary" style="width: 100px" wire:click="editService({{ $item->id }})">Editar</button>
                            <button class="btn btn-danger" style="width: 100px" wire:click="deleteService({{ $item->id }})">Excluir></i></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Nenhum serviço encontrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
