<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();


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
$cambiar_pass = 0;
if(isset($_POST['cambiar_pass']) && $_POST['cambiar_pass'] > 0)		$cambiar_pass = (int)$_POST['cambiar_pass'];
$pass = "";
if(isset($_POST['pass']) && $_POST['pass'] != "")					$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$db->disconnectDB($con); // DESCONECTAMOS BASE DE DATOS

$ok = false;

$pass_correctas = true;
$guarda_pass = false;
if($cambiar_pass == 1){// SI HAY QUE TENER EN CUENTA LA CONTRASEÑA
	// COMPROBAMOS QUE HA REPETIDO LA CONTRASEÑA CORRECTAMENTE
	if((isset($_POST['pass']) && $_POST['pass'] != "") && (isset($_POST['pass2']) && $_POST['pass2'] != "") && ($_POST['pass'] == $_POST['pass2'])){
		// CONTRASEÑAS CORRECTAS
		$pass_correctas = true;
		$guarda_pass = true;
	}else{
		$pass_correctas = false;
	}
}
	
if($pass_correctas){ // SI HAY QUE TENER EN CUENTA LA CONTRASEÑA Y SON CORRECTAS
	// SI ESTÁN TODOS LOS DATOS NECEARIOS
	if($nombre != "" && $cif != "" && $direccion != "" && $poblacion != "" && $cp != "" && $provincia != "" && $email != "" && $telefono != ""){
		
		if($guarda_pass){
			$set = "nombre = '" . $nombre . "', cif = '" . $cif . "', direccion = '". $direccion ."', poblacion = '". $poblacion ."', cp = '" . $cp . "', provincia = '". $provincia ."', email = '".$email."', telefono = '". $telefono ."', pass = '". $pass ."', actualizado = '" . date('Y-m-d H:i:s')."'";
		}else{
			$set = "nombre = '" . $nombre . "', cif = '" . $cif . "', direccion = '". $direccion ."', poblacion = '". $poblacion ."', cp = '" . $cp . "', provincia = '". $provincia ."', email = '".$email."', telefono = '". $telefono ."', actualizado = '" . date('Y-m-d H:i:s')."'";
		}
		$ok = $db->update('usuarios_mod',$set,'id=(SELECT id_usuarios_mod FROM usuarios WHERE id = '.$_SESSION['id_usuario'].')');
		
		if($ok){ // SI TODO SE HA GUARDADO BIEN, TANTO DATOS COMO ROLES
					
			$_SESSION['nombre_usuario'] = $nombre;
			$respuesta['estado'] = 'ok';
			$respuesta['mensaje'] = $nombre;
			
		}
		else{
			
			// SE PORODUJO UN ERROR AL GUARDAR LOS DATOS
			$respuesta['estado'] = 'ko';
			$respuesta['mensaje'] = 'Error al guardar los datos de empresa. Inténtelo de nuevo.';
			
		}
				
	}else{
		
		$respuesta['estado'] = 'ko';
		$respuesta['mensaje'] = 'Error al guardar los datos de empresa. Revise los campos obligatorios.';
		
	}
}
else{
	
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al guardar los datos de empresa. Las contraseñas no son iguales.';
	
}

echo json_encode($respuesta);

?>