@extends("layouts.index")
@section("title", "Painel Administrativo")
@section("content")
@include("sbadmin.includes.sidebar")
@include("sweetalert::alert")
@include("sbadmin.documentation.image.App")
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        @include("sbadmin.includes.topbar")
        <!-- End of Topbar -->

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12 col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header bg-primary py-3 flex-row d-flex justify-content-between col-xl-12">
                            <div class="col-xl-12 d-flex justify-content-between">
                                <div>
                                    <h6 class="m-0 font-weight-bold text-white">Imagens de Fundo</h6>
                                </div>
                                <div>
                                    <svg data-toggle="modal" data-target="#exampleModal" style="color: #fff; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body d-flex">
                            <div class="col-xl-6 {{count($fundo) > 2 ? "d-none" : ""}}">
                                <form action="{{route("anuncio.management.store.fundo")}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Carregar Imagem</label>
                                        <input type="file" name="image" class="form-control" placeholder="Insira a informação...">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Secção</label>
                                        <select name="tipo" class="form-control">
                                            <option selected disabled>Selecione uma secção para esta imagem</option>
                                            <option value="Hero">Inicial</option>
                                            <option value="Start">Start</option>
                                            <option value="Footer">Rodápe</option>
                                            <option value="Shopping">Loja</option>
                                            <option value="ShoppingCart">Carrinho</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                                    </div>
                                </form>
                            </div>

                            <div class="col-xl-6 row-cols-3">
                                @foreach ($fundo as $item)  
                                    <div class="p-2">
                                        <img src="{{url("/storage/$item->image")}}" style="width: 100%; height: 100%;" alt="">
                                        <a href="{{$item->id}}" class="btn btn-primary mt-3" data-toggle="modal" data-target="#staticBackdrop{{$item->id}}">Editar</a>
                                        @include("sbadmin.includes.fundo")
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
@endsection