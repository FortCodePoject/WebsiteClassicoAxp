<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield("title")</title>

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  @livewireStyles
</head>

<body>
  @yield("content")

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <script>
      class Cookies {
            constructor() {
              this.key = '@cookies';
              this.init();
            }
          
            layout() {
              return `
                <div id="cookies" class="wrapper">
                  <div class="content">
                    <header>Política de Cookies</header>
                    <p>
                      Usamos cookies em nosso site para ver como você interage com ele. Ao aceitar este banner, você concorda com o uso de tais cookies.
                    </p>
                    <div class="buttons">
                      <button class="item" onclick="cookies.accept();">Aceitar</button>
                      <a href="#" onclick="cookies.readMore(); return false;">Ler Mais</a>
                    </div>
                  </div>
                </div>
              `;
            }
          
            save() {
              localStorage.setItem(this.key, 'true'); // Armazena como string 'true'
            }
          
            get() {
              return localStorage.getItem(this.key) === 'true'; // Retorna true se 'true' estiver armazenado
            }
          
            create() {
              const existingCookies = document.querySelector("#cookies");
              if (!existingCookies) {
                document.body.insertAdjacentHTML('beforeend', this.layout());
              }
            }
          
            remove() {
              const cookiesElement = document.querySelector("#cookies");
              if (cookiesElement) {
                cookiesElement.parentNode.removeChild(cookiesElement);
              }
            }
          
            accept() {
              this.save();
              this.remove();
            }
          
            readMore() {
              // Implementar a lógica para exibir mais informações sobre cookies (opcional)
              alert("Implemente aqui a lógica para 'Ler Mais' sobre cookies.");
            }
          
            async init() {
              if (!this.get()) {
                this.create();
              }
            }
      }
          
      const cookies = new Cookies();
  </script>
  <!-- Politica de cookies -->

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/typed.js/typed.umd.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  {{-- Caso necessário, descomente cookies.js depois de corrigir declarações duplicadas de Cookies --}}
  {{-- <script src="{{ asset('assets/js/cookies.js') }}"></script> --}}
  
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  @livewireScripts
  <x-livewire-alert::scripts />

  @stack('preloader')
</body>
</html>
