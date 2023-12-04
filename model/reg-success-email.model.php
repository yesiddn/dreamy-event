<?php




    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require '../vendor/autoload.php';



class RegEmail   {


    public static function SignUpEmailConfirmation($email,$name){


        $phpEmail = $email; 
        $phpSubject = "Registro con exito";
    
    
    $emailBody = '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title></title>
    
        <style>
        :root {
            --primary: #7772E6;
            --secondary: #737380;
            --black: #1B1A33;
            --white: #FFFFFF;
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
    
        .btn-section {
            margin-top: 15px;
            padding: 0 20%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            text-align: center;
        }
    
        .btn-section span {
            margin-top: 5px;
            color: #FFFFFF);
        }
    
    
        .site-Button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #7772E6;
            color: #FFFFFF;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>
    </head>
    
    <body>
        <div class="welcome-container">
    
        <h1>Bienvenido</h1>
        <hr>
        <p>¡Hola <b>'.$name.'</b>! Tu participación en <b>Dreamy Event</b> nos llena de alegría.</p>
        <p>
            ¡Te damos la más cálida bienvenida! Estamos emocionados de que hayas elegido nuestro
            servicio para la planificación de tus próximos eventos. En Dreamy Event, entendemos que cada evento es
            único, y estamos aquí para hacer que tu experiencia de organización sea lo más sencilla y personalizada posible.
        </p>
        
        <section class="btn-section">
            <a class="site-Button" href="https://www.google.com">¡Haz clic aquí!</a>
            <span>Quiero regresar al sitio</span>
            </section>
    
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




   