<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Super Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{(Route::current()->getName() == "super.admin.index") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "super.admin.index") ? "text-primary" : ""}}" href="{{route("super.admin.index")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Empresas -->
    <li class="nav-item {{(Route::current()->getName() == "super.admin.account.view") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "super.admin.account.view") ? "text-primary" : ""}}" href="{{route("super.admin.account.view")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Empresas</span>
        </a>
    </li>

    <!-- Nav Item - Empresas -->
    <li class="nav-item {{(Route::current()->getName() == "super.admin.user.view") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "super.admin.user.view") ? "text-primary" : ""}}" href="{{route("super.admin.user.view")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Utilizadores</span>
        </a>
    </li>
    <!-- Nav Item - Pacotes Premium -->
    <li class="nav-item {{(Route::current()->getName() == "super.admin.pacote.view") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "super.admin.pacote.view") ? "text-primary" : ""}}" href="{{route("super.admin.pacote.view")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Pacotes Premium</span>
        </a>
    </li>
    
    <!-- Nav Item - Pacotes Premium -->
    <li class="nav-item {{(Route::current()->getName() == "super.privacy.view") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "super.privacy.view") ? "text-primary" : ""}}" href="{{route("super.privacy.view")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Politicas de Privacidade</span>
        </a>
    </li>

    <!-- Nav Item - Pacotes Premium -->
    <li class="nav-item {{(Route::current()->getName() == "super.admin.documentation.index") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "super.admin.documentation.index") ? "text-primary" : ""}}" href="{{route("super.admin.documentation.index")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Documentaçao</span>
        </a>
    </li>

    <!-- Nav Item - Pacotes Premium -->
    <li class="nav-item {{(Route::current()->getName() == "super.admin.generate.image.index") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "super.admin.generate.image.index") ? "text-primary" : ""}}" href="{{route("super.admin.generate.image.index")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Pacotes Premium</span>
        </a>
    </li>

    <!-- Nav Item - Pacotes Premium -->
    <li class="nav-item {{(Route::current()->getName() == "super.admin.visitor.index") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "super.admin.visitor.index") ? "text-primary" : ""}}" href="{{route("super.admin.visitor.index")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Metricas</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route("anuncio.logout")}}">
            <i class="fa fa-fw fa-tachometer-alt"></i>
            <span>Terminar Sessão</span>
        </a>
    </li>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>