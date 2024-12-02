<!-- Modal -->
<div class="modal fade" id="credential{{auth()->user()->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Meus Dados de Acesso</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="updateProfile({{auth()->user()->id}})">
                
                <div class="form-group">
                    <label class="form-label" for="name">Nome: </label>
                    <input class="form-control" wire:model="name" name="name" type="text" placeholder="Insira o seu nome">
                </div>
                

                <div class="form-group">
                    <label class="form-label" for="name">Email: </label>
                    <input class="form-control" wire:model="email" name="email" type="text" placeholder="Insira o seu email">
                </div>

                <div class="form-group">
                    <label class="form-label" for="name">Palavra-Passe: </label>
                    <input class="form-control" wire:model="password" name="password" type="password"  placeholder="Insira uma nova password">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary px-3" type="submit">Salvar</button>
                </div>
            </form>
        </div>

      </div>
    </div>
</div>