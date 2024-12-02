<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Criar Documentação</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route("super.admin.documentation.store")}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Painel</label>
                    <select name="painel" class="form-control">
                        <option selected disabled>--Selecione o Painel--</option>
                        <option value="PAINEL DO ADMINISTRADOR">PAINEL DO ADMINISTRADOR</option>
                        <option value="PAINEL DO SUPER-ADMINISTRADOR">PAINEL DO SUPER-ADMINISTRADOR</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Secção</label>
                    <select name="section" class="form-control">
                        <option selected disabled>--Selecione a Secção--</option>
                        <option value="INICIAL">INICIAL</option>
                        <option value="SOBRE">SOBRE</option>
                        <option value="SERVIÇOS">SERVIÇOS</option>
                        <option value="RODAPÉ">RODAPÉ</option>
                        <option value="PROJECTOS">PROJECTOS</option>
                        <option value="CORES">CORES</option>
                        <option value="IMAGEM">IMAGEM DE FUNDO</option>
                        <option value="CONFIGURAÇÕES">CONFIGURAÇÕES</option>
                        <option value="CONTA">MINHA CONTA</option>
                        <option value="ELEMENTOS">ELEMENTOS WEBSITE</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Acção</label>
                    <select name="action" class="form-control">
                        <option selected disabled>--Selecione a Acção a ser realizada--</option>
                        <option value="INSERIR DADOS">INSERIR DADOS</option>
                        <option value="ELIMINAR DADOS">ELIMINAR DADOS</option>
                        <option value="ACTUALIZAR DADOS">ACTUALIZAR DADOS</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Descrição</label>
                    <input type="text" name="description" class="form-control" placeholder="Insira uma acção">
                </div>
            
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>