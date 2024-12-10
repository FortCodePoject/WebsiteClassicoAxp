<!-- Modal -->
<div class="modal fade" id="conditions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Termos da Entidade {{$name}} | NIF: {{$companynif}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if (isset($companies) and $companies->count() > 0)
          <p style="text-align: justify">
            {{ isset($companies->termsPBs->term) ? $companies->termsPBs->term : "" }}
          </p>
        @else
          <p style="text-align: justify">
            {{$termos->term ?? ''}}
          </p>
        @endif
      </div>
    </div>
  </div>
</div>