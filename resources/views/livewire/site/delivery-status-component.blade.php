@section("title", "Estados da encomenda")
<div style="background: rgba(223, 223, 223, 0.932); min-height: 100vh;">
    <section class="d-flex align-items-center" style="min-height: 100vh;">
        <div class="container py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card text-dark" style="border-radius: 1rem;">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 mb-4">
                                    <div class="text-light p-1 mb-1" style="background: #F4C400">
                                        <h5 class="text-uppercase text-center">Estado da Encomenda</h5>
                                    </div>
                                    @foreach ($data as $delivery)
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Encomenda nº: {{ $delivery->delivery->reference }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Cliente: {{ $delivery->delivery->client }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Email: {{ $delivery->delivery->email }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Telefone: {{ $delivery->delivery->phone }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">NIF: {{ $delivery->delivery->taxPayer }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Endereço: {{ $delivery->delivery->address }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Taxa PB: {{ $delivery->delivery->taxPb }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Desconto: {{ $delivery->delivery->discount }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Preço de Entrega: {{ $delivery->delivery->deliveryPrice }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Total: {{ $delivery->delivery->total }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Pagamento: {{ $delivery->delivery->isPaid }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Data: {{ $delivery->delivery->date }}</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{ asset('delivery.svg') }}" class="img-fluid w-100" style="object-fit: cover;" alt="Delivery Image">
                                    <div class="text-light p-1 mt-3 w-100 text-center {{ $delivery->delivery->status === 'PENDENTE' ? 'bg-danger' : ($delivery->delivery->status === 'ENTREGUE' ? 'bg-success' : '') }}">
                                        <h5 class="text-uppercase">{{ $delivery->delivery->status }}</h5>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
