@section("title", "Tela de Inscrição")
<div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap">
    
    <div class="card col-md-8 bg-dark text-white mt-5" id="signup">
        <div class="card-header text-center">
            <h4 class="card-title">Crie aqui o seu Website Clássico</h4>
        </div>
        
        <div class="card-body mt-5">
            <form wire:submit.prevent="createAccountSite">

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="name" class="form-label">Nome<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='name' type="text" id="name" placeholder="Informe o Nome" autocomplete="off">
                        @error('name')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
    
                    <div class="form-group col-md-4">
                        <label for="lastname" class="form-label">Sobrenome<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='lastname' type="text" id="lastname" placeholder="Informe o Sobrenome" autocomplete="off">
                        @error('lastname')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='email' type="email" id="email" placeholder="Informe o Email" autocomplete="off">
                        @error('email')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="companynif" class="form-label">NIF<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='companynif' type="text" id="companynif" placeholder="Informe o NIF" autocomplete="off">
                        @error('companynif')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="image" class="form-label">Imagem<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='image' type="file" id="image" autocomplete="off">
                        @error('image')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="password" class="form-label">Crie uma senha<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='password' type="password" id="password" placeholder="Crie uma senha" autocomplete="off">
                        @error('password')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="confirmpassword" class="form-label">Confirme a senha<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='confirmpassword' type="password" id="confirmpassword" placeholder="Confirme a senha" autocomplete="off">
                        @error('confirmpassword')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone" class="form-label">Telefone<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='phone' type="text" id="phone" placeholder="999999999" autocomplete="off">
                        @error('phone')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="province" class="form-label">Província<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='province' type="text" id="province" placeholder="Província" autocomplete="off">
                        @error('province')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="municipality" class="form-label">Município<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='municipality' type="text" id="municipality" placeholder="Município" autocomplete="off">
                        @error('municipality')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="address" class="form-label">Endereço<span class="text-danger">*</span></label>
                        <input class="form-control" wire:model='address' type="text" id="address" placeholder="Endereço" autocomplete="off">
                        @error('address')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="" class="form-label">Localização da sua Loja</label>
                        @if (isset($locationMap) and count($locationMap) > 0)
                            <select wire:model="mylocation" class="form-control selectLocation2" id="location-select">
                                <option value="">--Selecionar--</option>
                                @foreach ($locationMap as $locationValue)
                                    <option value="{{ $locationValue['location'] ?? "" }}">{{ $locationValue['location'] ?? "" }}</option>
                                @endforeach
                            </select>
                        @endif
                        @error('mylocation')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4 col-md-12">
                    <button class="btn btn-block" style="background-color: #ffffff; color:#242424 !important" type="submit">Registrar minha Conta</button>
                </div>

            </form>
        </div>

        <div class="card-footer text-center">
            <p class="lead">Já tem uma conta? <a href="{{route('anuncio.login.view')}}" style="color: #ffffff !important;">Fazer Login.</a></p>
        </div>
    </div>

    <div class="full-screen-loader d-none" wire:loading.class="d-flex" wire:loading.class.remove="d-none" wire:loading wire:target="createAccountSite">
        <div class="loader"></div>
        <p class="display-3 display-md-1 text-center">A sua conta está a ser criada, aguarde...</p>
    </div>
        
</div>