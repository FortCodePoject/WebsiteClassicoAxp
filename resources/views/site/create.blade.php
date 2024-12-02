<!-- Modal -->
<div wire:ignore.self class="modal fade" id="termsCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Politicas e Termos</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <form>
                <div class="">
                    <div class="form-group">
                        <p class="form-label">Escreva a sua Politica de privacidade</p>
                        <textarea name="privacity" wire:model="privacity" rows="8" class="form-control" placeholder="Insira aqui as suas politicas de privacidade ...."></textarea>
                    </div>

                    <div class="form-group">
                        <p class="form-label">Escreva o seu Termo de Condições</p>
                        <textarea name="term" wire:model="term" rows="8" class="form-control" placeholder="Insira aqui os seus termos e condições...."></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <input wire:click="conditionsCreate()" class="btn btn-primary" value="Cadastrar">
                </div>
            </form>
        </div>
      </div>
    </div>
</div>