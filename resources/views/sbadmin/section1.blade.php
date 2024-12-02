@extends("layouts.index")
@section("title", "Painel Admin - Hero")
@section("content")
@include("sweetalert::alert")
@include("sbadmin.documentation.hero.App")
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
                                        <h6 class="m-0 font-weight-bold text-white">Informações Iniciais</h6>
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
                                <div class="col-xl-6 {{count($hero) > 0 ? "d-none" : ""}}">
                                    <form action="{{route("admin.store.hero")}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label">Titulo</label>
                                            <input type="text" name="title" class="form-control" placeholder="Insira a informação...">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Descrição</label>
                                            <textarea name="description" class="form-control" cols="30" rows="10" placeholder="insira uma descrição...."></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Fotografia</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="Cadastrar">
                                        </div>
                                    </form>
                                </div>

                                <div class="col-xl-6">
                                    @foreach ($hero as $item)
                                    <div class="form-group">
                                        <label class="form-label">Titulo</label>
                                        <h4>{{$item->title}}</h4>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Descrição</label>
                                        <p>{{$item->description}}</p>
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label class="form-label">Fotografia</label>
                                        <div>
                                            <img src="{{asset("image/$item->img")}}" alt="" class="img-fluid" style="width: 10rem; heigth: 10rem; border-radius: 100%;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop{{$item->id}}">Editar</a>                                         
                                        @include("sbadmin.includes.modal")
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection