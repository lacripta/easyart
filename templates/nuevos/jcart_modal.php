<?php
// jCart v1.3
// http://conceptlogic.com/jcart/
// This file demonstrates a basic store setup
// If your page calls session_start() be sure to include jcart.php first
include_once('jcart/jcart.php');

session_start();
?>
<div class="modal fade" id="jcartModal" tabindex="-1" role="dialog" aria-labelledby="jcartModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="jcartModalLabel">Carrito de Compra</h4>
            </div>
            <div class="modal-body">
                <div id="jcart"><?php $jcart->display_cart(); ?></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>