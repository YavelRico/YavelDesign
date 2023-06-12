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

if ($_POST) {

    $fname = trim(stripslashes($_POST['fname']));
    $lname = trim(stripslashes($_POST['fname']));
    $email = trim(stripslashes($_POST['email']));
    $subject = trim(stripslashes($_POST['subject']));
    $contact_message = trim(stripslashes($_POST['message']));

    $name = $fname . ' ' . $lname;

    if ($subject == '') {
        $subject = "Nuevo mensaje de YavelArt Web";
    }

    // Set Message
    $message .= "Mensaje de: " . $name . "<br />";
    $message .= "Email: " . $email . "<br />";
    $message .= "Mensaje: <br />";
    $message .= nl2br($contact_message);
    $message .= "<br /> ----- <br /> Este mail fue enviado desde el sitio de Contacto de YavelDesign " . url();

    // Set From: header
    $from = $name . " <" . $email . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    ini_set("sendmail_from", $to); // for windows server
    $mail = mail($to, $subject, $message, $headers);

    if ($mail) {
        echo "OK";
    } else {
        echo "Something went wrong. Please try again.";
    }

}

?>