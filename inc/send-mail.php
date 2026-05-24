<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/mail/PHPMailer.php';
require __DIR__ . '/mail/SMTP.php';
require __DIR__ . '/mail/Exception.php';

function sendResetCode($toEmail, $code)
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com';
        $mail->SMTPAuth = true;

        $mail->Username = '';
        $mail->Password = '';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('segunjayrich@gmail.com', 'Lucas Hospital');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Lucas Hospital Password Reset Code';

        $mail->Body = "
            <div style='font-family:Arial;padding:20px'>
                <h2>Password Reset Request</h2>
                <p>Your verification code is:</p>
                <h1 style='color:#06b6d4;font-size:40px'>$code</h1>
                <p>This code will expire in 10 minutes.</p>
            </div>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {

        echo "Mailer Error: " . $mail->ErrorInfo;
        exit();

    }
}
function sendEmergencyDispatchMail($toEmail, $fullname)
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com';
        $mail->SMTPAuth = true;

        $mail->Username = '';
        $mail->Password = '';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom(
            'segunjayrich@gmail.com',
            'Lucas Hospital'
        );

        $mail->addAddress($toEmail);

        $mail->isHTML(true);

        $mail->Subject =
        'Emergency Request Dispatched';

        $mail->Body = "

            <div style='font-family:Arial;padding:20px'>

                <h2>Emergency Request Update</h2>

                <p>Hello $fullname,</p>

                <p>
                    Your emergency request has been dispatched.
                </p>

                <p>
                    Lucas Hospital emergency team is attending to your request.
                </p>

            </div>

        ";

        $mail->send();

        return true;

    } catch (Exception $e) {

        return false;

    }
}
?>
