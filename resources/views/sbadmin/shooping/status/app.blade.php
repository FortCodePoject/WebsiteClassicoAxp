@extends("layouts.index")
@section("title", "Estado Encomenda")
@section("content")
@include("sweetalert::alert")
@include("sbadmin.shooping.status.style")
    {{-- side bar --}}
    @include("sbadmin.includes.sidebar")

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include("sbadmin.includes.topbar")

            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12 col-lg-6">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header bg-primary py-3 flex-row align-items-center justify-content-between col-xl-12">
                                <div class="col-xl-12 d-flex justify-content-between">
                                    <div>
                                        <h6 class="m-0 font-weight-bold text-white">Estado da Encomenda</h6>
                                    </div>
                                    <div>
                                        <svg data-toggle="modal" data-target="#exampleModal" style="color: #fff; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="container-fluid tab-content" data-aos="fade-up" data-aos-delay="300">
                                    <div class="container col-sm-8 col-md-8">
                                        <h1>Verificar Estado da Encomenda</h1>
                                        <form method="get">
                                            @csrf
                                            <div class="form-group">
                                                <label for="codigo">Código da Encomenda:</label>
                                                <input type="text" name="codereference" id="codigo" placeholder="Digite o código" value="{{ request('codereference') }}">
                                            </div>
                                            <button id="verificarBtn" type="submit">Verificar</button>
                                        </form>
                                    </div>
                                    <div>
                                        @foreach ($itensColletions as $item)
                                            @if(isset($item->delivery))
                                            <h2 class="text-center">Detalhes da Encomenda</h2>
                                                <ul>
                                                    <li>Referência: {{ $item->delivery->reference }}</li>
                                                    <li>Cliente: {{ $item->delivery->client }}</li>
                                                    <li>Email: {{ $item->delivery->email }}</li>
                                                    <li>Telefone: {{ $item->delivery->phone }}</li>
                                                    <li>Taxa Pb: {{ $item->delivery->taxPb }}</li>
                                                    <li>Desconto: {{ $item->delivery->discount }}</li>
                                                    <li>Total: {{ $item->delivery->total }}</li>
                                                    <li>Estado: {{ $item->delivery->status }}</li>
                                                    <li>Pagamento: {{ $item->delivery->isPaid }}</li>
                                                    <li>Data: {{ $item->delivery->date }}</li>
                                                </ul>
                                            @else
                                                <div class="text-center">
                                                    <h3 class="text-danger">Codigo de Encomenda Invalido</h3>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection