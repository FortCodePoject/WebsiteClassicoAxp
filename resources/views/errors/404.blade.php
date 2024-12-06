<!DOCTYPE html>
<html lang="pt-ao">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Redirecionamento</title>

  <!-- Vendor CSS Files -->
  <link href="{{asset("assets/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <style>
        :root {
        --primary: #242424;
        --light: #F1F8FF;
        --dark: #242424;
        --yelow: #242424;
        }
        html,
        body {
        width: 100%;
        height: 100%;
        /* fallback for old browsers */
        background: #6a11cb;
        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        a:hover{
            color: #242424 !important;
        }

        #signap form div input,
        #signap form div select{
            box-shadow: none !important;
        }
    </style>
</head>

<body>

    <div class="col-12">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center flex-column text-white text-center text-uppercase p-4">
                <h1 class="display-3 display-md-1">Bem Vindo ao Website Clássico AxP</h1>
                <p class="fs-4 fs-md-2">Para criar o seu Site ou entrar, clique no botão abaixo.</p>
                <div>
                    <a href="{{route('site.subscription')}}" style="width: 150px" class="btn btn-primary me-2 mb-2">Criar Website</a>
                    <a href="{{route('anuncio.login.view')}}" style="width: 150px" class="btn btn-primary mb-2">Entrar</a>
                </div>
            </div>
        </div>
    </div>   

  <!-- Vendor JS Files -->
  <script src="{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>