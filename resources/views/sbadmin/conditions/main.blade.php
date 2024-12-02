@extends("layouts.index")
@section("title", "Painel Admin - Hero")
@section("content")
@include("sweetalert::alert")
<script src="{{asset("datas/jquery.js")}}"></script>
<script src="{{asset("datas/main.js")}}"></script>
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
                                <div class="col-xl-6">
                                    <h6 class="m-0 font-weight-bold text-white">Termos e Condições</h6>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body d-flex">
                                
                                <div class="col-xl-12">
                                    @foreach ($termos as $termo)    
                                    <div class="form-group">
                                        <h3>Politica de Privacidade</h3>
                                        <div>
                                            <p>{{$termo->privacy}}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <h3>Termos e Condições</h3>
                                        <div>   
                                            <p>{{$termo->condition}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#conditions">Editar</button>
                                        @include("sbadmin.conditions.modal")
                                    </div>

                                    <form id="statusForm" action="{{ route('items.updateStatus', $termo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="status" id="statusCheckbox" {{ $termo->status === 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="statusCheckbox">
                                                Ativar/Desativar
                                            </label>
                                        </div>
                                    </form>
                                    
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function(){
                                            $('#statusCheckbox').change(function(){
                                                $('#statusForm').submit();
                                            });
                                        });
                                    </script>
                                    @endforeach

                                    <script>
                                        $(document).ready(function(){
                                            // Quando a opção específica é selecionada, mostra outro campo
                                            $('#opcao').change(function(){
                                                var selecionado = $(this).val();
                                                if(selecionado == 'opcao2') {
                                                    $('#outra_parte_do_formulario').show();
                                                } else {
                                                    $('#outra_parte_do_formulario').hide();
                                                }
                                            });
                                        });
                                    </script>
                                        
                                            <div class="">
                                                <label for="opcao">Selecione uma opção:</label>
                                                <select id="opcao" name="opcao" class="form-control">
                                                    <option value="opcao1">Termos Genericos</option>
                                                    <option value="opcao2">Meus Termos</option>
                                                </select>
                                            </div>
                                        
                                            <!-- Parte do formulário que será exibida quando 'Opção 2' for selecionada -->
                                        <div id="outra_parte_do_formulario" style="display:none;">
                                            <div class="col-xl-6 {{count($termos) > 0 ? "d-none" : ""}}">
                                                    <form action="{{route("admin.conditions.create")}}" method="post">
                                                        @csrf
                                                        <div class="col-12 col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Escreva a sua Politica de privacidade</label>
                                                                <textarea name="privacity" class="form-control" cols="50" rows="10" placeholder="Insira uma descrição...."></textarea>
                                                            </div>
                                                        </div>
                
                                                        <div class="col-12 col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Escreva o seu Termo de Condições</label>
                                                            <textarea name="term" class="form-control" cols="50" rows="10" placeholder="Insira uma descrição...."></textarea>
                                                        </div>
                                                    </div>
                
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                                                    </div>
                                                </form>
                                            </div>
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