<?php

// jCart v1.3
// http://conceptlogic.com/jcart/
// By default, this file returns the $config array for use with PHP scripts
// If requested via Ajax, the array is encoded as JSON and echoed out to the browser
// Don't edit here, edit config.php
include_once('config.php');

// Use default values for any settings that have been left empty
if (!$config['currencyCode'])
    $config['currencyCode'] = 'USD';
if (!$config['text']['cartTitle'])
    $config['text']['cartTitle'] = 'Carrito de Compras';
if (!$config['text']['singleItem'])
    $config['text']['singleItem'] = 'Artículo';
if (!$config['text']['multipleItems'])
    $config['text']['multipleItems'] = 'Artículos';
if (!$config['text']['subtotal'])
    $config['text']['subtotal'] = 'Subtotal';
if (!$config['text']['update'])
    $config['text']['update'] = 'actualizar';
if (!$config['text']['checkout'])
    $config['text']['checkout'] = 'Revisar';
if (!$config['text']['checkoutPaypal'])
    $config['text']['checkoutPaypal'] = 'Pagar con PayPal';
if (!$config['text']['removeLink'])
    $config['text']['removeLink'] = 'quitar';
if (!$config['text']['emptyButton'])
    $config['text']['emptyButton'] = 'vaciar';
if (!$config['text']['emptyMessage'])
    $config['text']['emptyMessage'] = 'El Carrito esta vacio!';
if (!$config['text']['itemAdded'])
    $config['text']['itemAdded'] = 'Artículo agregado!';
if (!$config['text']['priceError'])
    $config['text']['priceError'] = 'Formato de precio invalido!';
if (!$config['text']['quantityError'])
    $config['text']['quantityError'] = 'La cantidad de articulos debe ser un numero!';
if (!$config['text']['checkoutError'])
    $config['text']['checkoutError'] = 'No se puede procesar su orden!';

if ($_GET['ajax'] == 'true')
{
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($config);
}
?>