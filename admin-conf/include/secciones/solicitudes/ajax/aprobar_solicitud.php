<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// TARIFA Y DESCUENTO QUE SE LE VA A APLICAR
$tarifa = 1;
if(isset($_POST['tarifa']) && $_POST['tarifa'] > 1)			$tarifa = (int)$_POST['tarifa'];
$descuento = 0;
if(isset($_POST['descuento']) && $_POST['descuento'] > 0)	$descuento = (float)$_POST['descuento'];

// DATOS DE LA SOLICITUD
$datos_alta = $db->getRow('SELECT pass, nombre, cif, direccion, poblacion, cp, provincia, email, telefono, estado_alta FROM solicitudes_alta WHERE id='.$id);

if($datos_alta['estado_alta'] < 1){ // SOLO SI ESTÁ PENDIENTE

	// GUARDAMOS LOS DATOS DE LA SOLICITUD DE ALTA EN usuarios_mod
	$ok = $db->insert('usuarios_mod','id_solicitudes_alta, pass, nombre, cif, direccion, poblacion, cp, provincia, email, telefono, actualizado', $id.', "'.$datos_alta['pass'].'", "'.$datos_alta['nombre'].'", "'.$datos_alta['cif'].'", "'.$datos_alta['direccion'].'", "'.$datos_alta['poblacion'].'", "'.$datos_alta['cp'].'", "'.$datos_alta['provincia'].'", "'.$datos_alta['email'].'", "'.$datos_alta['telefono'].'", "'.date("Y-m-d H:i:s").'"');

	if($ok){
		
		// CREAMOS EL USUARIO EN usuarios
		$ok = $db->insert('usuarios','id_usuarios_mod, usuario, tarifa, descuento, activo, fecha_alta, actualizado', $ok.', "'.$datos_alta['email'].'", '.$tarifa.', '.$descuento.', 1, "'.date("Y-m-d H:i:s").'", "'.date("Y-m-d H:i:s").'"');

		if($ok){
		
			$ok = $db->update('solicitudes_alta','estado_alta=2','id='.$id);

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
											<h2><center>¡Enhorabuena!</center></h2>
											<p><center>Tu solicitud de acceso al configurador de Arjomy - Leroy Merlin ha sido aprobada.</center></p>
											<p style="margin-top: 50px;">A partir de ahora puedes acceder al mismo introduciendo como Usuario el e-mail con el que solicitaste el acceso y la contraseña indicada.</p>
											<p>Si tienes cualquier tipo de consulta no dudes en contactar con nosotros en info@arjomy.es, estaremos encantados de ayudarte.</p>
											<p>Atentamente, el equpo de Arjomy.</p>
											<p style="margin: 40px 0; text-align: center;">
												<a style="border-radius: 3px; font-size: 16px; padding: 10px; color: #FFFFFF; background: #A0462E; text-decoration: none;" href="http://www.arjomy.es/configurador-leroy/">Acceder al configurador</a>
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
				//mail($datos_alta['email'], 'Solicitud de acceso al configurador de Arjomy aprobada', $mensaje, $cabeceras);
				
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
					$mail->addAddress($datos_alta['email'], $datos_alta['nombre']);     // Add a recipient
					$mail->addReplyTo('noreply@arjomy.es', 'Configurador Arjomy - Leroy Merlin');

					//Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'Solicitud de acceso al configurador de Arjomy aprobada';
					$mail->Body    = $mensaje;
					$mail->AltBody = '¡Enhorabuena! Tu solicitud de acceso al configurador de Arjomy - Leroy Merlin ha sido aprobada. A partir de ahora puedes acceder al mismo introduciendo como Usuario el e-mail con el que solicitaste el acceso y la contraseña indicada. Atentamente, el equpo de Arjomy.';

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
				$respuesta['mensaje'] = 'Error al aprobar la solicitud. No se pudo cambiar el estado de la solicitud.';
			}
		
		}
		else{
			
			$respuesta['estado'] = 'ko';
			$respuesta['mensaje'] = 'Error al aprobar la solicitud. No se pudo crear el usuario.';
		
		}
	
	}
	else{
		
		$respuesta['estado'] = 'ko';
		$respuesta['mensaje'] = 'Error al aprobar la solicitud. No se guardaron los datos del usuario.';
		
	}
	
}
else{
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al aprobar la solicitud. No se pueden modificar solicitudes aprobadas o rechazadas.';
}

echo json_encode($respuesta);
?>