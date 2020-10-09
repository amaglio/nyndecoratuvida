<?php

// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	   $return["error"] = true;
   }
   
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));
 
require("../PHPMailer-master/PHPMailerAutoload.php");
$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';  
$mail->Host = "p3plcpnl0882.prod.phx3.secureserver.net";  
			   
$mail->Username = "administracion@nyndecoratuvida.com"; 
$mail->Password = "administracion2018";  

$mail->Port = 465;  

$mail->From = "administracion@nyndecoratuvida.com"; // Desde donde enviamos (Para mostrar)
$mail->FromName = "Contacto web";

 
$mail->AddAddress("administracion@nyndecoratuvida.com");
$mail->AddAddress("adrian.magliola@gmail.com");

$mail->IsHTML(true); // El correo se envía como HTML
$mail->Subject = "NYN: Contacto WEB"; // Este es el titulo del email.

$body = "<strong>Nombre: </strong>".$_POST['name']."<br>";
$body .= "<strong>Email: </strong>".$_POST['email']."<br>";

if(isset($_POST['subject']))
	$body .= "<strong>Asunto: </strong>".$_POST['subject']."<br>";

$body .= "<strong>Mensaje: </strong>".$_POST['message']."<br>";


$mail->Body = $body;  
$exito = $mail->Send(); // Envía el correo.


if($exito){
 
	$return["error"] = false;
}else{
 
	$return["error"] = true;
}
 
print json_encode($return);	

?>