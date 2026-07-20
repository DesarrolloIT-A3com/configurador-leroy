<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// MIRAMOS SI ESTABA ENVIADO O NO PARA RESTARLO A LOS CONTADORES DE LA CABECERA DEL LISTADO
$enviado = $db->getVar('SELECT enviado FROM proyectos WHERE id_usuario='.$_SESSION['id_usuario'].' AND id='.$id);

// LO MARCAMOS COMO ENVIADO
$ok = $db->update('proyectos','enviado=1, fecha_enviado=NOW()','id_usuario='.$_SESSION['id_usuario'].' AND id='.$id);

	
if($ok){
	
	// ENVIAR MAIL A ARJOMY
	$mensaje = '
		<table style="width: 100%; height: 100%; text-align: center; background: #fafafa; border: 0; font-family: Arial, sans-serif; " cellspacing="0">
			<tr>
				<td>
					<table style="width: 100%; max-width: 560px; height: 100%; margin: 0 auto; padding: 0 20px; font-size: 16px; text-align: left; background: #ffffff;">
						<tr>
							<td style="text-align: center;">
								<img style="width: 120px; padding: 20px;" src="http://www.arjomy.es/configurador-leroy/www/img/logo_arjomy.png" />
							</td>
						</tr>
						<tr>
							<td>
								<p>Se ha recibido un nuevo proyecto desde el configurador de armarios de Leroy Merlin.</p>
								<p>Distribuidor:</p>
								<p style="line-height: 28px;">
									<b>'.$_SESSION['nombre_usuario'].'</b>
								</p>
								<p style="margin: 40px 0; text-align: center;">
									<a style="border-radius: 3px; font-size: 16px; padding: 10px; color: #FFFFFF; background: #A0462E; text-decoration: none;" href="http://www.arjomy.es/configurador-leroy/admin-conf/index.php?seccion=usuarios&sub=ver_usuario&id='.$_SESSION['id_usuario'].'">Gestionar proyecto</a>
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
		';
	
	// Para enviar un correo HTML, debe establecerse la cabecera Content-type
	//$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	//$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	// Cabeceras adicionales
	//$cabeceras .= 'From: info@arjomy.es' . "\r\n";
	// Enviarlo
	//mail('pedidos@arjomy.es', 'Nuevo proyecto enviado desde el configurador', $mensaje, $cabeceras);
	
	// ENVIAMOS CORREO CON SMTP

	//Cargamos librerias
	require_once('libs/phpmailer/Exception.php');
	require_once('libs/phpmailer/PHPMailer.php');
	require_once('libs/phpmailer/SMTP.php');

	$mail = new PHPMailer\PHPMailer\PHPMailer(true);                              // Passing `true` enables exceptions
	try {
		//Server settings
		//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.arjomy.es';  					  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'noreply@arjomy.es';                // SMTP username
		$mail->Password = 'LaPerdiz78';                       // SMTP password
		//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		//$mail->Port = 25;                                     // TCP port to connect to

		$mail->SMTPOptions = array(  // NECESARIO PARA QUE ACEPTE EL CERTIFICADO AUTO-FIRMADO
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		
		//Recipients
		$mail->setFrom('noreply@arjomy.es', 'Configurador Arjomy - Leroy Merlin');
		$mail->addAddress('pedidos@arjomy.es', 'Pedidos Arjomy');     // Add a recipient
		$mail->addReplyTo('noreply@arjomy.es', 'Configurador Arjomy - Leroy Merlin');

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = '[Leroy Merlin] Nuevo proyecto enviado desde el configurador';
		$mail->Body    = $mensaje;
		$mail->AltBody = 'Nuevo proyecto enviado desde el configurador de Leroy Merlin, entra en la administración del mismo para gestionarlo.';

		$mail->send();
		//echo 'Message has been sent';
	} catch (Exception $e) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
	
	$respuesta['estado'] = 'ok';
	$respuesta['mensaje'] = $enviado;
}
else{
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al enviar el proyecto. Inténtelo de nuevo.';
}

echo json_encode($respuesta);
?>