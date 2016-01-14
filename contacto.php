<!DOCTYPE html>
<html lang="en">
    <?php include_once './templates/header.php'; ?>
    <div class="container box text-center">
        <div class="col-sm-12"><h4>PETICIONES Y SUGERENCIAS</h4></div>
        <div class="col-sm-12">
            <p>Si deseas dar a conocer tu opinión, dar una sugerencia o ponerteen contacto con nosotros puedes hacerlo por este medio, estos mensajes llegan directamente al personal adecuado para responder tus inquietudes.</p>
        </div>
        <div class="col-sm-12">
            <form class="" action="/jcart/mail.php" method="post">
                <div class="form-group">
                    <label for="contacto_nombre">Nombre:
                        <input name="contacto_nombre" class="form-control" required="">
                    </label>
                    <label for="contacto_mail">e-mail:
                        <input name="contacto_mail" class="form-control" required="">
                    </label>
                    <label for="contacto_telefono">Telefóno:
                        <input name="contacto_telefono" class="form-control" required="">
                    </label>
                </div>
                <div class="form-group">
                    <label for="contacto_asunto">Asunto:
                        <input name="contacto_asunto" class="form-control" required="">
                    </label>
                </div>
                <div class="form-group">
                    <label for="contacto_mensaje">Mensaje:
                        <textarea name="contacto_mensaje" required=""></textarea>
                    </label>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Enviar" onclick="tinyMCE.triggerSave();">
                </div>
            </form>
        </div>

    </div>
    <script type="text/javascript" src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <?php include_once './templates/nuevos/footer.php'; ?>
    <script>
                        $(function () {
<?php
if (isset($_SESSION["contacto"])) {
    echo $_SESSION["contacto"];
    $_SESSION["contacto"] = NULL;
}
?>
                            tinymce.init({selector: 'textarea'});
                        });
    </script>
</html>
