<div wire:ignore.self class="modal fade" id="detail{{$item['reference'] ?? ''}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                @if (!empty($item['image']))
                    <img src="{{ Storage::url("items/{$item['image']}") }}" class="img-fluid product-thumbnail">
                @else 
                    <img src="{{asset("site/img/portfolio/app-1.png")}}" class="menu-img img-fluid" alt="">
                @endif
                </div>
                <div class="col-md-6">
                    <div class="card border-0">
                      <div class="card-body">
                        <h5 class="card-title">{{$item['name'] ?? ''}}</h5>
                        <p>{{ $item['description'] ?? ''}}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">

            <div>
                <h4 class="text-danger">{{ number_format($item['price'], 2,'.', '.' ?? '') }} kz</h4>
            </div>

            <button 
              wire:click="addToCart('{{ $item['name'] ?? ''}}')" 
              class="btn btn-primary mx-2 border-0" 
              style="background-color: #E71D1D;">
              <span class="bi bi-cart-plus-fill text-white"></span> Adicionar
            </button>
        </div>
      </div>
    </div>
</div>