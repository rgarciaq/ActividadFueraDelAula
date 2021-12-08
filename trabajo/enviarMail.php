<?php
 include_once 'DAO/PermisoDAO.php';
use PHPMailer\PHPMailer\PHPMailer;
$permisoDao=new PermisoDAO();
$permiso=$permisoDao->mostrarPermisoPorId($_POST['idSelecionada']);

require 'vendor/autoload.php';

// Carga la configuración

$config = parse_ini_file('configuracion.ini');



$mail = new PHPMailer;

$mail->isSMTP();

// SMTPDebug = 0 -> desactivado (para uso en producción)

// SMTPDebug = 1 -> mensajes del cliente

// SMTPDebug = 2 -> mensajes del cliente y servidor

$mail->SMTPDebug = $config['SMTPDebug'];

$mail->Host = $config['host'];

$mail->Port = $config['port'];

$mail->SMTPAuth = $config['SMTPAuth'];

$mail->SMTPSecure = $config['SMTPSecure'];

// Usuario de google

$mail->Username = $config['username'];

// Clave

$mail->Password = $config['password'];

$mail->setFrom('ciclosdaw@gmail.com', 'IES Augustóbriga');

// Los destinatarios se añaden con addAdrress()

$mail->addAddress($config['email'], $config['remitente']);

// Asunto del correo

$mail->Subject = $config['asunto'];

$mail->Body = "Se va a realizar la actividad '".$permiso->getNombreActividad()."' el pr&oacute;ximo d&iacute;a: ".$permiso->getDiaActividad();

$mail->MsgHTML("Se va a realizar la actividad ".$permiso->getNombreActividad()." el pr&oacute;ximo d&iacute;a: ".$permiso->getDiaActividad());

//$mail->addAttachment('test.txt');



// Enviar

if (!$mail->send()) {

   echo 'Error en el envío: ' . $mail->ErrorInfo;
   ?>
   <br>
   <a href="index.php">Volver</a>
   <?php
} else {
	
   echo 'El email ha sido enviado correctamente.';
     ?>
   <br>
   <a href="index.php">Volver</a>
   <?php

}



?>