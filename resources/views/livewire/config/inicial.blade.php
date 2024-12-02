<div>
    <h3>Hero Inicial</h3>
    <hr>
    <div>
        @if (count($hero) < 1)
            <form wire:submit.prevent="registerdatas" enctype="multipart/form-data">
                
                <div class="form-group">
                    <h5 class="form-label">Fotografia do perfil</h5>
                    <input type="file" name="image" wire:model="image" class="form-control">
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <h5 class="form-label">Título</h5>
                    <input type="text" name="title" wire:model="title" class="form-control" placeholder="Insira a informação...">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <h5 class="form-label">Descrição</h5>
                    <textarea name="description" wire:model="description" class="form-control" cols="30" rows="8" placeholder="Insira uma descrição..."></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        @else
            <div>
                @foreach ($hero as $item)
                    <div class="form-group">
                        <h5 class="form-label">Título</h5>
                        <p>{{ $item->title }}</p>
                    </div>
                    
                    <div class="form-group">
                        <h5 class="form-label">Descrição</h5>
                        <p>{{ $item->description }}</p>
                    </div>
                    
                    <div class="form-group text-center">
                        <div style="width: 10rem; height: 10rem; overflow: hidden; border-radius: 50%;">
                            <img src="{{ Storage::url("arquivos/{$item->img}") }}" alt="{{ $item->title }}" class="img-fluid">
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop{{ $item->id }}" wire:click="loadHeroData({{ $item->id }})">Editar</button>
                        @include("sbadmin.includes.modal")
                        <a class="btn btn-primary mx-2" onclick="openTab(event, 'competencias')"> Proximo </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>