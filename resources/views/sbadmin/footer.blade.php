@extends("layouts.index")
@section("title", "Painel Admin - Hero")
@section("content")
@include("sweetalert::alert")
@include("sbadmin.documentation.rodape.App")
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
                                        <h6 class="m-0 font-weight-bold text-white">Rodapé</h6>
                                    </div>
                                    <div>
                                        <svg data-toggle="modal" data-target="#exampleModal" style="color: #fff; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body ">
                                <div class="col-xl-12">
                                    <div class="col-xl-6 {{count($footer) == 1 ? "d-none" : ""}}">
                                        <form action="{{route("admin.footer.store")}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-label">Telefone</label>
                                                <input type="text" class="form-control" name="telefone" placeholder="Insira o seu contacto..">
                                            </div>
    
                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="Insira o seu email..">
                                            </div>
    
                                            <div class="form-group">
                                                <label class="form-label">Endereço</label>
                                                <input type="text" class="form-control" name="endereco" placeholder="Insira o seu endereço..">
                                            </div>
    
                                            <div class="form-group">
                                                <label class="form-label">Destaque</label>
                                                <input type="text" class="form-control" name="atendimento" placeholder="Insira uma frase em destaque..">
                                            </div>
    
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary" value="Adicionar">
                                            </div>
                                        </form>
                                        
                                    </div>

                                    <div>
                                        @foreach ($footer as $item)
                                        <div class="form-group">
                                            <label class="form-label">Telefone</label>
                                            <h5>{{$item->telefone}}</h5>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <h5>{{$item->email}}</h5>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Endereço</label>
                                            <h5>{{$item->endereco}}</h5>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Destaque</label>
                                            <h5>{{$item->atendimento}}</h5>
                                        </div>

                                        <div class="form-group">
                                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop{{$item->id}}">Editar</a>
                                            @include("sbadmin.includes.modal.footer")
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
    </div>
@endsection