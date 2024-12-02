<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="{{asset("bootstrap.min.css")}}">
    <style>
        .gradient-custom {
        /* fallback for old browsers */
        background: #6a11cb;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }

        .gradient-custom form div input{
          box-shadow: none !important;
        }
    </style>
</head>
<body>
    @include("sweetalert::alert")
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-4">
                  <div class="mt-md-4 ">
                    <h3 class="fw-bold  text-uppercase text-center">Login</h3>
      
                   <form action="{{route("anuncio.login")}}" method="post">
                        @csrf
                        <div class="form-outline form-white mb-4">
                            <input name="email" type="email" id="typeEmailX" class="form-control form-control-lg" required/>
                            <label class="form-label" for="typeEmailX">Email</label>
                        </div>
        
                        <div class="form-outline form-white mb-4">
                            <input name="password" type="password" id="typePasswordX" class="form-control form-control-lg" required/>
                            <label class="form-label" for="typePasswordX">Password</label>
                        </div>
                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>  
                   </form>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <a class="text-white text-decoration-none fs-5" href="{{route("site.subscription")}}">Criar um Website</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>