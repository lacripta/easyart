<!-- Material Design fonts -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Material Design -->
<link href="css/bootstrap-material-design.css" rel="stylesheet">
<link href="css/ripples.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen, projection" href="/easyart/jcart/css/jcart.css" />
<link href="/easyart/css/style.css" rel="stylesheet">
<img src="/easyart/img/logo.png" class="hidden-xs hidden-sm" width="30%" alt="EasyArt llena de vida tu hogar">
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#elementos-menu">
                <span class="sr-only">Navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-md hidden-lg"  href="http://localhost/admin/"><img src="/easyart/img/logo2.png" height="150%"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="elementos-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Administracion<span class="caret"></span>
                        <div class="ripple-wrapper"></div>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="http://localhost/admin/usuario">Gestión de Usuarios</a>
                        </li>
                        <li>
                            <a href="http://localhost/admin/usuario/add">Crear Usuario</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="http://localhost/admin/grupo">Gestión de Grupos</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="http://localhost/admin/menu">Editor de Menu</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Contenido<span class="caret"></span>
                        <div class="ripple-wrapper"></div>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="divider"></li>
                        <li>
                            <a href="http://localhost/admin/articulo">Gestión de Articulos</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#jcartModal">Carrito de Compra</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

