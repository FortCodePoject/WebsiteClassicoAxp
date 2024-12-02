<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route("admin.index")}}">
        <div class="sidebar-brand-text mx-3"><h6>Painel Admin</h6></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{(Route::current()->getName() == "admin.index") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "admin.index") ? "text-primary" : ""}}" href="{{route("admin.index")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Definições -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePremium"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Elementos Premium</span>
        </a>
        
        <div id="collapsePremium" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{(Route::current()->getName() == "loja.online") ? "text-primary" : ""}}" href="{{route("loja.online")}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Adicionar</span>
                </a>

                <a class="collapse-item {{(Route::current()->getName() == "plataform.portfolio.admin.delivery.status") ? "text-primary" : ""}}" href="{{route("plataform.portfolio.admin.delivery.status")}}" >
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Verificar meu Pedido</span>
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - shopping -->
    <li class="nav-item {{(Route::current()->getName() == "admin.general.shopping") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "admin.general.shopping") ? "text-primary" : ""}}" href="{{route("admin.general.shopping")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>loja Produtos</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Definições -->
    <li class="nav-item {{(Route::current()->getName() == "denition.general") ? "bg-white" : ""}}">
        <a class="nav-link collapsed {{(Route::current()->getName() == "denition.general") ? "text-primary" : ""}}" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Definições</span>
        </a>
        
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded overflow-auto">

                <a class="collapse-item {{Route::current()->getName() == "denition.general" ? "text-primary" : ""}}" href="{{route("denition.general")}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Geral</span>
                </a>

                <a class="collapse-item" href="#" data-toggle="modal" data-target="#help">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Suporte</span>
                </a>
            </div>
        </div>

        <!-- Nav Item - Dashboard -->
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