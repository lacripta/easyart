<?php
// jCart v1.3
// http://conceptlogic.com/jcart/
// This file demonstrates a basic store setup
// If your page calls session_start() be sure to include jcart.php first
include_once('jcart/jcart.php');

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <?php include_once './templates/header.php'; ?>

    </head>
    <div id="wrapper" class="container box">
        <h2>Carrito de compras</h2>
        <p>Para el proceso de compra se hará un pedido a los administradores de la tienda por medio de correo electrónico, quienes se pondrán en contacto con usted para coordinar el pago e instalación de los productos deseados.</p>
        <div id="sidebar">
        </div>

        <div id="content" class="text-center">
            <div id="jcart"><?php $jcart->display_cart(); ?></div>
        </div>
        <p><a href="productos.php">&larr; Seguir Comprando</a></p>

        <div class="clear"></div>
    </div>
    <?php include_once './templates/nuevos/footer.php'; ?>
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
    <script>

        function imagen(url) {
            $("#img_detalles").attr("src", url);
        }
        Handlebars.registerHelper('precio', function (precio) {
            return accounting.formatMoney(precio, "$ ", 0);
        });
        function detalles_producto(id) {
            var producto = getJson('/easyapp/admin/producto/detalles_producto', {producto_id: id});
            var theTemplate = Handlebars.compile($("#detalles-template").html());
            var theCompiledHtml = theTemplate(producto);
            $('.productos-placeholder').html(theCompiledHtml);
            $('.jcart').submit(function (e) {
                e.preventDefault();
                add($(this));
            });
            $('#detallesModal').modal('show');

        }

        $(document).ready(function () {
<?php
if (isset($_SESSION["mensaje"])) {
    echo $_SESSION["mensaje"];
    $_SESSION["mensaje"] = NULL;
}
?>
            $("#6carrito_easyart").submit(function (e) {
                e.preventDefault();
            });

        });</script>
</html>