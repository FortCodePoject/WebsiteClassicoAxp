<div>
    <main id="main" style="margin-top: 5rem;">
        <section class="shopping-cart spad">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping__cart__table">
                            <table>
                                <thead style="background: #6081E1;">
                                    <tr class="p-5 m-5">
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Total</th>
                                        <th class="text-center">Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartContent as $item)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    @if ($item->attributes['image'] != null)
                                                        <img style="width: 80px"
                                                            src="https://kytutes.com/storage/{{ $item->attributes['image'] }}"
                                                            class="img-fluid" alt="">
                                                    @else
                                                        <img style="width: 80px" src="/storage/notfound.png"
                                                            class="img-fluid" alt="">
                                                    @endif
                                                </div>

                                                <div class="product__cart__item__text">
                                                    <h6>{{ $item->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input class="quantity-input" type="number" value="{{ $item->quantity }}" min="1" wire:change="updateQuantity('{{ $item->id }}', $event.target.value)">
</td>                                               </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">
                                                {{ number_format($item->price * $item->quantity, 2, ',', '.') }} Kz</td>
                                            <td class="cart__close text-center">
                                                {{-- <a href="{{ route('cart.remove', $item->id) }}" style="color: red;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                        height="25" fill="currentColor" class="bi bi-trash3-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                    </svg>
                                                </a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="{{route("loja.online")}}" style="border: 1px solid #6081E1;">Continuar
                                        Comprar</a>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <a href="#" style="background: #F4C400; color:#fff; border: none;"><i
                                            class="fa fa-spinner"></i>Actualizar Carrinho</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart__discount">
                            <form wire:submit.prevent='cuponDiscount'>
                                <input required type="text" wire:model="code" name="cupon" placeholder="Insira o codigo do cupon">   
                                <button  type="submit" style="background: #6081E1; color:#fff; border: none;">Aplicar</button>
                            </form>
                        </div>
                        <div class="cart__total">
                            <div class="line">
                                <h6>Total do Carrinho</h6>
                            </div>
                            <ul>
                                <li>Subtotal <span id="subtotal">{{ number_format(abs($getSubTotal), 2, ',', '.') }} Kz</span></li>
                                <li>Taxa PB <span>{{ number_format($taxapb, 2, ',', '.') }} Kz</span> </li>
                                <li>Total <span id="total">{{number_format($totalFinal - session("discountvalue"), 2, ',', '.')}} kz</span></li>
                            </ul>

                            <button  id="getLocationButton" class="primary-btn btn btn-primary mt-2"
                                style="background:#6081E1; color:#fff; border: none;" data-toggle="modal"
                                data-target="#checkout">Finalizar Compra</button>
                             @include('sbadmin.shooping.home.checkout.App')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        /*---------------------
          Shopping Cart
        -----------------------*/
        
        .shopping__cart__table {
            margin-bottom: 30px;
        }
        
        .shopping__cart__table table {
            width: 100%;
        }
        
        .shopping__cart__table table thead {
            border-bottom: 1px solid #f2f2f2;
        }
        
        .shopping__cart__table table thead tr th {
            color: #ffffff;
            font-size: 17px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 25px;
        }
        
        .shopping__cart__table table tbody tr {
            border-bottom: 1px solid #f2f2f2;
        }
        
        .shopping__cart__table table tbody tr td {
            padding-bottom: 30px;
            padding-top: 30px;
        }
        
        .shopping__cart__table table tbody tr td.product__cart__item {
            width: 400px;
        }
        
        .shopping__cart__table table tbody tr td.product__cart__item .product__cart__item__pic {
            float: left;
            margin-right: 30px;
        }
        
        .shopping__cart__table table tbody tr td.product__cart__item .product__cart__item__text {
            overflow: hidden;
            padding-top: 21px;
        }
        
        .shopping__cart__table table tbody tr td.product__cart__item .product__cart__item__text h6 {
            color: #111111;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .shopping__cart__table table tbody tr td.product__cart__item .product__cart__item__text h5 {
            color: #0d0d0d;
            font-weight: 700;
        }
        
        .shopping__cart__table table tbody tr td.quantity__item {
            width: 175px;
        }
        
        .shopping__cart__table table tbody tr td.quantity__item .quantity .pro-qty-2 {
            width: 80px;
        }
        
        .shopping__cart__table table tbody tr td.quantity__item .quantity .pro-qty-2 input {
            width: 50px;
            border: none;
            text-align: center;
            color: #111111;
            font-size: 16px;
        }
        
        .shopping__cart__table table tbody tr td.quantity__item .quantity .pro-qty-2 .qtybtn {
            font-size: 16px;
            color: #888888;
            width: 10px;
            cursor: pointer;
        }
        
        .shopping__cart__table table tbody tr td.cart__price {
            color: #111111;
            font-size: 18px;
            font-weight: 700;
            width: 140px;
        }
        
        .shopping__cart__table table tbody tr td.cart__close i {
            font-size: 18px;
            color: #111111;
            height: 40px;
            width: 40px;
            background: #f3f2ee;
            border-radius: 50%;
            line-height: 40px;
            text-align: center;
        }
        
        .continue__btn.update__btn {
            text-align: right;
        }
        
        .continue__btn.update__btn a {
            color: #ffffff;
            background: #111111;
            border-color: #111111;
        }
        
        .continue__btn.update__btn a i {
            margin-right: 5px;
        }
        
        .continue__btn a {
            color: #111111;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 1px solid #e1e1e1;
            padding: 14px 35px;
            display: inline-block;
        }
        
        .cart__discount {
            margin-bottom: 60px;
        }
        .cart__discount .line{
        
        }
        
        .cart__discount h6 {
            color: #111111;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 35px;
        }
        
        .cart__discount form {
            position: relative;
        }
        
        .cart__discount form input {
            font-size: 14px;
            color: #b7b7b7;
            height: 50px;
            width: 100%;
            border: 1px solid #e1e1e1;
            padding-left: 20px;
        }
        
        .cart__discount form input::-webkit-input-placeholder {
            color: #b7b7b7;
        }
        
        .cart__discount form input::-moz-placeholder {
            color: #b7b7b7;
        }
        
        .cart__discount form input:-ms-input-placeholder {
            color: #b7b7b7;
        }
        
        .cart__discount form input::-ms-input-placeholder {
            color: #b7b7b7;
        }
        
        .cart__discount form input::placeholder {
            color: #b7b7b7;
        }
        
        .cart__discount form button {
            font-size: 14px;
            color: #ffffff;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            background: #111111;
            padding: 0 30px;
            border: none;
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
        }
        
        .cart__total {
            background: #f3f2ee;
            padding: 35px 40px 40px;
        }
        
        .cart__total h6 {
            color: #111111;
            text-transform: uppercase;
            margin-bottom: 12px;
        }
        
        .cart__total ul {
            margin-bottom: 25px;
        }
        
        .cart__total ul li {
            list-style: none;
            font-size: 16px;
            color: #444444;
            line-height: 40px;
            overflow: hidden;
        }
        
        .cart__total ul li span {
            font-weight: 700;
            color: #e53637;
            float: right;
        }
        
        .cart__total .primary-btn {
            display: block;
            padding: 12px 10px;
            text-align: center;
            letter-spacing: 2px;
        }
        
            .quantity {
                display: inline-block;
            }
        
            .pro-qty-2 {
                display: flex;
                align-items: center;
            }
        
            .quantity-input {
                width: 50px;
                text-align: center;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
        
            .increase-btn,
            .decrease-btn {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
                border-radius: 4px;
                margin-left: 5px;
            }
        
            .increase-btn:hover,
            .decrease-btn:hover {
                background-color: #0056b3;
            }
        </style>
</div>

