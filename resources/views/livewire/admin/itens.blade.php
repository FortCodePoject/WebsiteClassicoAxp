<div class="col-md-12">
    <div class="card border-0 mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header bg-primary py-3 flex-row align-items-center justify-content-between col-xl-12">
            <div class="col-xl-12 d-flex justify-content-between">
                <div>
                    <h5 class="card-title m-0 font-weight-bold text-white">Item</h5>
                </div>
                <div>
                    <button class="btn" style="background: #fff" data-toggle="modal" data-target="#additem">Adicionar</button>
                </div> 
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <table class="table table-striped table-responsive-md">
                <thead class="text-white" style="background: rgb(0, 74, 222)">
                  <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acções</th>
                  </tr>
                </thead>
                <tbody>
                    @if (!empty($getItens) && count($getItens) > 0)
                        @foreach ($getItens as $item)
                            @if (is_array($item) && isset($item['reference']))
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['category'] }}</td>
                                    <td>{{ number_format($item['price'], 2, '.', ',') }} kz</td>
                                    <td>
                                        <span class="{{ $item['status'] === 'DISPONIVEL' ? 'bg-primary text-light' : 'bg-danger text-light' }} p-1 rounded">
                                            {{ $item['status'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#additem" wire:click="editItem('{{ $item['reference'] }}')">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" wire:click="deleteItem('{{ $item['reference'] }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @else
                                
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <div class="col-md-12 d-flex justify-content-center align-items-center flex-column" style="height: 60vh">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                    <h2 class="text-muted no-items-message">Nenhum Item Cadastrado</h2>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    {{-- modal Start --}}
    @include("modals.create_itens")
    {{-- modal End --}}
</div>