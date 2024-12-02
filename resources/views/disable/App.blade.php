<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siste Indisponivel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        html, body{
            width: 100%;
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
    </style>
</head>
<body>
    <div class="col-12">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center flex-column text-white text-center text-uppercase p-4" style="margin-top: 15rem;">
                <div class="text-center text-uppercase">
                    <h1 class="display-3 display-md-1 display-lg-1">Site Indisponível</h1>
                    <p class="fs-4 fs-md-3 fs-lg-2">Clique no botão abaixo para fazer login</p>
                    <a href="{{ route('anuncio.login.view') }}" class="btn btn-primary btn-lg mt-3">Entrar</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>