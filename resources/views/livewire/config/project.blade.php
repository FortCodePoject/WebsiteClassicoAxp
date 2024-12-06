<div>
    <h3>Trabalhos</h3>
    <hr>
    <form wire:submit="storeOrUpdateProject" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <h5 class="form-label">Fotografia</h5>
            <input type="file" wire:model="image" name="image" class="form-control">
        </div>
        <div class="form-group">
            <h5 class="form-label">Nome do Projecto:</h5>
            <input type="text" class="form-control" wire:model="title" name="title" placeholder="Insira o nome do projecto...">
        </div>

        <!-- Campo oculto para ID do projeto (para edição) -->
        <input type="hidden" wire:model="projectId">

        <div class="form-group">
            <input type="submit" value="{{ $projectId ? 'Atualizar' : 'Adicionar' }}" class="btn btn-primary">
            <a class="btn btn-primary mx-2" onclick="openTab(event, 'footer')"> Proximo </a>
        </div>
    </form>

    <hr>

    <div class="table-responsive">
        <table class="table">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">Projecto</th>
                    <th scope="col">IMG</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($getproject))
                    @foreach ($getproject as $item)
                        <tr>
                            <td scope="row">{{$item->title}}</td>
                            <td><img src="{{ $item->image_url }}" alt="{{ $item->title }}" width="50"></td>
                            <td>
                                <button wire:click="edit({{ $item->id }})" class="btn btn-warning btn-sm">Editar</button>
                                <button wire:click="deleteproject({{ $item->id }})" class="btn btn-danger btn-sm">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">Nenhum projeto encontrado.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
        
</div>