<div>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <main id="main" style="margin-top: 10rem;">
        <section class="shopping-cart spad">
            <div class="container-fluid px-3 px-md-3 px-lg-4">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping__cart__table">
                            <table>
                                <thead style="background: var(--background)">
                                    <tr class="p-5 m-5">
                                        <th>Produto</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th>Total</th>
                                        <th class="text-center">Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cartContent as $item)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">

                                                    @if ($item->attributes['image'] != null)
                                                        <img style="width: 80px"
                                                            src="{{ Storage::url("items/{$item->attributes['image']}") }}"
                                                            class="img-fluid" alt="">
                                                    @else
                                                        <img style="width: 80px" src="{{ asset('notfound.svg') }}"
                                                            class="img-fluid" alt="">
                                                    @endif

                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $item->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="cart__price">
                                                {{ number_format($item->price, 2, ',', '.') }} kz
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity-container">
                                                    {{-- <button class="quantity-btn" >-</button> --}}
                                                    <input type="number" min="1"
                                                        wire:change="updateQuantity('{{ $item->name }}','{{ $item->id }}')"
                                                        type="text" wire:model="qtd.{{ $item->id }}"
                                                        wire:key="{{ $item->id }}" class="quantity-input"
                                                        value="{{ $item->quantity }}" id="quantity">
                                                    {{-- <button class="quantity-btn" wire:click="increaseQuantity('{{$item->name}}','{{$item->id}}')">+</button> --}}
                                                </div>
                                            </td>
                                            <td class="cart__price">
                                                {{ number_format($item->price * $item->quantity, 2, ',', '.') }} kz
                                            </td>
                                            <td class="cart__close text-center">
                                                <button wire:click='remove({{ $item->id }})'
                                                    style="color: red; border: none; backgound: #fff">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                        height="25" fill="currentColor" class="bi bi-trash3-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">
                                                <div class="col-md-12 d-flex justify-content-center align-items-center flex-column"
                                                    style="height: 25vh">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                        height="25" fill="currentColor" class="bi bi-caret-down-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                                    </svg>
                                                    <p class="text-muted">Nenhum Item selecionado no carrinho</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart__discount">
                            <form wire:submit.prevent='cuponDiscount'>
                                <input required type="text" wire:model="code" name="cupon"
                                    placeholder="Insira o codigo do cupon">
                                <button type="submit"
                                    style="background: var(--background); color:#fff; border: none;">Aplicar</button>
                            </form>
                        </div>
                        <div class="cart__total">
                            <div class="line">
                                <h6>Total do Carrinho</h6>
                            </div>
                            <ul>
                                <li>Subtotal <span id="subtotal">{{ number_format(abs($getSubTotal), 2, ',', '.') }}
                                        Kz</span></li>
                                <li>Taxa PB <span>{{ number_format($taxapb, 2, ',', '.') }} Kz</span> </li>
                                <li>Total <span
                                        id="total">{{ number_format($totalFinal - session('discountvalue'), 2, ',', '.') }}
                                        kz</span></li>
                                <li>Taxa de Entrega 
                                    <span id="total">{{number_format($localizacao, 2, ',', '.')}} kz</span>
                                </li>
                            </ul>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Local de entrega</label>
                                @if (isset($locationMap) and count($locationMap) > 0)
                                    <select class="form-control selectLocation2" id="location-select">
                                            <option value="">--Selecionar--</option>
                                        @foreach ($locationMap as $locationValue)
                                            <option value="{{ $locationValue['location'] }}">{{ $locationValue['location'] }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            
                            @if (isset($verifyQuantity) && $verifyQuantity > 0)
                                <button type="button" class="primary-btn btn btn-primary mt-2"
                                    style="background: var(--background); color:#fff; border: none;"
                                    data-bs-toggle="modal" data-bs-target="#checkout" id="getLocationBtn">Finalizar Compra</button>
                                @include('pages.shopping.finalizar.App')
                            @else
                                <button wire:click="verifyStockWithProvider" type="button"
                                    class="primary-btn btn btn-primary mt-2"
                                    style="background: var(--background); color:#fff; border: none;">Verificar Com
                                    Artista</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include("modals.location")
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</div>

{{-- //get location latitude in longitude in client --}}
{{-- <script>
    const button = document.getElementById('getLocationBtn');
    const output = document.getElementById('output');

    button.addEventListener('click', () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    output.innerText = `Latitude: ${latitude}, Longitude: ${longitude}`;
                },
                (error) => {
                    output.innerText = `Error: ${error.message}`;
                }
            );
        } else {
            output.innerText = "Geolocation is not supported by this browser.";
        }
    });
</script> --}}

@push('preloader')
    <script>
        document.addEventListener('isVerifyed', function() {
            //@this.sendPushNotification()
            let timerInterval;
            Swal.fire({
                title: "A PROCESSAR",
                html: "A verificar estoque com Artista <br /> Aguardar porfavor... <br /> <b></b>",
                timer: 180000,
                allowOutsideClick: false,
                customClass: "swal2-shown",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Math.abs(Swal.getTimerLeft())}`;
                        @this.isProductVerifyed().then(function(response) {
                            if (response != 0) {
                                @this.Verifyed()
                                location.reload()
                            }
                        })

                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);

                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    //@this.Verifyed()
                }
            });

        });

        const isTrue = () => {
            //@this.isConfirmed()
        }
    </script>
    <script>
    @endpush
