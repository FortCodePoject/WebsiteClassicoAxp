<!-- Modal -->
<div wire:ignore.self class="modal fade" id="visitorcompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel">Estatistica Por Empresa</h5>
          <span class="btn-close" style="font-size: 1rem; cursor: pointer;" data-dismiss="modal" aria-label="Close">&times;</span>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <div class="card col-6">
                        <div class="card-header bg-primary text-white">
                            <h4 class="text-center card-title">Visitantes</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="text-center text-dark" style="font-size: 5rem">{{$companydados ?? '00'}}</h1>
                        </div>
                    </div>

                    <div class="card col-6">
                        <div class="card-header bg-primary text-white">
                            <h4 class="text-center card-title">Filtros</h4>
                        </div>
                        <div class=" card-body">
                            <form>
                                @csrf
                                <div class="form-group">
                                    <select class="form-control" wire:model="companyselect">
                                            <option disabled selected >Selecione uma empresa</option>
                                            @foreach ($company as $item)
                                                <option value="{{$item->companyname}}">{{$item->companyname}}</option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="form-control" wire:model="moth">
                                        <option disabled selected >Selecione um mês</option>
                                        <option value="1">JANEIRO</option>
                                        <option value="2">FEVEREIRO</option>
                                        <option value="3">MARÇO</option>
                                        <option value="4">ABRIL</option>
                                        <option value="5">MAIO</option>
                                        <option value="6">JUNHO</option>
                                        <option value="7">JULHO</option>
                                        <option value="8">AGOSTO</option>
                                        <option value="9">SETEMBRO</option>
                                        <option value="10">OUTUBRO</option>
                                        <option value="11">NOVEMBRO</option>
                                        <option value="12">DEZEMBRO</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" wire:click="getVisitorCompany">Consultar</button>
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