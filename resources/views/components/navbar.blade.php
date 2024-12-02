  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top" style="{{(Route::Current()->getName() == 'site.portfolio.shopping' || Route::Current()->getName() == 'site.portfolio.shopping.cart') ? 'background-color: var(--background) !important;':''}}">
    <div class="container-fluid px-3 px-md-3 px-lg-4 d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="{{route("site.portfolio.index", ["company" => $name->companyhashtoken])}}">{{$name->companyname}}</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{route("site.portfolio.index", ["company" => $name->companyhashtoken])}}#home">Home</a></li>
          <li><a class="nav-link scrollto" href="{{route("site.portfolio.index", ["company" => $name->companyhashtoken])}}#about">Sobre</a></li>
          <li><a class="nav-link scrollto" href="{{route("site.portfolio.index", ["company" => $name->companyhashtoken])}}#services">Serviços</a></li>
          <li><a class="nav-link scrollto" href="{{route("site.portfolio.index", ["company" => $name->companyhashtoken])}}#work">Trabalhos</a></li>
          <li><a class="nav-link scrollto" href="{{route("site.portfolio.shopping", ["company" => $name->companyhashtoken])}}">Loja</a></li>
          <li><a class="nav-link scrollto" href="{{route("site.portfolio.index", ["company" => $name->companyhashtoken])}}#contact">Contacto</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
    </div>
  </header><!-- End Header -->
<!-- ======= End Header ======= -->