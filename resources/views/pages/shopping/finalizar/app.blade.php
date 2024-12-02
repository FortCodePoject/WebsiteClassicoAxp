<!-- Modal -->
<div wire:ignore.self class="modal fade" id="checkout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header" style="background: var(--background); color:#fff;">
          <h5 class="modal-title" id="exampleModalLabel" style="color: #fff">FINALIZAR ENCOMENDA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <div class="accordion" id="accordionExample">
                <div class="card">
                  <div class="card-header" style="background: var(--background);" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-block text-left" type="button" data-bs-toggle="collapse" style="color: #fff;" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Coordenadas Bancarias
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <h6>Nº CONTA: 196976838100 01 | IBAN:AO06 0040 0000 9697 6838 10171</h6>
                    </div>
                  </div>
                </div>
              </div>
          </div>

          <form >
            <div class="mt-3">
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="name">Nome <span class="text-danger">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Nome" wire:model="name">
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="form-group col-md-4">
                  <label for="">Sobrenome <span class="text-danger">*</span></label>
                  <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Sobrenome" wire:model="lastname">
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="form-group col-md-4">
                  <label for="">Provincia <span class="text-danger">*</span></label>
                  <input type="text" name="province" id="province" class="form-control" placeholder="Provincia" wire:model="province">
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
    
                </div>
                <div class="form-group col-md-4">
                  <label for="">Município <span class="text-danger">*</span></label>
                  <input type="text" name="municipality" id="municipality" class="form-control" placeholder="Município" wire:model="municipality">
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
    
                </div>
                <div class="form-group col-md-4">
                  <label for="">Bairro <span class="text-danger">*</span></label>
                  <input type="text" name="street" id="street" class="form-control" placeholder="Bairro" wire:model="street">
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="form-group col-md-4">
                  <label for="">E-mail <span class="text-danger">*</span></label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" wire:model="email">
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="form-group col-md-4">
                  <label for="">Nº Contribuente </label>
                  <input type="text" min="9" name="nif" id="nif" class="form-control" wire:model="taxPayer"> 
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="form-group col-md-4">
                  <label for="">Telefone <span class="text-danger">*</span></label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="999-999-999" wire:model="phone">
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
    
                </div>
                <div class="form-group col-md-4">
                  <label for="">Telefone Alternativo</label>
                  <input type="text" name="otherPhone" id="otherPhone" class="form-control" placeholder="999-999-999" wire:model="otherPhone">
                </div>
                <div class="form-group col-md-4">
                  <label for="paymentType">Forma de Pagamento <span class="text-danger">*</span></label>
                  <select disabled="" name="paymentType" id="paymentType" class="form-control" wire:model="paymentType">
                    <option value="Transferência" selected="">Transferência </option>
                  </select>
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                </div>
    
                <div class="form-group col-md-4">
                  <label for="image">Recibo de Pagamento <span class="text-danger">*</span></label>
                  <input id="receipt" type="file" class="form-control w-100" name="receipt" wire:model="receipt">
                </div>
                
                <div class="form-group col-md-4">
                  <label for="">Local de Refência <span class="text-danger">*</span></label>
                  <input type="text" name="otherAddress" id="otherAddress" class="form-control" placeholder="Digite..." wire:model="otherAddress">
                  <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                </div>
              </div>
             
              </div>
            </div>
            <h1></h1>
            <div class="modal-footer col-md-12 d-flex justify-content-between align-items-start">
                <h4>Total: {{number_format(abs($totalFinal), 2, '.', ',')}} Kz</h4>
                <button class="btn btn-primary text-uppercase text-white" type="button" wire:click='checkout("{{ session('companytoken') }}")'
                style="background: var(--background); color:#fff; border: none;">Encomendar         
                </button>
            </div>
          </form>
      </div>
    </div>
  </div>