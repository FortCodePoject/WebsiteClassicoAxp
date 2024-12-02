<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Modo de Uso</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @foreach ($rodape as $data)
                <h5>{{$data->action}}</h5>
                @foreach ($data->infos as $item)
                    <p>{{$item->description}}</p>
                @endforeach
            @endforeach
        </div>
      </div>
    </div>
</div>