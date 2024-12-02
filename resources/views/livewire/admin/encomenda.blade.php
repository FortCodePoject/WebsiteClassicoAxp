<div class="col-md-12">
    <table class="table table-striped table-responsive-md">
        <thead class="bg-primary text-white">
          <tr>
            <th scope="col">Cliente</th>
            <th scope="col">Endereço</th>
            <th scope="col">Tel</th>
            <th scope="col">Pagamento</th>
            <th scope="col">Total</th>
            <th scope="col">Estado</th>
            <th scope="col">Acções</th>
          </tr>
        </thead>
        <tbody>
            @if (isset($deliveries))
                @foreach ($deliveries as $delivery)
                    @if (isset($delivery->delivery))
                        <tr>
                            <th scope="row">{{$delivery->delivery->client}}</th>
                            <th scope="row">{{$delivery->delivery->address}}</th>
                            <th scope="row">{{$delivery->delivery->phone}}</th>
                            <th scope="row">{{$delivery->delivery->isPaid}}</th>
                            <th scope="row">{{$delivery->delivery->total}}</th>
                            <th scope="row">
                                @if ($delivery->delivery->status == 'PENDENTE')
                                    <span wire:click="updateStatus({{$delivery->delivery->reference}}, 'estado')" style="cursor: pointer;font-size:15px;font-weight:bold" class="badge badge-info p-2">
                                        <i class="fa fa-spinner fa-spin-pulse"></i>
                                        {{$delivery->delivery->status}}
                                    </span>
                                @elseif ($delivery->delivery->status == 'ACEITE')
                                    <span style="cursor: pointer;font-size:15px;font-weight:bold" class="badge badge-success p-2">
                                        <i class="fa fa-spinner fa-spin-pulse"></i>
                                        {{$delivery->delivery->status}}
                                    </span>
                                @else
                                    <span style="cursor: pointer;font-size:15px;font-weight:bold" class="badge badge-danger p-2">
                                        <i class="fa fa-spinner fa-spin-pulse"></i>
                                        Estado Nulo
                                    </span>
                                @endif
                            </th>
                            <th scope="row">
                                <button title="Download do Recibo de pagamento" wire:click="download({{$delivery->delivery->reference}})" class="btn btn-sm" style="background-color: #222831; color:#ffff;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                    </svg>
                                </button>
                                <button data-toggle='modal' data-target='#detail' wire:click="deliveryItens({{$delivery->delivery->reference}})" class="btn btn-sm" style="background-color: #222831; color:#ffff;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                    </svg>
                                </button>
                            </th>
                        </tr>
                    @else
                        <tr>
                            <td colspan="12">
                                <div class="col-md-12 d-flex justify-content-center align-items-center flex-column" style="height: 60vh">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                    <h2 class="text-muted">Nenhuma Encomenda Encontrada</h2>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td>
                        <div class="col-md-12 d-flex justify-content-center align-items-center flex-column" style="height: 25vh">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                            <p class="text-muted">Nenhuma Encomenda Encontrada</p>
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
      </table>
      @include("livewire.admin.detail")
</div>