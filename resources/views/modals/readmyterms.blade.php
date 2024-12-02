<div wire:ignore.self class="modal fade" id="readMyTerms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ler e Editar Políticas e Termos</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form >
                    <div class="row">
                        <div class="col-lg-6">
                            <p for="privacity" class="form-label">Políticas de Privacidade</p>
                            <textarea wire:model="privacity" id="privacity" class="form-control" rows="500"></textarea>
                            @error('privacity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6">
                            <p for="term" class="form-label">Termos e Condições</p>
                            <textarea wire:model="term" id="term" class="form-control" rows="500"></textarea>
                            @error('term') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="mt-3 text-end modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button wire:click="saveTerms" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
