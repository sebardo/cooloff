<?php
$destinatario = "sergi@maknetic.com"; 
$asunto = "Este mensaje de prueba"; 
$cuerpo = ' 
<html> 
<head> 
<title>Prueba de correo electronico</title> 
</head> 
<body> 
<h1>Hola!</h1> 
<p> 
<b>Correo electrónico de prueba</b>
</p> 
</body> 
</html> 
'; 

//Envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//Dirección del remitente 
$headers .= "From: Kids&Us Poblenou <poblenou@kidsandus.es>\r\n"; 

//Dirección de respuesta (Puede ser una diferente a la de pepito@mydomain.com)
$headers .= "Reply-To: sergi@maknetic.com\r\n"; 

//Ruta del mensaje desde origen a destino 
$headers .= "Return-path: poblenou@kidsandus.es\r\n"; 

mail($destinatario,$asunto,$cuerpo,$headers);

echo '<html><head><title>Prueba de correo electronico</title></head><body><h1>Test ok</h1></body> </html>';
?>