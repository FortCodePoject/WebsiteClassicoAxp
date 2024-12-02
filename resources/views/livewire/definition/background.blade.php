<div class="d-flex justify-content-evenly">
    <div class="col-xl-6">
        <form wire:submit.prevent="imagebackgroundstore" enctype="multipart/form-data">
            
            <div class="form-group">
                <p class="form-label">Carregar Imagem</p>
                <input type="file" wire:model="image" name="image" class="form-control" placeholder="Insira a informação...">
                @if ($fundoId && $currentImage)
                    <img src="{{ Storage::url("arquivos/background/$currentImage") }}" style="width: 10rem; height: 5rem;" alt="Imagem Atual">
                @endif
            </div>

            <div class="form-group">
                <p class="form-label">Secção</p>
                <select wire:model="type" name="tipo" class="form-control">
                    <option selected>Selecione uma secção para esta imagem</option>
                    <option value="Hero">Inicial</option>
                    <option value="Start">Start</option>
                    <option value="Footer">Rodapé</option>
                    <option value="Shopping">Loja</option>
                    <option value="ShoppingCart">Carrinho</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="{{ $fundoId ? 'Atualizar' : 'Cadastrar' }}">
            </div>
        </form>
    </div>

    <div class="col-xl-6 d-flex justify-content-evenly flex-wrap">
        @foreach ($fundo as $item)  
            <div class="p-2">
                <img src="{{ Storage::url("arquivos/background/$item->image") }}" style="width: 7rem; height: 7rem; border-radius:50%;" alt="">
                <button class="btn btn-primary mt-3" wire:click="load({{ $item->id }})">Editar</button>
            </div>
        @endforeach
    </div>
</div>
