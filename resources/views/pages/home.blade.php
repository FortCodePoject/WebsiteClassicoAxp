@extends("layouts.App")
@section("title", "Portfolio Site - " . $name)
@section("content")
@include("components.navbar")
@include("components.images")
@include("components.color")

  @if ($whatsApp && $whatsApp->pacote === "WhatsApp" && $whatsApp->status === "premium")
    @include("components.pacote.whatsapp")
  @endif

  @if (Route::current()->getName() == "site.portfolio.index")
    <!-- ======= Hero Section ======= -->
    <div id="hero" class="hero route bg-image">
      <div class="overlay-itro"></div>
      <div class="hero-content display-table">
        <div class="table-cell">
          <div class="container">
              @foreach ($hero as $item)
                  <h1 class="hero-title mb-4">{{$item->title}}</h1>
                  <p class="hero-subtitle"><span class="typed" data-typed-items="{{$item->description}}"></span></p>
              @endforeach
          </div>
        </div>
      </div>

    </div>
    <!-- End Hero Section -->
  @endif
  
  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about-mf sect-pt4 route">
      <div class="container-fluid px-3 px-md-3 px-lg-4">
        <div class="row">
          <div class="col-sm-12">
            <div class="box-shadow-full">
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-sm-6 col-md-5">
                        @foreach ($hero as $item)  
                            <div class="about-img"> 
                                <img style="border-radius: 12rem;width: 13rem; height: 13rem;" src="{{Storage::url("public/arquivos/{$item->img}")}}" class="img-fluid b-shadow-a" alt="">
                            </div>
                        @endforeach
                    </div>
                    <div class="skill-mf">
                      <p class="title-s">Habilidades</p>

                      @foreach ($habilitys as $item)                          
                        <span>{{$item->hability}}</span> <span class="pull-right">{{$item->level}}%</span>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: {{$item->level}}%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      @endforeach
                    </div>
                    <div class="col-sm-6 col-md-7">
                      <div class="about-info">
                        @foreach ($about as $item)
                            <p><span class="title-s">Nome: </span> <span>{{$item->nome}}</span></p>
                            <p><span class="title-s">Perfil: </span> <span>{{$item->perfil}}</span></p>
                        @endforeach
                        @foreach ($contact as $item) 
                            <p><span class="title-s">Email: </span> <span>{{$item->email}}</span></p>
                            <p><span class="title-s">Tel: </span> <span>+244 {{$item->telefone}}</span></p>
                        @endforeach
                      </div>
                    </div>
                  </div>
                 
                </div>
                <div class="col-md-6">
                  <div class="about-me pt-4 pt-md-0">
                    <div class="title-box-2">
                      <h5 class="title-left">
                        Sobre
                      </h5>
                    </div>
                    @foreach ($about as $item)
                    <p class="lead">
                        {{$item->p1}}
                    </p>
                    <p class="lead">
                        {{$item->p2}}
                    </p>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End About Section -->

    <div class="container-fluid px-3 px-md-3 px-lg-4">
        <div class="position-relative">
          <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach ($apiArray as $anuncio)
              <div class="carousel-item active">
                  @if ($anuncio["tipo"] === "Horizontal")
                    <a href="{{$anuncio["link"] ?? NULL}}" target="_blank">
                      <div style="width: 100%">
                        <img src="{{url("{$anuncio["image_full_url"]}")  ?? NULL}}" alt="" style="width:100%">
                        <div style="position: absolute; top:5px; width:10px; height: 10px; right:28px;"><i class="bi bi-info-circle-fill cursor-pointer" style="color: #ffffff" title="Está Publicidade é de inteira responsabilidade da Fort-Code"></i></div>
                      </div>
                    </a>
                  @endif
                </div>
                @endforeach
            </div>
          </div>
        </div>
    </div>

    <!-- ======= Services Section ======= -->
    <section id="services" class="services-mf pt-5 route">
      <div class="container-fluid px-3 px-md-3 px-lg-4">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
                Serviços
              </h3>
              <div class="line-mf"></div>
            </div>
          </div>
        </div>
        <div class="row">
        @foreach ($services as $service) 
            <div class="col-md-4">
              <div class="service-box">
                <div class="service-ico">
                  <span class="ico-circle"><i class="bi bi-briefcase"></i></span>
                </div>
                <div class="service-content">
                  <h2 class="s-title">{{$service->title}}</h2>
                  <p class="s-description text-center">
                    {{$service->description}}
                  </p>
                </div>
              </div>
            </div>
        @endforeach
        </div>
      </div>
    </section>
    <!-- End Services Section -->

        <!-- ======= Counter Section ======= -->
        <div class="section-counter paralax-mf bg-image">
          <div class="overlay-mf"></div>
          <div class="container-fluid px-3 px-md-3 px-lg-4 position-relative">
            <div class="row">
              <div class="col-sm-3 col-lg-3">
                <div class="counter-box counter-box pt-4 pt-md-0">
                  <div class="counter-ico">
                    <span class="ico-circle"><i class="bi bi-check"></i></span>
                  </div>
                  @foreach ($works as $work)
                      <div class="counter-num">
                        <p data-purecounter-start="0" data-purecounter-end="{{$work->level}}" data-purecounter-duration="5" class="counter purecounter"></p>
                        <span class="counter-text">Trabalhos Concluidos</span>
                      </div>
                  @endforeach
                </div>
              </div>
    
              <div class="col-sm-3 col-lg-3">
                <div class="counter-box pt-4 pt-md-0">
                  <div class="counter-ico">
                    <span class="ico-circle"><i class="bi bi-journal-richtext"></i></span>
                  </div>
                  @foreach ($experience as $experienc)
                      <div class="counter-num">
                        <p data-purecounter-start="0" data-purecounter-end="{{$experienc->level}}" data-purecounter-duration="5" class="counter purecounter"></p>
                        <span class="counter-text">Anos de Experiência</span>
                      </div>
                  @endforeach
                </div>
              </div>
    
              <div class="col-sm-3 col-lg-3">
                <div class="counter-box pt-4 pt-md-0">
                  <div class="counter-ico">
                    <span class="ico-circle"><i class="bi bi-people"></i></span>
                  </div>
                  @foreach ($clients as $client)
                      <div class="counter-num">
                        <p data-purecounter-start="0" data-purecounter-end="{{$client->level}}" data-purecounter-duration="5" class="counter purecounter"></p>
                        <span class="counter-text">Total de Clientes</span>
                      </div> 
                  @endforeach
                </div>
              </div>
    
              <div class="col-sm-3 col-lg-3">
                <div class="counter-box pt-4 pt-md-0">
                  <div class="counter-ico">
                    <span class="ico-circle"><i class="bi bi-award"></i></span>
                  </div>
                  @foreach ($premios as $premio)
                      <div class="counter-num">
                        <p data-purecounter-start="0" data-purecounter-end="{{$premio->level}}" data-purecounter-duration="5" class="counter purecounter"></p>
                        <span class="counter-text">Premios</span>
                      </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Counter Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="work" class="portfolio-mf sect-pt4 route">
      <div class="container-fluid px-3 px-md-3 px-lg-4">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
                Portfolio
              </h3>
              <div class="line-mf"></div>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($projects as $project)
          <div class="col-md-4">
            <div class="work-box">
              <a href="{{Storage::url("arquivos/{$project->image}")}}" data-gallery="portfolioGallery" class="portfolio-lightbox">
                <div class="work-img">
                  <img src="{{Storage::url("arquivos/{$project->image}")}}" alt="" class="img-fluid">
                </div>
              </a>
              <div class="work-content">
                <div class="row">
                  <div class="col-sm-8">
                    <h2 class="w-title">{{$project->title}}</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
            @endforeach
        </div>
      </div>
    </section><!-- End Portfolio Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="paralax-mf footer-paralax bg-image sect-mt4 route imgfooter">
      <div class="overlay-mf"></div>
      <div class="container-fluid px-3 px-md-3 px-lg-4">
        <div class="row">
          <div class="col-sm-12">
            <div class="contact-mf">
              <div id="contact" class="box-shadow-full">
                <div class="row">
                  {{-- <div class="col-md-6">
                    <div class="title-box-2">
                      <h5 class="title-left">
                       Enviar Mensagem
                      </h5>
                    </div>
                    <div>
                      <form action="{{route("site.portfolio.send.email")}}" method="post"  class="form-email">
                        @csrf
                        <div class="row">
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="text" name="name" class="form-control" id="name" placeholder="Seu nome" required>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="email" class="form-control" name="email" id="email" placeholder="Seu Email" required>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" required>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <textarea class="form-control" name="message" rows="5" placeholder="Mensagem" required></textarea>
                            </div>
                          </div>
                          <div class="col-md-12 text-center">
                            <button type="submit" class="button button-a button-big button-rouded">Enviar</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div> --}}
                  <div class="col-md-6">
                    <div class="title-box-2 pt-4 pt-md-0">
                      <h5 class="title-left">
                        Info.
                      </h5>
                    </div>
                    
                    @foreach ($contact as $item)
                    <div class="more-info">
                        <p class="lead">
                          {{$item->atendimento}}
                        </p>
                        <ul class="list-ico">
                            <li><span class="bi bi-geo-alt"></span>{{$item->endereco}}</li>
                            <li><span class="bi bi-phone"></span>+244 {{$item->telefone}}</li>
                            <li><span class="bi bi-envelope"></span>{{$item->email}}</li>
                        </ul>
                    </div>
                    @endforeach
                    <div class="socials">
                      <ul>
                          <li><a href=""><span class="ico-circle"><i class="bi bi-facebook"></i></span></a></li>
                          <li><a href=""><span class="ico-circle"><i class="bi bi-instagram"></i></span></a></li>
                          <li><a href=""><span class="ico-circle"><i class="bi bi-linkedin"></i></span></a></li>
                        </ul>

                        <div class="position-relative col-12 col-xl-6 anuncio-style" style="margin-top: 1rem;">
                          <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                              @foreach ($apiArray as $anuncio)
                              <div class="carousel-item active">
                                  @if ($anuncio["tipo"] === "Quadrado")
                                    <a href="{{$anuncio["link"] ?? NULL}}" target="_blank">
                                      <div>
                                        <img src="{{url("{$anuncio["image_full_url"]}")  ?? NULL}}">
                                        <div style="position: absolute; top:1px; width:10px; height: 10px; right:15px;"><i class="bi bi-info-circle-fill cursor-pointer" style="color: #ffffff" title="Está Publicidade é de inteira responsabilidade da Fort-Code"></i></div>
                                      </div>
                                    </a>
                                  @endif
                                </div>
                                @endforeach
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer>
    <div class="container-fluid px-3 px-md-3 px-lg-4">
      <div class="row">
        <div class="col-sm-12">
          <div class="copyright-box">
            <p class="copyright">&copy; Copyright <a href="https://fortcodedev.com" target="_blank"><strong>Fort-Code</strong></a>. Direitos autorais reservados</p>
            <!-- Button trigger modal termos de cprivacidades e condições-->
            <a type="button" class="text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Politicas de Privacidade |  
            </a>
            <a type="button" class="text-white" data-bs-toggle="modal" data-bs-target="#conditions">
              Termos e Condições   |
            </a>
            <a class="text-white" href="{{route("anuncio.login.view")}}">Fazer Login</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End  Footer -->
  
  <style>
    .copyright-box p a{
      color: #ffffff;
    }
  </style>
    @include("components.pacote.privacy")
  @include("components.pacote.conditions")
@endsection