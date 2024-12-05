<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Hàm render view
function view($path_view, $data = [])
{
    extract($data);

    $path_view = str_replace(".", "/", $path_view);

    include_once ROOT_DIR . "views/$path_view.php";
}

//hàm dd dùng để debug lỗi
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

// chuyển đổi trạng thái đơn hàng
function getOrderStatus($status)
{
    $status_detail = [
        1 => 'Chờ xử lý',
        2 => 'Đang xử lý',
        3 => 'Đã hoàn thành',
        4 => 'Đã huỷ'
    ];

    return $status_detail[$status];
}

function sendMail($to, $subject, $content)
{


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'nemmoda1@gmail.com';                     //SMTP username
        $mail->Password   = 'bajhlcayiteqxzns';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom('nemmoda1@gmail.com', 'Nệm Mơ');
        $mail->addAddress($to);     //Add a recipient

        //Content
        $mail->isHTML(true);
        //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->send();
    } catch (Exception $e) {
    }
}
