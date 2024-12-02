@extends("layouts.index")
@section("title", "Pacotes Premium - Painel SuperAdmin")
@section("content")
@include("sweetalert::alert")
    {{-- side bar --}}
    @include("superadmin.includes.sidebar")

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include("superadmin.includes.topbar")

            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12 col-lg-6">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header bg-primary py-3 flex-row align-items-center justify-content-between col-xl-12">
                                <div class="col-xl-12 d-flex justify-content-between">
                                    <div>
                                        <h4 class="m-0 font-weight-bold text-white">Metricas (Visitantes)</h4>
                                    </div>
                                    <div>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn bg-white text-primary" data-toggle="modal" data-target="#visitorcompany">
                                        Por Empresa
                                    </button>
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                @livewire("super-admin.visitor")
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection