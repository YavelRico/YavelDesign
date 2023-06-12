<?php
$to = 'yavelwork@gmail.com';

function url()
{
    return sprintf(
        "%s://%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME']
    );
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = trim(stripslashes($_POST['fname']));
    $lname = trim(stripslashes($_POST['lname']));
    $email = trim(stripslashes($_POST['email']));
    $message = trim(stripslashes($_POST['message']));

    $name = $fname . ' ' . $lname;

    if (empty($_POST['subject'])) {
        $subject = "Nuevo mensaje de YavelArt Web";
    } else {
        $subject = trim(stripslashes($_POST['subject']));
    }

    $messageBody = "Mensaje de: " . $name . "<br />";
    $messageBody .= "Email: " . $email . "<br />";
    $messageBody .= "Mensaje: <br />";
    $messageBody .= nl2br($message);
    $messageBody .= "<br /> ----- <br /> Este correo fue enviado desde el formulario de contacto de YavelDesign " . url();

    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $mail = mail($to, $subject, $messageBody, $headers);

    if ($mail) {
        echo "OK";
    } else {
        echo "Hubo un error. Por favor, intenta nuevamente.";
    }
}
?>