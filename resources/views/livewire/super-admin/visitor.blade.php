<div class="col-xl-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header bg-primary py-3 flex-row align-items-center justify-content-between col-xl-12">
            <div class="col-xl-12 d-flex justify-content-between">
                <div>
                    <h4 class="m-0 font-weight-bold text-white">Metricas (Visitantes)</h4>
                </div>
                <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-white text-primary" data-toggle="modal" data-target="#visitorcompany">
                    Por Empresa
                </button>
                
                </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <th>IP</th>
                        <th>Dispositivo</th>
                        <th>Sistema</th>
                        <th>Navegador</th>
                        <th>Empresa</th>
                        <th>Tipo do Dispositivo</th>
                    </thead>
                    <tbody>
                        @if (isset($visitors) and count($visitors) > 0)
                            @foreach ($visitors as $visitor)
                                <tr>
                                    <td>{{$visitor->ip}}</td>
                                    <td>{{$visitor->device}}</td>
                                    <td>{{$visitor->system}}</td>
                                    <td>{{$visitor->browser}}</td>
                                    <td>{{$visitor->company}}</td>
                                    <td>{{$visitor->typedevice}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center flex-column" style="height: 60vh">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                        </svg>
                                        <p class="text-muted">Nenhum dados capturado dos visitantes</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @include("livewire.super-admin.company")
        </div>
        <div class="card-footer">
            <div class="pagination">
                {{ $visitors->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>