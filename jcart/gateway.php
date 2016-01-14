<?php

// jCart v1.3
// http://conceptlogic.com/jcart/
// This file is called when any button on the checkout page (PayPal checkout, update, or empty) is clicked
// Include jcart before session start
include_once('jcart.php');
require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
$config = $jcart->config;

// The update and empty buttons are displayed when javascript is disabled
// Re-display the cart if the visitor has clicked either button
if ($_POST['jcartUpdateCart'] || $_POST['jcartEmpty']) {

    // Update the cart
    if ($_POST['jcartUpdateCart']) {
        if ($jcart->update_cart() !== true) {
            $_SESSION['quantityError'] = true;
        }
    }

    // Empty the cart
    if ($_POST['jcartEmpty']) {
        $jcart->empty_cart();
    }

    // Redirect back to the checkout page
    $protocol = 'http://';
    if (!empty($_SERVER['HTTPS'])) {
        $protocol = 'https://';
    }

    header('Location: /checkout.php');
    exit;
}

// The visitor has clicked the PayPal checkout button
else {

    ////////////////////////////////////////////////////////////////////////////
    /*

      A malicious visitor may try to change item prices before checking out.

      Here you can add PHP code that validates the submitted prices against
      your database or validates against hard-coded prices.

      The cart data has already been sanitized and is available thru the
      $jcart->get_contents() method. For example:

      foreach ($jcart->get_contents() as $item) {
      $itemId	    = $item['id'];
      $itemName	= $item['name'];
      $itemPrice	= $item['price'];
      $itemQty	= $item['qty'];
      }

     */
    ////////////////////////////////////////////////////////////////////////////
    // For now we assume prices are valid
    $validPrices = true;

    ////////////////////////////////////////////////////////////////////////////
    // If the submitted prices are not valid, exit the script with an error message
    if ($validPrices !== true) {
        die($config['text']['checkoutError']);
    }

    // Price validation is complete
    // Send cart contents to PayPal using their upload method, for details see: http://j.mp/h7seqw
    elseif ($validPrices === true) {
        // Paypal count starts at one instead of zero
        $count = 1;
        /*
          foreach ($jcart->get_contents() as $item) {

          $queryString .= '&item_number_' . $count . '=' . urlencode($item['id']);
          $queryString .= '&item_name_' . $count . '=' . urlencode($item['name']);
          $queryString .= '&amount_' . $count . '=' . urlencode($item['price']);
          $queryString .= '&quantity_' . $count . '=' . urlencode($item['qty']);

          // Increment the counter
          ++$count;
          } */
        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        //echo json_encode($jcart->get_contents());
        $subtotal = 0;
        $tabla = "<table>";
        $tabla .= "<thead>";
        $tabla .= "<th>Cant</th>";
        $tabla .= "<th>Nombre</th>";
        $tabla .= "<th>Precio</th>";
        $tabla .= "</thead>";
        $tabla .= "<tbody>";
        foreach ($jcart->get_contents() as $item) {
            $tabla .= "<tr>";
            $tabla .= "<td>$item[qty]</td>";
            $tabla .= "<td>$item[name]</td>";
            $tabla .= "<td>&#36; " . number_format($item["price"], 0) . "</td>";
            $tabla .= "</tr>";
            $subtotal += $item['subtotal'];
        }
        $subtotal = number_format($subtotal, 0);
        $tabla .= "</tbody>";
        $tabla .= "</tfoot>";
        $tabla .= "<tr>";
        $tabla .= "<td colspan='2'><b>SUBTOTAL</b></td>";
        $tabla .= "<td>&#36; $subtotal</td>";
        $tabla .= "</tr>";
        $tabla .= "</tfoot>";
        $tabla .= "</table>";
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mx1.hostinger.co';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ventas@easyart.com.co';                 // SMTP username
        $mail->Password = 'julylau2015';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 2525;                                    // TCP port to connect to

        $mail->setFrom('ventas@easyart.com.co', 'EasyArt');
        $mail->addAddress(filter_input(INPUT_POST, "cliente_mail"), filter_input(INPUT_POST, "cliente_nombre"));     // Add a recipient
        $mail->addAddress('easy-art@outlook.es', 'EasyArt');     // Add a recipient
        $mail->addAddress('ventas@easyart.com.co', 'EasyArt');     // Add a recipient
        $mail->addReplyTo('ventas@easyart.com.co', 'EasyArt');
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Solicitud de Compra de Productos';
        $mail->Body = "<h4>Instr&uacute;cciones de compra</h4>"
                . "<p>Con la informaci&oacute;n contenida en este mensaje de correo electr&oacute;nico nos pondremos en contacto con usted para coordinar su compra.</p>"
                . "<p>Para esto uno de nuestros asesores se pondr&aacute; en contacto con usted v&iacute;a telef&oacute;nica para coordinar el proceso de pago e instalaci&oacute;n de los productos que ha elegido</p><br>"
                . "Cliente: " . filter_input(INPUT_POST, "cliente_nombre") . "<br>"
                . "e-mail: " . filter_input(INPUT_POST, "cliente_mail") . "<br>"
                . "Telef&oacute;no: " . filter_input(INPUT_POST, "cliente_telefono") . "<br>"
                . "Fecha: " . date("Y-m-d H:i:s") . "<br><br><br>"
                . "<strong>PRODUCTOS QUE DESEA COMPRAR</strong>"
                . $tabla;
        if (!$mail->send()) {
            echo 'Message could not be sent. ';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
            $_SESSION["mensaje"] = "alert(\"Se ha realizado su pedido. Hemos enviado un correo electronico con la lista de productos e información de contacto. Pronto nos comunicaremos con usted\");";
            $jcart->empty_cart();
            header('Location: /checkout.php');
        }

        // Empty the cart
        //$jcart->empty_cart();
        //header('Location: /index.php');
    }
}
?>