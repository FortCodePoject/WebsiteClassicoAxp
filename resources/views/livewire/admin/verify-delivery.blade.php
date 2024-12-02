<div class="col-md-12" wire:poll>
    <div class="card mb-4 border-0">
        <!-- Card Header - Dropdown -->
        <div class="card-header bg-primary py-3 flex-row align-items-center justify-content-between col-xl-12">
            <div class="col-xl-12 d-flex justify-content-between">
                <div>
                    <h5 class="card-title m-0 font-weight-bold text-white"> Verificação de Encomenda </h5>
                </div>
                <div>
                    <span class="btn-light p-2 rounded" wire:click="alterStatus" style="cursor: pointer;">Confirmar</span>
                </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <table class="table table-striped table-responsive-md">
                <thead class="text-white" style="background: rgb(0, 74, 222)">
                  <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Quantidade Solicitada</th>
                    <th scope="col">Quantidade Disponivel</th>
                    <th scope="col">Estado</th>
                  </tr>
                </thead>
                <tbody>
                    @if (isset($stockDelivery) && count($stockDelivery) > 0)
                        @foreach ($stockDelivery as $item)
                            <tr>
                                <td>{{$item->product}}</td>
                                <td>{{ number_format($item->price ?? 0, 2, ',', '.') }} kz</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                    <input type="number" wire:model="qtd.{{$item->id}}" value="{{$item->availableQuantity}}">
                                </td>
                                <td> 
                                    <select wire:model="status.{{$item->id}}" class="form-control">
                                        <option >Disponibilidade Do Produto</option>
                                        <option value="0"> INDISPONIVEL </option>
                                        <option value="1">  DISPONIVEL </option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">
                                <div class="col-md-12 d-flex justify-content-center align-items-center flex-column" style="height: 60vh">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                    <h2 class="text-muted">Nenhuma encomenda por verificar</h2>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>