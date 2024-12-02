<div>
    <h3>Competências</h3>
    <hr>

    <form wire:submit.prevent="habilityCriar">
        @csrf

        <!-- Campo Oculto para Edição -->
        <input type="hidden" wire:model="habilityId">

        <div class="form-group">
            <h5 class="form-label">Habilidade</h5>
            <input type="text" wire:model="hability" class="form-control" placeholder="Insira a habilidade..." required>
            @error('hability') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <h5 class="form-label">Percentagem</h5>
            <input type="number" wire:model="level" name="level" class="form-control" placeholder="Insira o número correspondente..." required min="0" max="100">
            @error('level') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ $habilityId ? 'Atualizar' : 'Adicionar' }}</button>
            <button class="btn btn-primary mx-3" onclick="openTab(event, 'about')"> Proximo </button>
        </div>
    </form>

    di

    <hr>
    
    <div class="table-responsive">
        <table class="table">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">Habilidade</th>
                    <th scope="col">Nível</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($gethability) && count($gethability))
                    @foreach ($gethability as $item)
                        <tr>
                            <td scope="row">{{ $item->hability }}</td>
                            <td scope="row">{{ $item->level }}%</td>
                            <td scope="row">
                                <button class="btn btn-warning" wire:click="editHability({{ $item->id }})">Editar</button>
                                <button class="btn btn-danger" wire:click="deleteHability({{ $item->id }})">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">Nenhuma habilidade cadastrada.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>