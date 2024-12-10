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
                                        <h4 class="m-0 font-weight-bold text-white">Pacotes Premium</h4>
                                    </div>
                                    <div>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn bg-white text-primary" data-toggle="modal" data-target="#exampleModal">
                                            Adicionar
                                        </button>
                                        @include("superadmin.pacote.modal")
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="col-xl-12">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="bg-primary text-white">
                                            <th>Empresa</th>
                                            <th>Pacote</th>
                                            <th>Status</th>
                                            <th>Acção</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($pacotes as $pacote)
                                               <tr>
                                                    <td>{{$pacote->company->companyname ?? ''}}</td>
                                                    <td>{{$pacote->pacote ?? ''}}</td>
                                                    <td class=" text-capitalize">{{$pacote->status ?? ''}}</td>
                                                    <td>

                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop{{$pacote->id}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                              </svg>
                                                        </button>

                                                        <div class="modal fade" id="staticBackdrop{{$pacote->id ?? ''}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h5 class="modal-title" id="staticBackdropLabel">Actualizar Pacote</h5>
                                                                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{route("super.admin.pacote.update", $pacote->id)}}" method="post">
                                                                        @csrf

                                                                        <input type="hidden" value="{{$pacote->id}}" name="id">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="company">Nome da Empresa</label>
                                                                            <input class="form-control" type="text" value="{{$pacote->company->companyname ?? ''}}" disabled>
                                                                        </div>
                                                        
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="pacote">Elementos Premium</label>
                                                                            <input class="form-control" type="text" value="{{$pacote->pacote ?? ''}}" disabled>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label class="form-label" for="pacote">Status</label>
                                                                            <select name="status" class="form-control">
                                                                                <option disabled selected>Selecione o status</option>
                                                                                <option value="premium">Premium</option>
                                                                                <option value="free">Free</option>
                                                                            </select>
                                                                        </div>
                                                        
                                                                        <div class="form-group">
                                                        
                                                                        <div class="form-group">
                                                                            <input type="submit" class="btn btn-primary" value="Cadastrar">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                    </td>
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