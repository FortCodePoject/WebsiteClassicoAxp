@extends("layouts.index")
@section("title", "Painel SuperAdmin")
@section("content")
@include("superadmin.includes.sidebar")
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        @include("superadmin.includes.topbar")
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid" style="margin-top: 17rem">
            <div class="row col-xl-12 d-flex justify-content-center align-content-center">
            
                <div class="text-center">
                    <h1>Bem Vindo ao Painel Administrativo da Plataforma</h1>
                </div>
                
            </div> 
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
@endsection