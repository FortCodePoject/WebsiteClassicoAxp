@extends("layouts.App")
@section("title", "Loja Online")
@section("content")
@include("components.navbar")
@include("components.color")
@include("components.images")

    <section id="menu" class="menu" style="margin-top: 8rem">
      @livewire("loja.shopping")

  </section>

    <a href="{{route("site.portfolio.shopping.cart", ["company" => $name->companyhashtoken])}}" id="cartcout" style="color: #fff;background: var(--background);" class="cartcout d-flex align-items-center justify-content-center">      
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
          <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
        </svg>
    </a>
    
    <style>
        .cartcout {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 110px;
        right: 40px;
        background-color: #fafafa;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 1px 1px 2px #888;
        z-index: 1000;
      }
    </style>
@endsection