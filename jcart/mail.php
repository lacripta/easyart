<?php

require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mx1.hostinger.co';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'ventas@easyart.com.co';                 // SMTP username
$mail->Password = 'julylau2015';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 2525;                                    // TCP port to connect to

$mail->setFrom('ventas@easyart.com.co', 'EasyArt');
$mail->addAddress(filter_input(INPUT_POST, "contacto_mail"), filter_input(INPUT_POST, "contacto_nombre"));     // Add a recipient
$mail->addBCC('easy-art@outlook.es', 'EasyArt');     // Add a recipient
$mail->addBCC('ventas@easyart.com.co', 'EasyArt');     // Add a recipient
$mail->addReplyTo('ventas@easyart.com.co', 'EasyArt');
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Solicitudes y Sugerencias';
$mail->Body = "Cliente: " . filter_input(INPUT_POST, "contacto_nombre") . "<br>"
        . "e-mail: " . filter_input(INPUT_POST, "contacto_mail") . "<br>"
        . "Telef&oacute;no: " . filter_input(INPUT_POST, "contacto_telefono") . "<br>"
        . "Fecha: " . date("Y-m-d H:i:s") . "<br><br><br>"
        . "Asunto: " . filter_input(INPUT_POST, "contacto_asunto") . "<br>"
        . "<strong>" . filter_input(INPUT_POST, "contacto_asunto") . "</strong>"
        . filter_input(INPUT_POST, "contacto_mensaje");
if (!$mail->send()) {
    echo 'Message could not be sent. ';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    session_start();
    $_SESSION["contacto"] = "alert(\"Su mensaje ha sido enviado\");";
    header('Location: /contacto.php');
}

