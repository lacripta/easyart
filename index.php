<!DOCTYPE html>
<?php include_once './templates/jcart_modal.php'; ?>
<html lang="en">
    <?php include_once './templates/header.php'; ?>
    <div class="container">
        <?php include_once './templates/nuevos/carrusel.php'; ?>

        <div class="row">
            <div class="box">
                <div class="home-category-title-container">
                    <span><h2 class="home-category-title">
                            <span>Novedades</span>
                        </h2></span>
                </div>
                <div class="novedades-placeholder"></div>
            </div>
        </div>


        <div class="container box">
            <div class="home-category-title-container">
                <span><h2 class="home-category-title">
                        <span>Articulos Destacados</span>
                    </h2></span>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3">
                        <!-- Controls -->
                        <div class="controls pull-right">
                            <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"
                               data-slide="prev"></a>
                            <a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"
                               data-slide="next"></a>
                        </div>
                    </div>
                </div>
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php
                        $jsonfile = file_get_contents('http://easyart.com.co/easyapp/admin/producto/lista_orden');
                        $productos = json_decode($jsonfile, true);
                        $first = true;

                        foreach ($productos as $lista) {
                            ?>
                            <div class="item <?php
                            if ($first) {
                                $first = false;
                                echo "active";
                            }
                            ?>">
                                <div class="row">
                                    <?php
                                    foreach ($lista as $elemento) {
                                        ?>

                                        <div class="col-sm-3 col-xs-6">
                                            <div class="col-item">
                                                <div class="photo">
                                                    <img  onclick="detalles_productos(<?= $elemento["producto_id"] ?>)" src="<?= $elemento["producto_imagen"] ?>" class="img-responsive" alt="<?= $elemento["producto_imagen_titulo"] ?>" />
                                                </div>
                                                <div class="info">
                                                    <div class="row"  onclick="detalles_productos(<?= $elemento["producto_id"] ?>)">
                                                        <div class="price col-md-6">
                                                            <h6>
                                                                <?= $elemento["producto_nombre"] ?></h6>
                                                            <h6 class="price-text-color">
                                                                <?= "$ " . number_format($elemento["producto_precio"], 0) ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="separator clear-left">
                                                        <form method="post" action="" class="jcart col-sm-6">
                                                            <input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken']; ?>">
                                                            <input type="hidden" name="my-item-id" value="<?= $elemento["producto_id"] ?>">
                                                            <input type="hidden" name="my-item-name" value="<?= $elemento["producto_nombre"] ?>">
                                                            <input type="hidden" name="my-item-price" value="<?= $elemento["producto_precio"] ?>">
                                                            <input type="hidden" name="my-item-url" value="">
                                                            <input type="hidden" name="my-item-qty" value="1">
                                                            <input type="submit" name="my-add-button" value="Agregar" class="boton"></input>
                                                        </form>
                                                        <a onclick="detalles_productos(<?= $elemento["producto_id"] ?>)">Detalles</a>
                                                    </div>
                                                    <div class="clearfix">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detallesModal" tabindex="-1" role="dialog" aria-labelledby="detallesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="detallesModalLabel">Detalles del Producto</h4>
                </div>
                <div class="modal-body">
                    <div class="productos-placeholder"></div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script id="novedades-template" type="text/x-handlebars-template">
        {{#each novedades}}
        <div class="col-lg-12">
        <hr>
        <h2 class="intro-text text-center">
        {{novedades_titulo}}
        </h2>
        <hr>
        <img class="img-responsive img-border img-left" src="{{novedades_imagen_url}}" alt="">
        <hr class="visible-xs">
        {{{novedades_contenido}}}
        </div>
        {{/each}}
    </script>
    <script id="detalles-template" type="text/x-handlebars-template">
        <div class="col-md-12 box">
        <div class="thumbnail col-md-12">
        <img src="{{producto_imagen}}" alt="{{producto_imagen_titulo}}" class="img-responsive" style="height:100%;" id="img_detalles" onclick="imagen('{{producto_imagen}}')">
        </div>
        <div class="thumbnail col-md-12 pull-right">
        <div class="caption-full">
        <h4 class="pull-right">{{precio producto_precio}}</h4>
        <h4><a class="text-uppercase" onclick="detalles_producto({{producto_id}})">{{producto_nombre}}</a></h4>
        <a onclick="productos_categoria('{{producto_categoria}}')">{{producto_categoria}}</a>&#47
        <a onclick="filtro_productos('{{producto_categoria}}','{{producto_grupo}}')">{{producto_grupo}}</a>
        {{{producto_descripcion}}}
        </div>
        <form method="post" action="" class="jcart col-sm-6">
        <input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken']; ?>" />
        <input type="hidden" name="my-item-id" value="{{producto_id}}" />
        <input type="hidden" name="my-item-name" value="{{producto_nombre}}" />
        <input type="hidden" name="my-item-price" value="{{producto_precio}}" />
        <input type="hidden" name="my-item-url" value="{{producto_id}}" />
        <label for="my-item-qty" class="control-label">Cantidad: </label>
        <input type="number" name="my-item-qty" value="1" size="3" min="0" />
        <h4><span class="lead"></span> {{precio producto_precio}} <small>COP</small></h4>
        <input type="submit" name="my-add-button" value="Agregar" class="btn btn-primary" />
        </form>
        </div>
        <div class="col-sm-6">
        <a target="_blank" title="Facebook - {{producto_nombre}}">
        <img src="http://www.mrwonderfulshop.es/skin/frontend/clean/default/images/social-facebook.png" alt="Facebook">
        </a>
        <a target="_blank">
        <img src="http://www.mrwonderfulshop.es/skin/frontend/clean/default/images/social-twitter.png" alt="Twitter">
        </a>
        <a target="_blank">
        <img src="http://www.mrwonderfulshop.es/skin/frontend/clean/default/images/social-pinterest.png" alt="Pinterest">
        </a>
        </div>
        </div>

        {{#each imagenes}}
        <img class="img-responsive col-sm-2 thumbnail" src="{{producto_imagen_url}}" alt="{{producto_imagen_titulo}}" class="img-responsive" onclick="imagen('{{producto_imagen_url}}')">
        {{/each}}
    </script>

    <?php include_once './templates/nuevos/footer.php'; ?>
    <script>
        function imagen(url) {
            $("#img_detalles").attr("src", url);
        }
        Handlebars.registerHelper('precio', function (precio) {
            return accounting.formatMoney(precio, "$ ", 0);
        });
        function detalles_productos(id) {
            var producto = getJson('/easyapp/admin/producto/detalles_producto', {producto_id: id});
            var theTemplate = Handlebars.compile($("#detalles-template").html());
            var theCompiledHtml = theTemplate(producto);
            $('.productos-placeholder').html(theCompiledHtml);
            $('.jcart').submit(function (e) {
                e.preventDefault();
                add($(this));
            });
            $('#detallesModal').modal('show')
        }
        $(function () {
            var novedades = {novedades: getJson('/easyapp/admin/novedades/publicas', {})};
            var theTemplate = Handlebars.compile($("#novedades-template").html());
            var theCompiledHtml = theTemplate(novedades);
            $('.novedades-placeholder').html(theCompiledHtml);
            crear_galeria();
            jcart();
        });
    </script>
</html>
