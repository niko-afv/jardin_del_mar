<?php
//ini_set ('display_errors', true); 

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$fono = $_POST['fono'];
$comentario = $_POST['comentario'];
$formulario = $_POST['formulario'];

$htmlC = "
 <h3>".$formulario." - Jardin Del Mar</h3>
 <br    /><strong>Nombre:</strong> " . $nombre . " " . $apellido .
"<br    /><strong>E-mail:</strong> " . $email .
"<br    /><strong>Telefono:</strong> " . $fono .
"<br    /><strong>Comentario:</strong>  " . $comentario .
"";

date_default_timezone_set('America/Santiago'); //Se define la zona horaria
require_once('class/class.phpmailer.php'); //Incluimos la clase phpmailer
 
$mail = new PHPMailer(true);
$mail->IsSMTP();
$resC = TRUE;
$resF = TRUE;


try {
//------------------------------------------------------
    $correo_emisor="niko.afv@gmail.com";
    $nombre_emisor="Nicolas Fredes";
    $contrasena="ak47-system";
    $correo_destino="niko.afv@gmail.com";

//--------------------------------------------------------
    //$mail->SMTPDebug  = 2;                     // Habilita información SMTP (opcional para pruebas)
                                                 // 1 = errores y mensajes
                                                 // 2 = solo mensajes
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 465;
    $mail->Username   = $correo_emisor;
    $mail->Password   = $contrasena;
    $mail->AddAddress($correo_destino, $nombre_destino);
    $mail->SetFrom($correo_emisor, $nombre_emisor);
    $mail->Subject = $formulario." - Jardin Del Mar";
    $mail->MsgHTML($htmlC);
  
    $resC =  $mail->Send();
    
    if($formulario == 'folleto'){
        
        $correo_destino = $email;
        $nombre_destino = $nombre." ".$apellido;
        $htmlF = "
            <h2>Estimado(a) ".$nombre. " ".$apellido."</h2>
            
            <p>
                Le hacemos llegar el folleto de nuestro proyecto Jardin Del Mar <br />
                Según su solicitud.
            </p>
        
        ";
        
        $mail->MsgHTML($htmlF);
        //Archivos adjuntos
        $mail->AddAddress($correo_destino, $nombre_destino);
        $mail->AddAttachment('img/forms/folleto.jpg');
        $resF = $mail->Send();
    }
    
    if($resC == True && $resF == True){
        echo TRUE;
    }else{
        echo FALSE;
    }
    
} catch (phpmailerException $e) {
    echo $e->errorMessage(); //Errores de PhpMailer
}
?>