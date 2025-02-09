<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    $to = "tolga@moveuponline.co";
    $subject = "Yeni İletişim Formu Mesajı: $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $email_body = "Ad: $name\n";
    $email_body .= "E-posta: $email\n";
    $email_body .= "Mesaj:\n$message\n";

    // E-posta gönderme işlemi
    if (mail($to, $subject, $email_body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Mesajınız başarıyla gönderildi."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Mesaj gönderilirken bir hata oluştu."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Geçersiz istek!"]);
}
?>