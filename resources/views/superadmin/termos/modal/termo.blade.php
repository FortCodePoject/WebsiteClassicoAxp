<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Politicas e Privacidade</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="saveData">
                @csrf
                <div class="form-group">
                    <label class="form-label">Politicas de Privacidades</label>
                    <textarea class="form-control" name="term" cols="20" rows="5" placeholder=""></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Termos e condições</label>
                    <textarea class="form-control" name="privacity" cols="20" rows="5" placeholder=""></textarea>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $('#saveData').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route('super.privacy.store') }}',
                data: $('#saveData').serialize(),
                success: function(response){
                  Swal.fire({
                    title: "Termos Criados",
                    text: "Politicas de Privacidade e Termos e condições Cadastrados",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 3000
                  });
                }
            });
        });
    });
</script>