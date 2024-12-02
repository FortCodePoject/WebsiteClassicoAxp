<div wire:ignore.self data-backdrop='static' class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">Detalhes de Encomenda</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if (isset($itens) and count($itens) > 0)
            @foreach ($itens as $Item)
              <span class="text-uppercase fw-bold">Endereço de Entrega : {{$Item->delivery->address}}</span> <br>
            @endforeach
          @endif
            
          <div class="table-responsive mt-3">
            <table class="table-striped table-hover table">
              <thead class="bg-primary text-white">
                <tr>
                  <th>Item</th>
                  <th>Preço</th>
                  <th>Qtd.</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @if (isset($itens) and count($itens) > 0)
                @foreach ($itens as $Item)
                  @foreach ($Item->products as $itens)
                    <tr>
                      <td scope="row">{{$itens->item}}</td>
                      <td scope="row">{{$itens->price}}</td>
                      <td scope="row">{{$itens->quantity}}</td>
                      <td scope="row">{{$itens->subtotal}}</td>
                    </tr>
                  @endforeach
                @endforeach
                @else
                  <tr>
                      <td colspan="12">
                          <div class="col-md-12 d-flex justify-content-center align-items-center flex-column" style="height: 25vh">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                              </svg>
                              <p class="text-muted">Nenhum Item Encontrado</p>
                          </div>
                      </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    