@extends("layouts.App")
@section("title", "Carrinho de COmpra")
@section("content")
@include("components.navbar")
@include("components.color")
@include("components.images")
    <main id="main">
        {{-- Start component livewire products --}}
        @livewire("loja.shoppingcart")
        {{-- End component livewire products --}}
    </main>
@endsection