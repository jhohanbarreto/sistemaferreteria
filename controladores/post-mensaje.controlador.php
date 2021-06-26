<?php

require("vistas/class.phpmailer.php");
require("vistas/class.smtp.php");
class ControladorMensaje{
static public function ctrCrearMensaje(){

if (isset($_POST["email"])) {
    $destino = $_POST['email'];
    $producto = $_POST['producto3'];
    $email = $_POST['email'];
    $asunto = $_POST['precioReal2'];
    $asunto2 = $_POST['descuentoPorcentual'];
    $asunto3 = $_POST['precioRebajado2'];
    $asunto4 = $_POST['fechaInicio2'];
    $asunto5 = $_POST['fechaFinal2'];
    $mensaje = $_POST['mensaje'];
    $imagen = $_POST['imagen'];

    // Datos de la cuenta de correo utilizada para enviar v�a SMTP
    $smtpHost = "mail.ferrecolonio.site";  // Dominio alternativo brindado en el email de alta 
    $smtpUsuario = "ferrecolonio@ferrecolonio.site";  // Mi cuenta de correo
    $smtpClave = "wGaw4oZE0jt5";  // Mi contrase�a

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Port = 587; 
    $mail->IsHTML(true); 
    $mail->CharSet = "utf-8";

    // VALORES A MODIFICAR //
    $mail->Host = $smtpHost; 
    $mail->Username = $smtpUsuario; 
    $mail->Password = $smtpClave;

    $mail->From = $email; // Email desde donde envio el correo.
    $mail->FromName = $nombre;
    $mail->AddAddress($destino); // Esta es la direccion a donde enviamos los datos del formulario

    $mail->Subject = "FERRETERIA CA INGENIEROS-ARQUITECTOS S.A.C"; // Este es el titulo del email.
    $mensajeHtml = nl2br($mensaje);
    $mail->Body = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <table style="border: 1px solid black;width: 100%;">
            <tr>
                
                <td colspan="2" style="font-size: 20px; text-align: center;background: #2ECC71 ;color:#F8C471">PROMOCIÓN POR CAMPAÑA '.$destino.'   
                </td>
                <td><img src="http://ferrecolonio.site/vistas/img/plantilla/logo-blanco-lineal.png" align="right" width="300" height="100">
                </td>
                
            </tr>
            <tr>
                <td style="text-align: left; background: #FCF3CF" align="justify" colspan="3"><span style="font-size: 35px;"> Producto en oferta: '.$producto.'</sp></td>
                
            </tr>
            <tr>
                <td rowspan="4"><img src="http://ferrecolonio.site/'.$imagen.'"></td>
                <td colspan="2" style="text-align: left;" align="justify"><span style="font-size: 25px;"> Precio Real: S/ '.$asunto.'</sp></td>
                
            </tr>
            <tr>
                <td colspan="2" style="text-align: left;" align="justify"><span style="font-size: 25px;"> Descuento: '.$asunto2.'%</sp></td>
                
                
            </tr>
            <tr>
               <td colspan="2" style="text-align: left;" align="justify"><span style="font-size: 25px;"> Precio Rebajado: S/ '.$asunto3.'</sp></td>
                
                
            </tr>
            <tr>
                <td style="text-align: left;" align="justify"><span style="font-size: 25px;" colspan="1"> Fecha inicio: '.$asunto4.'</sp></td>
                <td style="text-align: right;" align="justify"><span style="font-size: 25px;" colspan="1"> Fecha Final: '.$asunto5.'</sp></td>
                
            </tr>

            <tr>
            <td colspan="3" style="text-align: center;background: #AF601A ;color:#145A32">
                <h1><b>Condiciones '.$mensaje.'</b></h1>
            </td>
            
                
            </tr>

            
        </table>

    </body>
    </html>'; // Texto del email en formato HTML
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
        echo'<script>

				swal({
					  type: "success",
					  title: "La promoción se a enviado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "post-venta";

								}
							})

				</script>';
        exit();
    } else {
        echo'<script>

				swal({
					  type: "success",
					  title: "No se pudo enviar el mensaje",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "post-venta";

								}
							})

				</script>';
    }

} 
}
}
?>