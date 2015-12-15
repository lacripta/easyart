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
        <title>jCart - Free Ajax/PHP shopping cart</title>

    </head>
    <body class="container">

        <div id="wrapper">
            <h2>Demo Checkout</h2>

            <div id="sidebar">
            </div>

            <div id="content">
                <div id="jcart"><?php $jcart->display_cart(); ?></div>

                <p><a href="index.php">&larr; Seguir Comprando</a></p>

                <?php
//echo '<pre>';
//var_dump($_SESSION['jcart']);
//echo '</pre>';
                ?>
            </div>

            <div class="clear"></div>
        </div>
        <?php include_once './templates/footer.php'; ?>
    </body>
</html>