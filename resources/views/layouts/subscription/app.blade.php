<!DOCTYPE html>
<html lang="pt-ao">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield("title")</title>

  <link rel="stylesheet" href="{{asset("css/loading.css")}}">
  <!-- Vendor CSS Files -->
  <link href="{{asset("assets/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
  @livewireStyles
</head>

<body>

    <div class="col-md-12">
        <div class="row">
            {{$slot}}
        </div>
    </div>

  <!-- Vendor JS Files -->
  <script src="{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  @livewireScripts
  <x-livewire-alert::scripts />
</body>
</html>