<?php
// Файлы phpmailer
require '../plugins/phpmailer/PHPMailer.php';
require '../plugins/phpmailer/SMTP.php';
require '../plugins/phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$tel = $_POST['tel'];
if ($tel == '') {
    echo 2;
    die;
}
// Формирование самого письма
$title = "Обратная связь";
$body = "
<b>Телефон:</b> $tel<br>
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function ($str, $level) {
        $GLOBALS['status'][] = $str;
    };

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username   = '[*****@mail.ru]'; // Логин на почте
    $mail->Password   = '{*****************}'; // Специалный пароль на почте примерно так: sdfd5dfd5f4dcdc
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('********@mail.ru', 'Имя отправителя'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('*******@mail.ru');
    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;

    // Проверяем отравленность сообщения
    if ($mail->send()) {
        $result = "success";
    } else {
        $result = "error";
    }
} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
echo json_encode(["result" => $result]);
