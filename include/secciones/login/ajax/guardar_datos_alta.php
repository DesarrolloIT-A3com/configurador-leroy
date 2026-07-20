<?php

// HACE FALTA ABRIR UNA CONEXIÓN A BBDD PARA PODER USAR mysqli
$con = $db->connectDB();

// SE PARSEAN LOS DATOS RECIBIDOS PARA EVITAR INYECCIÓN DE CÓDIGO
$nombre = "";
if(isset($_POST['nombre']) && $_POST['nombre'] != "")				$nombre = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['nombre'])));
$cif = "";
if(isset($_POST['cif']) && $_POST['cif'] != "")						$cif = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['cif'])));
$direccion = "";
if(isset($_POST['direccion']) && $_POST['direccion'] != "")			$direccion = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['direccion'])));
$poblacion = "";
if(isset($_POST['poblacion']) && $_POST['poblacion'] != "")			$poblacion = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['poblacion'])));
$cp = "";
if(isset($_POST['cp']) && $_POST['cp'] != "")						$cp = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['cp'])));
$provincia = "";
if(isset($_POST['provincia']) && $_POST['provincia'] != "")			$provincia = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['provincia'])));
$email = "";
if(isset($_POST['email']) && $_POST['email'] != "")					$email = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['email'])));
$telefono = "";
if(isset($_POST['telefono']) && $_POST['telefono'] != "")			$telefono = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['telefono'])));
$pass = "";
if(isset($_POST['pass']) && $_POST['pass'] != "")					$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$db->disconnectDB($con); // DESCONECTAMOS BASE DE DATOS


$ip = "";
if (isset($_SERVER["HTTP_CLIENT_IP"]))
{
	$ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
	$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
{
	$ip = $_SERVER["HTTP_X_FORWARDED"];
}
elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
{
	$ip = $_SERVER["HTTP_FORWARDED_FOR"];
}
elseif (isset($_SERVER["HTTP_FORWARDED"]))
{
	$ip = $_SERVER["HTTP_FORWARDED"];
}
else
{
	$ip = $_SERVER["REMOTE_ADDR"];
}


$ok = false;

$pass_correctas = true;
// COMPROBAMOS QUE HA REPETIDO LA CONTRASEÑA CORRECTAMENTE
if((isset($_POST['pass']) && $_POST['pass'] != "") && (isset($_POST['pass2']) && $_POST['pass2'] != "") && ($_POST['pass'] == $_POST['pass2'])){
	// CONTRASEÑAS CORRECTAS
	$pass_correctas = true;
}else{
	$pass_correctas = false;
}
	
if($pass_correctas){ // SI HAY QUE TENER EN CUENTA LA CONTRASEÑA Y SON CORRECTAS
	// SI ESTÁN TODOS LOS DATOS NECESARIOS
	if($nombre != "" && $cif != "" && $direccion != "" && $poblacion != "" && $cp != "" && $provincia != "" && $email != "" && $telefono != ""){
		
		// COMPROBAMOS QUE NO HAYA UNA SOLICITUD CON EL MISMO E-MAIL PENDIENTE
		$solicitud_pendiente = $db->getVar('SELECT id FROM solicitudes_alta WHERE email = "'.$email.'" AND estado_alta = 0');
		if(!$solicitud_pendiente){
		
			// COMPROBAMOS QUE EL EMAIL NO ESTÁ EN USO
			$existe_usuario = $db->getVar('SELECT id FROM usuarios WHERE usuario = "'.$email.'"');
			if(!$existe_usuario){
				
				$campos = "nombre, cif, direccion, poblacion, cp, provincia, email, telefono, pass, fecha_solicitud, ip_solicitud";
				$valores = "'" . $nombre . "', '" . $cif . "', '". $direccion ."', '". $poblacion ."', '" . $cp . "', '". $provincia ."', '".$email."', '". $telefono ."', '". $pass ."', '" . date('Y-m-d H:i:s')."', '".$ip."'";
				$ok = $db->insert('solicitudes_alta',$campos,$valores);
				
				if($ok){ // SI TODO SE HA GUARDADO BIEN
					
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
												<p>Se ha recibido una nueva solicitud de acceso al configurador de armarios de Leroy Merlin.</p>
												<p>Los datos de la solicitud son los siguientes:</p>
												<p style="line-height: 28px;">
													<b>Nombre:</b> '.$nombre.'<br />
													<b>CIF:</b> '.$cif.'<br />
													<b>Dirección:</b> '.$direccion.'<br />
													<b>Población:</b> '.$poblacion.'<br />
													<b>C. Postal:</b> '.$cp.'<br />
													<b>Provincia:</b> '.$provincia.'<br />
													<b>E-mail:</b> '.$email.'<br />
													<b>Teléfono:</b> '.$telefono.'
												</p>
												<p style="margin: 40px 0; text-align: center;">
													<a style="border-radius: 3px; font-size: 16px; padding: 10px; color: #FFFFFF; background: #A0462E; text-decoration: none;" href="http://www.arjomy.es/configurador-leroy/admin-conf/index.php?seccion=solicitudes">Gestionar solicitud</a>
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
					//mail('info@arjomy.es', 'Nueva solicitud de acceso al configurador', $mensaje, $cabeceras);
					
					// ENVIAMOS CORREO CON SMTP

					//Cargamos librerias
					require_once('libs/phpmailer/Exception.php');
					require_once('libs/phpmailer/PHPMailer.php');
					require_once('libs/phpmailer/SMTP.php');

					$mail = new PHPMailer\PHPMailer\PHPMailer();                              // Passing `true` enables exceptions
					try {
						//Server settings
						//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.arjomy.es';  					  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'noreply@arjomy.es';                // SMTP username
						$mail->Password = 'LaPerdiz78';                       // SMTP password
						//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
						//$mail->Port = 465;                                     // TCP port to connect to
						
						$mail->SMTPOptions = array(  // NECESARIO PARA QUE ACEPTE EL CERTIFICADO AUTO-FIRMADO
							'ssl' => array(
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
							)
						);

						//Recipients
						$mail->setFrom('noreply@arjomy.es', 'Configurador Arjomy - Leroy Merlin');
						$mail->addAddress('info@arjomy.es', 'Información Arjomy');     // Add a recipient
						$mail->addReplyTo('noreply@arjomy.es', 'Configurador Arjomy - Leroy Merlin');

						//Content
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = '[Leroy Merlin] Nueva solicitud de acceso al configurador';
						$mail->Body    = $mensaje;
						$mail->AltBody = 'Nueva solicitud de acceso al configurador de Leroy Merlin, entra en la administración del mismo para gestionarla.';

						$mail->send();
						//echo 'Message has been sent';
					} catch (Exception $e) {
						echo 'Message could not be sent.';
						echo 'Mailer Error: ' . $mail->ErrorInfo;
					}
					
					$respuesta['estado'] = 'ok';
					$respuesta['mensaje'] = "";
						
				}
				else{
					
					// SE PORODUJO UN ERROR AL GUARDAR LOS DATOS
					$respuesta['estado'] = 'ko';
					$respuesta['mensaje'] = 'Error al guardar la solicitud. Inténtelo de nuevo.';
					
				}
				
			}
			else{
				
				$respuesta['estado'] = 'ko';
				$respuesta['mensaje'] = 'Error al guardar la solicitud. El e-mail se encuentra en uso.';
			
			}
		
		}
		else{
		
			$respuesta['estado'] = 'ko';
			$respuesta['mensaje'] = 'Error al guardar la solicitud. Ya hay una solicitud pendiente con este e-mail.';
		
		}
				
	}else{
		
		$respuesta['estado'] = 'ko';
		$respuesta['mensaje'] = 'Error al guardar la solicitud. Revise los campos obligatorios.';
		
	}
}
else{
	
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al guardar la solicitud. Las contraseñas no son iguales.';
	
}

echo json_encode($respuesta);

?>