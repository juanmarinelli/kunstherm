<?php
header("Access-Control-Allow-Origin: http://kunstherm.com/");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
$inputJSON = file_get_contents('php://input');
$requests= json_decode( $inputJSON );


  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';


$request=$requests->form;

if (isset($request->name)) {

$nombre = $request->name;
$empresa = $request->name_empresa;
$email = $request->email;
$msj= $request->comment;

// $subject= $request->subject;





    $destinatario = "info@kunstherm.com";
    //  $destinatario = "info@inhaus.com.ar";
    // $asunto = "Formulario de Contacto";
    // $cuerpo = $_POST['mensaje'];



    			$mail= new PHPMailer();                   // Passing `true` enables exceptions
                  try {

                      $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                      )
                      );
                                               // Enable verbose debug output
                      $mail->isSMTP();                                      // Set mailer to use SMTP
                      $mail->Host = 'c1421844.ferozo.com';  // Specify main and backup SMTP servers
                      $mail->SMTPAuth = true;                               // Enable SMTP authentication
                      $mail->Username = 'info@kunstherm.com';                 // SMTP username
                      $mail->Password = 'Kunschi2022';                           // SMTP password
                      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                      $mail->Port = 465;                                    // TCP port to connect to

                      //Recipients
                      $mail->setFrom('info@kunstherm.com', $nombre);
                      $mail->addAddress($destinatario);     // Add a recipient
                      $mail->AddReplyTo ($email);

                      //Attachments
                      // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                      //Content
                      $mail->isHTML(true);                                  // Set email format to HTML
                      $mail->Subject = 'Te enviaron un mensaje de contacto';
                      $mail->Body    = '<div style="margin-top:15px; margin-bottom:15px; text-align:center"> <img src="" width="150" src="http://kunstherm.com/_nuxt/img/logo.c7c8ddd.png"></div>
                            <div style="padding:15px; color:rgba(0,0,0,1.00); font-family:Tahoma, Arial, Helvetica, sans-serif">
                            <p><strong> Tenes un nuevo mensaje de contacto</strong></p>
                            <p><strong>NOMRE Y APELLIDO:</strong> ' .$nombre. '</p>
                            <p><strong>EMPRESA:</strong> ' .$empresa. '</p>
                            <p><strong>E-MAIL:</strong> ' .$email. '</p>
                            <p><strong>CONSULTA:</strong> ' .$msj. '</p>
                            </div>';
                      // $mail->AltBody = "";

                      $mail->send();
                      echo "ok";
                  } catch (Exception $e) {
                     echo $e;
                  }


}




?>
