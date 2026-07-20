<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

$datos_alta = $db->getRow('SELECT estado_alta, email FROM solicitudes_alta WHERE id='.$id);

if($datos_alta['estado_alta'] < 1){ // SOLO SI ESTÁ PENDIENTE
	$ok = $db->update('solicitudes_alta','estado_alta=1','id='.$id);

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
									<h2><center>¡Lo sentimos!</center></h2>
									<p><center>Tu solicitud de acceso al configurador de Arjomy - Leroy Merlin ha sido rechazada.</center></p>
									<p style="margin-top: 50px;">Si tienes cualquier tipo de consulta no dudes en contactar con nosotros en info@arjomy.es, estaremos encantados de ayudarte.</p>
									<p>Atentamente, el equpo de Arjomy.</p>
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
		//mail($datos_alta['email'], 'Solicitud de acceso al configurador de Arjomy rechazada', $mensaje, $cabeceras);
		
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
			$mail->setFrom('noreply@arjomy.es', 'Configurador Arjomy');
			$mail->addAddress($datos_alta['email'], $datos_alta['nombre']);     // Add a recipient
			$mail->addReplyTo('noreply@arjomy.es', 'Configurador Arjomy');

			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Solicitud de acceso al configurador de Arjomy rechazada';
			$mail->Body    = $mensaje;
			$mail->AltBody = '¡Lo sentimos! Tu solicitud de acceso al configurador de Arjomy - Leroy Merlin ha sido rechazada. Si tienes cualquier tipo de consulta no dudes en contactar con nosotros en info@arjomy.es, estaremos encantados de ayudarte. Atentamente, el equpo de Arjomy.';

			$mail->send();
			//echo 'Message has been sent';
		} catch (Exception $e) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
		
		$respuesta['estado'] = 'ok';
		$respuesta['mensaje'] = '';
	}
	else{
		$respuesta['estado'] = 'ko';
		$respuesta['mensaje'] = 'Error al rechazar la solicitud. Inténtalo de nuevo.';
	}
}
else{
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al rechazar la solicitud. No se puden modificar solicitudes aprobadas o rechazadas.';
}

echo json_encode($respuesta);
?>