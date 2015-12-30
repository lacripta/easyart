<!DOCTYPE html>
<html lang="en">
    <?php include_once './templates/nuevos/header.php'; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row box">
            <div class="">
                <div class="col-md-3">
                    <p class="lead">EasyArt</p>
                    <p class="text-muted">Categorias de producto</p>
                    <div class="categorias-placeholder"></div>
                </div>

                <div class="col-md-9">
                    <?php include_once './templates/nuevos/carrusel_productos.php'; ?>
                    <div class="col-sm-12">
                        <ol class="breadcrumb" id="productos-breadcrumbs">
                            <li><a onclick="lista_categorias()">Inicio</a></li>
                            <li rv-show="nav.categoria_visible" ><a rv-on-click="nav.categoria_fn">{nav.categoria}</a></li>
                            <li rv-show="nav.grupo_visible"><a rv-on-click="nav.grupo_fn">{nav.grupo}</a></li>
                            <li rv-show="nav.producto_visible"><a rv-on-click="nav.producto_fn">{nav.producto_nombre}</a></li>
                        </ol>
                    </div>
                    <div class="row">
                        <div class="productos-placeholder"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="imagen_modal" tabindex="-1" role="dialog" aria-labelledby="imagen_modalLabel">
            <div class="modal-dialog" role="document">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;"><b>&times;</b></span></button>
                <img id="vista" width="100%">
            </div>
        </div>
    </div>
    <script id="categorias-template" type="text/x-handlebars-template">
        <div class="list-group">
        {{#each categorias}}
        <a onclick="categoria('{{producto_categoria_nombre}}')" class="list-group-item">{{producto_categoria_nombre}}</a>
        {{/each}}
        </div>
    </script>
    <script id="grupos-template" type="text/x-handlebars-template">
        <div class="list-group">
        <a onclick="lista_categorias()" class="">Volver</a>
        <a onclick="productos_categoria('{{categoria}}')" class="list-group-item">Ver todos</a>
        {{#each grupos}}
        <a onclick="filtro_productos('{{producto_grupo_categoria}}','{{producto_grupo_nombre}}')" class="list-group-item">{{producto_grupo_nombre}}</a>
        {{/each}}
        </div>
    </script>
    <script id="productos-template" type="text/x-handlebars-template">
        {{#each productos}}
        <div class="col-sm-4 col-xs-12">
        <div class="thumbnail">
        <a onclick="detalles_producto({{producto_id}})">
        <img src="{{producto_imagen}}" alt="{{producto_imagen_titulo}}" class="img-responsive" style="width:100%;">
        </a>
        <div class="caption">
        <span class="pull-right text-uppercase">
        <b>{{precio producto_precio}}</b>
        </span>
        <span>
        <a class="text-uppercase" onclick="detalles_producto({{producto_id}})">{{producto_nombre}}</a>
        <br>
        <a onclick="productos_categoria('{{producto_categoria}}')">{{producto_categoria}}</a>&#47
        <a onclick="filtro_productos('{{producto_categoria}}','{{producto_grupo}}')">{{producto_grupo}}</a>
        </span><br>
        <span  class="text-capitalize" style="font-size: 14px;">
        {{{producto_resumen}}}
        </span>
        </div>
        </div>
        </div>
        {{/each}}
    </script>
    <script id="detalles-template" type="text/x-handlebars-template">
        <div class="col-md-12 box">
        <div class="thumbnail col-md-5">
        <img src="{{producto_imagen}}" alt="{{producto_imagen_titulo}}" class="img-responsive" style="height:100%;"  onclick="imagen('{{producto_imagen}}')">
        </div>
        <div class="thumbnail col-md-6 pull-right">
        <div class="caption-full">
        <h4 class="pull-right">{{precio producto_precio}}</h4>
        <h4><a class="text-uppercase" onclick="detalles_producto({{producto_id}})">{{producto_nombre}}</a></h4>
        <a onclick="productos_categoria('{{producto_categoria}}')">{{producto_categoria}}</a>&#47
        <a onclick="filtro_productos('{{producto_categoria}}','{{producto_grupo}}')">{{producto_grupo}}</a>
        {{{producto_descripcion}}}
        </div>
        </div>
        </div>
        {{#each imagenes}}
        <img class="img-responsive col-sm-2 thumbnail" src="{{producto_imagen_url}}" alt="{{producto_imagen_titulo}}" class="img-responsive" onclick="imagen('{{producto_imagen_url}}')">
        {{/each}}
    </script>
    <!-- /.container -->
    <?php include_once './templates/nuevos/footer.php'; ?>
    <script>
        function imagen(url) {
            $("#vista").attr("src", url);
            $('#imagen_modal').modal('show')
        }
        var productos_breadcrumbs = {
            categoria: '',
            categoria_visible: false,
            categoria_fn: function () {
                productos_breadcrumbs.categoria;
                productos_breadcrumbs.categoria_visible = true;
                productos_breadcrumbs.grupo_visible = false;
                productos_breadcrumbs.producto_visible = false;
                var productos = {productos: getJson('/easyapp/admin/producto/productos_categoria', {producto_categoria: productos_breadcrumbs.categoria})};
                var theTemplate = Handlebars.compile($("#productos-template").html());
                var theCompiledHtml = theTemplate(productos);
                $('.productos-placeholder').html(theCompiledHtml);
            },
            grupo: '',
            grupo_visible: false,
            grupo_fn: function () {
                productos_breadcrumbs.categoria_visible = true;
                productos_breadcrumbs.grupo_visible = true;
                productos_breadcrumbs.producto_visible = false;
                var productos = {
                    productos: getJson('/easyapp/admin/producto/filtro_productos', {
                        producto_categoria: productos_breadcrumbs.categoria,
                        producto_grupo: productos_breadcrumbs.grupo
                    })};
                var theTemplate = Handlebars.compile($("#productos-template").html());
                var theCompiledHtml = theTemplate(productos);
                $('.productos-placeholder').html(theCompiledHtml);
            },
            producto: '',
            producto_nombre: '',
            producto_visible: false,
            producto_fn: function () {
                var producto = getJson('/easyapp/admin/producto/detalles_producto', {producto_id: productos_breadcrumbs.producto});
                productos_breadcrumbs.categoria = producto.producto_categoria;
                productos_breadcrumbs.categoria_visible = true;
                productos_breadcrumbs.grupo = producto.producto_grupo;
                productos_breadcrumbs.grupo_visible = true;
                productos_breadcrumbs.producto = producto.producto_id;
                productos_breadcrumbs.producto_nombre = producto.producto_nombre;
                productos_breadcrumbs.producto_visible = true;
                var theTemplate = Handlebars.compile($("#detalles-template").html());
                var theCompiledHtml = theTemplate(producto);
                $('.productos-placeholder').html(theCompiledHtml);
            }
        };
        function detalles_producto(id) {
            var producto = getJson('/easyapp/admin/producto/detalles_producto', {producto_id: id});
            productos_breadcrumbs.categoria = producto.producto_categoria;
            productos_breadcrumbs.categoria_visible = true;
            productos_breadcrumbs.grupo = producto.producto_grupo;
            productos_breadcrumbs.grupo_visible = true;
            productos_breadcrumbs.producto = producto.producto_id;
            productos_breadcrumbs.producto_nombre = producto.producto_nombre;
            productos_breadcrumbs.producto_visible = true;
            var theTemplate = Handlebars.compile($("#detalles-template").html());
            var theCompiledHtml = theTemplate(producto);
            $('.productos-placeholder').html(theCompiledHtml);
        }
        function categoria(id) {
            productos_breadcrumbs.categoria = '';
            productos_breadcrumbs.categoria_visible = false;
            productos_breadcrumbs.grupo = '';
            productos_breadcrumbs.grupo_visible = false;
            productos_breadcrumbs.producto = '';
            productos_breadcrumbs.producto_visible = false;
            var grupos = {categoria: id, grupos: getJson('/easyapp/admin/producto/grupos', {producto_categoria: id})};
            var theTemplate = Handlebars.compile($("#grupos-template").html());
            var theCompiledHtml = theTemplate(grupos);
            $('.categorias-placeholder').html(theCompiledHtml);
        }

        function filtro_productos(categoria, grupo) {
            productos_breadcrumbs.categoria = categoria;
            productos_breadcrumbs.categoria_visible = true;
            productos_breadcrumbs.grupo = grupo;
            productos_breadcrumbs.grupo_visible = true;
            productos_breadcrumbs.producto_visible = false;
            var productos = {productos: getJson('/easyapp/admin/producto/filtro_productos', {producto_categoria: categoria, producto_grupo: grupo})};
            var theTemplate = Handlebars.compile($("#productos-template").html());
            var theCompiledHtml = theTemplate(productos);
            $('.productos-placeholder').html(theCompiledHtml);
        }

        function productos_categoria(categoria) {
            productos_breadcrumbs.categoria = categoria;
            productos_breadcrumbs.categoria_visible = true;
            productos_breadcrumbs.grupo_visible = false;
            productos_breadcrumbs.producto_visible = false;
            var productos = {productos: getJson('/easyapp/admin/producto/productos_categoria', {producto_categoria: categoria})};
            var theTemplate = Handlebars.compile($("#productos-template").html());
            var theCompiledHtml = theTemplate(productos);
            $('.productos-placeholder').html(theCompiledHtml);
        }

        Handlebars.registerHelper('precio', function (precio) {
            return accounting.formatMoney(precio, "$ ", 0);
        });
        function lista_categorias() {
            productos_breadcrumbs.categoria = '';
            productos_breadcrumbs.categoria_visible = false;
            productos_breadcrumbs.grupo = '';
            productos_breadcrumbs.grupo_visible = false;
            productos_breadcrumbs.producto = '';
            productos_breadcrumbs.producto_visible = false;
            var context = {
                categorias: getJson('/easyapp/admin/producto/categorias', {}),
                productos: getJson('/easyapp/admin/producto/lista', {})
            };
            var theTemplate = Handlebars.compile($("#categorias-template").html());
            var theCompiledHtml = theTemplate(context);
            $('.categorias-placeholder').html(theCompiledHtml);
            var theTemplate = Handlebars.compile($("#productos-template").html());
            var theCompiledHtml = theTemplate(context);
            $('.productos-placeholder').html(theCompiledHtml);
        }
        $(function () {
            rivets.bind($('#productos-breadcrumbs'), {nav: productos_breadcrumbs});
            lista_categorias();
            galeria_productos();
        });

    </script>

</html>
