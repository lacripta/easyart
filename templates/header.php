<head>
    <meta charset="UTF-8">
    <!-- Material Design fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Material Design -->
    <link href="css/bootstrap-material-design.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen, projection" href="/easyart/jcart/css/jcart.css" />
    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/shop-item.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <title>EasyArt - Decoraci&oacuten Detalles y Dise&#209o</title>
</head>
<?php
$estilo = json_decode(file_get_contents('http://easyart.com.co/easyapp/admin/estilos/actual'), true);
?>
<div class="container">
    <div class="brand"><img src="/easyart/img/logo.png" class="hidden-xs hidden-sm" width="30%" alt="EasyArt Decoraci&oacuten Detalles y Dise&#209o"></div>
    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation" style="<?php echo $estilo[array_search("background-color", array_column($estilo, "estilo_nombre"))]["estilo_nombre"] . ":" . $estilo[array_search("background-color", array_column($estilo, "estilo_nombre"))]["estilo_valor"] . ";"; ?>">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand hidden-md hidden-lg"  href="/easyart/index.php"><img src="/easyart/img/logo.png" height="150%"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <li>
                        <a href="productos.php">Productos</a>
                    </li>
                    <li>
                        <a href="nosotros.php">Nosotros</a>
                    </li>
                    <li>
                        <a href="contacto.php">Contactenos</a>
                    </li>
                    <li>
                        <a href="checkout.php">Carrito</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class='botones-sociales derecha'>
        <a class='itemsocial' href='' id='facebook-btn' target='_blank'><span class='social'><span class='texto'></span></span></a>
    </div>

</div>
<body style="<?php echo $estilo[array_search("background-image", array_column($estilo, "estilo_nombre"))]["estilo_nombre"] . ":url('" . $estilo[array_search("background-image", array_column($estilo, "estilo_nombre"))]["estilo_valor"] . "');"; ?>">