<div id="login">
	<div class="logo">
		<img src="www/img/logo_arjomy.png" /> <img src="www/img/logo_leroy.png"><br />CONFIGURADOR DE ARMARIOS
	</div>
	<form id="form_login" name="form_login" enctype="multipart/form-data" method="POST" onSubmit="return envio();" action="index.php">
		<div class="input"><input type="text" id="usuario" name="usuario" value="" autocomplete="off" placeholder="Usuario" /></div>
		<div class="input"><input type="password" id="pass" name="pass" value="" placeholder="Contraseña" /></div>
		<button class="boton gris grande boton_login" type='submit' name='submit'><i class="fa fa-sign-in"></i> Entrar</button>
	</form>
	<?php
	if($error){  // EL ERROR LO COMPRUEBA EN index.php
	?>
	<div class="error_form error_login centrado">Usuario o contraseña incorrecto</div>
	<?php
	}else{
	?>
	<div class="error_form error_login centrado">&nbsp;</div>
	<?php } ?>
	<div class="link_alta">
		<?php /*<a href="index.php?seccion=recuperar_cont">¿Has perdido tu contraseña?</a>
		<br />*/?>
		-
		<br />
		<a href="index.php?seccion=solicitar_acceso">Solicitar acceso</a>
	</div>
</div>
<script type="text/javascript">
	<?php $num_imagen=rand(2,5); ?>
	$('body').css('background-image','url(www/img/inicio/inicio-arjomy-<?php echo $num_imagen; ?>.jpg)');
</script>
<script type="text/javascript">
	// SE VALIDA EL FORMULARIO
	$(document).ready(function(){
		$("#form_login").validate({
			invalidHandler: function(form, validator){
				$(validator.invalidElements()[0]).focus();
			},
			rules: {
				usuario: { required: true },
				pass: { required: true }
			},
			messages: {
				usuario: "<span class='error_form'>Introduce el usuario</span>",
				pass: "<span class='error_form'>Introduce la contraseña</span>"
			}
		});
		
		$("#usuario").focus();
	});
	  
	function envio()
	{
		$(".respuesta").show();
		$(".respuesta").html("<i class='fa fa-spinner fa-spin'></i> Comprobando");
		
		if($("#form_login").validate().form())
		{
			$("#form_login").submit();
		}
		else
		{
			$(".respuesta").html("");
			$(".respuesta").hide();
			return false;
		}
	}
</script>