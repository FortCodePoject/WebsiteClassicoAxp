<div class="col-md-12 text-white text-center py-3 {{(auth()->user()->company->status == "active") ? "bg-primary" : "bg-danger"}}" style="height: 60px;">
    <a href="{{route("plataform.portfolio.admin.delivery.list")}}#content3" class="text-white">
        @if (auth()->user()->company->status == "active")
            <h5>A sua loja está disponivel, acesse a sua loja clicando aqui</h5>
        @else
            <h5> A sua loja estará disponível quando o seu website for ativado. </h5>
        @endif
    </a>
</div>