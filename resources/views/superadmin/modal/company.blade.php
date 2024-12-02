<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Cadastro de Empresa</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="company">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nome da Empresa</label>
                    <input type="text" name="name" class="form-control" placeholder="Insira o nome da empresa...">
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Insira o email...">
                </div>

                <div class="form-group">
                    <label class="form-label">NIF</label>
                    <input type="text" name="nif" class="form-control" placeholder="Insira o nif...">
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo de Negócio</label>
                    <input type="text" name="type" class="form-control" placeholder="Insira o tipo de negócio...">
                </div>

                <div class="form-group">
                    <label class="form-label">Token API</label>
                    <input type="text" name="apitoken" class="form-control" placeholder="Insira o token da api...">
                </div>
            
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

<script src="{{asset("datas/jquery.js")}}"></script>
<script src="{{asset("datas/main.js")}}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script>
    $(document).ready(function(){
        $('#company').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route('super.admin.register.company') }}',
                data: $('#company').serialize(),
                success: function(response){
                  Swal.fire({
                    title: "Empresa Cadastrada",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 3000
                  });
                }
            });
        });
    });
</script>