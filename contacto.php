<?php
require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["nombre"]) || !isset($_POST["mensaje"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];


// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "c2010168.ferozo.com";   // HOST O SERVIDOR Dominio alternativo brindado en el email de alta 
$smtpUsuario = "no-reply@c2010168.ferozo.com";  // Mi cuenta de correo
$smtpClave = "0ZrtLsf0vt";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "drahdavid1992@gmail.com";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";


// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Email desde Emilio Civit Apartments"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);


$mail->Body = "
<html> 

<body> 

<h1> Mensaje desde Sitio Web </h1>

<p>Informacion enviada por el usuario de la web:</p>

<p>Nombre: {$nombre}</p>

<p>Email: {$email}</p>

<p>Mensaje: {$mensaje}</p>

</body> 

</html>

<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
  header("Location:http://civitapartments.com.ar/thankyou.html");
} 
else {
    echo "Something went wrong";
    exit();
}
?>