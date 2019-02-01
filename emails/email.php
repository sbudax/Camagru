<?php
function verify_email($toAddr, $toUsername, $token, $ip)
{
    $subject = "CAMAGRU Email verification";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: <no_reply>' . "\r\n";

    $message = '
    <html>
        <head>
            <title>' . $subject . '</title>
        </head>
        <body>
            Hi ' . htmlspecialchars($toUsername) . ' </br>
            To verify your email please click the link below </br>
            <a href="http://' . $ip . '../emails/verify.php?token=' . $token . '">Verify email</a>      
        </body>
    </html>
    ';
    mail($toAddr, $subject, $message, $headers);
}
?>