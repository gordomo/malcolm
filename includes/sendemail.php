<?php

require_once('phpmailer/class.phpmailer.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587;
$mail->IsHTML(true);
$mail->CharSet = "utf-8";

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "sd-1460080-h00001.ferozo.net";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "contacto@espaciomalcolm.com.ar";  // Mi cuenta de correo
$smtpClave = "Aoi12Jjio92";  // Mi contraseña

// VALORES A MODIFICAR //
$mail->Host = $smtpHost;
$mail->Username = $smtpUsuario;
$mail->Password = $smtpClave;

// VALORES A MODIFICAR //
$mail->Host = $smtpHost;
$mail->Username = $smtpUsuario;
$mail->Password = $smtpClave;

$name = isset($_POST['nombre']) ? $_POST['nombre'] : 'Nombre';
$email = isset($_POST['email']) ? $_POST['email'] : 'email';
$phone = isset($_POST['phone']) ? $_POST['phone'] : 'phone';
$message = isset($_POST['message']) ? $_POST['message'] : 'message';


$toemail = 'contacto@espaciomalcolm.com.ar';
$toname = 'Contacto desde la Web';

$mail->SetFrom($email, $name);
$mail->AddReplyTo($email, $name);
$mail->AddAddress($toemail, $toname);
$mail->Subject = $toname;

$name = isset($name) ? "Nombre: $name<br>" : '';
$lastName = isset($lastName) ? "Apellido: $lastName<br>" : '';
$email = isset($email) ? "Email: $email<br>" : '';
$phone = isset($phone) ? "Telefono: $phone<br><br>" : '';
$message = isset($message) ? "Mensaje: $message<br><br>" : '';

$referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>Mensaje enviado desde: ' . $_SERVER['HTTP_REFERER'] : '';

$body = "$name $email $phone $message $referrer";

$mail->MsgHTML($body);
$sendEmail = $mail->Send();

if ($sendEmail == true) {
    $msg = 'Hemos recibido su mensaje <strong>correctamente</strong> le responderemos lo más pronto posible.';
    $status = "ok";
} else {
    $msg = 'El mensaje <strong>no</strong> pudo ser enviado. Por favor, intente de nuevo más tarde.<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo . '';
    $status = "ko";
}

echo json_encode(array("status"=>$status, "msg"=>$msg));

?>