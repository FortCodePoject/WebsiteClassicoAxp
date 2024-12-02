<div wire:ignore class="modal fade" id="read" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <div class="col-12 row">
                <div class="col-lg-6">
                    <h5 class="modal-title">Politicas de Privacidade</h5>
                </div>
                <div class="col-lg-6">
                    <h5 class="modal-title">Termos e Condições</h5>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <div class="col-12 row">
                <div class="col-lg-6">
                    <p style="text-align: justify;">{{$termsGeneral->privacity ?? ''}}</p>
                </div>
                <div class="col-lg-6">
                    <p style="text-align: justify;">{{$termsGeneral->term ?? ''}}</p>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>