@extends("layouts.index")
@section("title", "Painel Administrativo")
@section("content")
@include("sbadmin.includes.sidebar")
@include("sbadmin.documentation.account.App")

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        @include("sbadmin.includes.topbar")
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
                 <div class="col-12">
                    <!-- Card Profile -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-primary">
                            <div class="col-xl-12 d-flex justify-content-between">
                                <div>
                                    <h6 class="m-0 font-weight-bold text-white">Dados de Acesso</h6>
                                </div>
                                <div>
                                    <svg data-toggle="modal" data-target="#exampleModal" style="color: #fff; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                    </svg>
                                </div>
                            </div>                        </div>
                        <div class="card-body">
                            <div class="col-6">
                                {{-- @foreach ($profile as $data) --}}
                                <div class="form-group">
                                    <label for="" class="form-label">Nome:</label>
                                    <input type="text" class="form-control" value="{{auth()->user()->name}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="" class="form-label">E-mail:</label>
                                    <input type="text" class="form-control" value="{{auth()->user()->email}}" disabled>
                                </div>

                                <div class="from-group">
                                    <button class="btn btn-primary px-4" data-toggle="modal" data-target="#credential{{auth()->user()->id}}">Editar </button>
                                    @include("sbadmin.profile.credential")
                                </div>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        <!-- /. Begin Page Content -->
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
@endsection