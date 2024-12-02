<div class="row mt-3 col-md-12">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="small-box card p-3 {{(auth()->user()->company->status == "active") ? "bg-success" : "bg-danger"}}">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <a style="text-decoration: none;" href="{{route("denition.general")}}" class="text-white text-center">
                    @if (auth()->user()->company->status == "active")
                        <h5> O seu website está ativo. Para desativá-lo, clique aqui.</h5>
                    @else
                        <h5> O seu website está inativo. Para ativá-lo, clique aqui.</h5>
                    @endif
                </a>
            </div>
        </div>
    </div>
      <!-- ./col -->
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="small-box card p-3 {{(auth()->user()->company->status == "active") ? "bg-primary" : "bg-danger"}}">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <a style="text-decoration: none;" href="{{route("admin.general.shopping")}}" class="text-white text-center">
                    @if (auth()->user()->company->status == "active")
                        <h5>A sua loja está disponivel, acesse a sua loja clicando aqui</h5>
                    @else
                        <h5> A sua loja estará disponível quando o seu website for ativado. </h5>
                    @endif
                </a>
            </div>
        </div>
    </div>
      <!-- ./col -->

    <div class="col-lg-4 col-md-6 mb-3">
        <div class="small-box card p-3 {{(auth()->user()->company->status == "active") ? "bg-primary" : "bg-danger"}}">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <a style="text-decoration: none;" href="https://www.xzero.ao/" target="_blank" class="text-white text-center">
                    @if (auth()->user()->company->status == "active")
                        <h5>xZero disponivel, Já Podes Emitir as facturas</h5>
                    @else
                        <h5> Quando o seu website for ativado, vais poder emitir factura no xzero </h5>
                    @endif
                </a>
            </div>
        </div>
    </div>

</div>