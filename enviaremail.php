<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



require 'vendor/autoload.php';

use Dotenv\Dotenv;  // Esto es para abrir el archivo .env con la información delicada


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $remitente = $_POST['remitente'];
    $asunto = $_POST['asunto'];
    $texto= $_POST['texto'];

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
   
    
    
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_ENV['SMTP_HOST'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_ENV['SMTP_USER'];                     //SMTP username
        $mail->Password   = $_ENV['SMTP_PASS'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $_ENV['SMTP_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($_ENV['SMTP_USER']);
        $mail->addAddress( $remitente);     //Add a recipient
        $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        // Añadir copia y añadir copia oculta
       //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject =  $asunto ;
        $mail->Body    =  $texto;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        header('Location:index.php');
        echo 'mensaje enviado';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>