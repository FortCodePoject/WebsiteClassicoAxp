@extends("layouts.index")
@section("title", "Empresas - Painel SuperAdmin")
@section("content")
@include("sweetalert::alert")

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
                                        <h4 class="m-0 font-weight-bold text-white">Documentação</h4>
                                    </div>
                                    <div>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn bg-white text-primary" data-toggle="modal" data-target="#exampleModal">
                                            Adicionar
                                        </button>
                                        @include("superadmin.documentation.create")
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="col-xl-12">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="bg-primary text-white">
                                            <th>Painel</th>
                                            <th>Secção</th>
                                            <th>Acção</th>
                                            <th>Descrição</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($documentations as $documentation)
                                                <tr>
                                                    <td>{{$documentation->panel}}</td>
                                                    <td>{{$documentation->section}}</td>
                                                    <td>{{$documentation->action}}</td>
                                                    @foreach ($documentation->infos as $item)
                                                    <td>{{$item->description}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection