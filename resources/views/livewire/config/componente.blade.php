<div>
    <h3>Componentes</h3>
    <hr>
    <!-- Formulário -->
    <form wire:submit.prevent="storeOrUpdateComponent">
        <div class="form-group">
            <select wire:model="elements" name="elements" class="form-control">
                <option >Escolha a temática</option>
                <option value="Trabalhos">Trabalhos Concluídos</option>
                <option value="Experiência">Anos de Experiência</option>
                <option value="Clientes">Total de Clientes</option>
                <option value="Premios">Prêmios</option>
            </select>
        </div>

        <div class="form-group">
            <h5 for="level" class="form-label">Quantidade</h5>
            <input type="text" wire:model="level" id="level" name="level" class="form-control" placeholder="Insira o número correspondente..." required>
            @error('level') <!-- Exibe erro caso haja validação -->
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Campo oculto para o ID do componente (para edição) -->
        <input type="hidden" wire:model="selectedComponentId">

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ $selectedComponentId ? 'Atualizar' : 'Adicionar' }}</button>
        </div>
    </form>

    <hr>

    <!-- Tabela de Componentes -->
    <div class="table-responsive">
        <table class="table">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">Elemento</th>
                    <th scope="col">Nível</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($getComponents as $item)
                    <tr wire:key="component-{{ $item->id }}">
                        <td>{{ $item->elements }}</td>
                        <td>{{ $item->level }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="editComponent({{ $item->id }})">Editar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Nenhum componente encontrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modais (incluir fora da tabela) -->
    @foreach ($getComponents as $item)
        @include("sbadmin.includes.modal.skill", ['item' => $item])
    @endforeach
</div>