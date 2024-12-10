<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5 text-black" id="exampleModalLabel">Pacote Premium - Adicionar</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-dark">
            <form action="{{route("super.admin.pacote.store")}}" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="company">Nome da Empresa</label>
                    <select name="company_id" id="company" class="form-control">
                        <option selected disabled> Selecione uma empresa</option>
                        @foreach ($companies as $company)
                            <option value="{{$company->id ?? ''}}">{{$company->companyname ?? ''}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="pacote">Elementos Premium</label>
                    <select name="packgeid" id="pacote" class="form-control">
                        <option selected disabled>Selecione um elemento</option>
                        @foreach ($packges as $packge)
                            <option value="{{$packge->id ?? ''}}">{{$packge->packgename ?? ''}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>