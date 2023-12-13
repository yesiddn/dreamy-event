<?php




    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require '../vendor/autoload.php';



class ResetCodeEmail   {


    public static function emailResetConfirmation($email,$code){


        $phpEmail = $email; 
        $phpSubject = "Recuperación de tu Cuenta";
    
    
    $emailBody = '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link rel="stylesheet" href="../assets/css/normalize.css">
        <link rel="stylesheet" href="../assets/css/main.css">
        <title></title>
    
        <style>
            :root {
                --primary: #7772E6;
                --secondary: #737380;
                --black: #1B1A33;
                --white: #FFFFFF;
            }
    
            b,
            h2,
            h3,
            h4 {
                color: #7772E6;
            }
    
            .welcome-container {
    
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                box-sizing: border-box;
            }
    
            .welcome-container p {
                margin: 5px 0px 15px 0px;
            }
    
            .items__details {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                width: auto;
            }

            .recovery-code {
                font-size: 20px;
            }

        </style>
    </head>
    
    <body>
    
        <div class="welcome-container">
            <h2>Recuperación de Contraseña</h2>
            <br>
            <p>Hola <b>'./* aqui agregare una variable que traiga el nombre del user - en construccion*/'</b>,</p>
    
            <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Para continuar con el proceso de
                recuperación, utiliza el siguiente código de recuperación:</p>
    
            <p class="recovery-code"><b>'.$code.'</b></p>
    
            <p>Si no solicitaste este restablecimiento de contraseña, puedes ignorar este correo electrónico.</p>
    
            <p>Este código de recuperación es válido por un tiempo limitado. No compartas este código con nadie para
                mantener la seguridad de tu cuenta.</p>
    
            <p>Si necesitas ayuda o tienes alguna pregunta, no dudes en ponerte en contacto con nuestro equipo de soporte.
            </p>
    
            <p>Gracias por utilizar nuestros servicios.</p>
    
            <p>Atentamente,<br>
                el equipo <b>Dreamy Event</b> </p>
    
        </div>
    </body>
    
    </html>';
    
    
    

    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'phpshox@gmail.com';                     //SMTP username
        $mail->Password   = 'eonwdirbmuxvkrsh';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('phpshox@gmail.com', 'Dreamy Event - team');
        $mail->addAddress($phpEmail,);     //Add a recipient               //Name is optional
    
        //Content
        $mail->isHTML(true);  
        $mail->CharSet = 'UTF-8';                                //Set email format to HTML
        $mail->Subject = $phpSubject;
        $mail->Body    = $emailBody;
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }



    }


}




   