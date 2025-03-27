<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["first_name"];
    $email = $_POST["email"];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $ilets = $_POST['ilets'];
    $subject = "Enquiry Regarding the Visa";
    $address = $_POST["address"];
    $enquiry = $_POST["enquiry"];
    $visarefusal = $_POST["visarefusal"];

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@novostarimmigration.com';
        $mail->Password = 'your-email-password'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Headers
        $mail->setFrom($email, $name);
        $mail->addAddress('info@novostarimmigration.com');
        $mail->addReplyTo($email, $name);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "Website Enquiry Mail: $subject";
        $mail->Body    = "<p><strong>Name:</strong> $name</p>
                          <p><strong>Email:</strong> $email</p>
                          <p><strong>Country:</strong> $country</p>
                          <p><strong>Phone:</strong><br>$phone</p>
                        <p><strong>ILETS:</strong><br>$ilets</p>
                        <p><strong>Visa Refusal:</strong><br>$visarefusal</p>
                          <p><strong>Enquiry:</strong><br>$enquiry</p>";

        $mail->send();
        header("Location: contact.html?status=success");
        exit();
    } catch (Exception $e) {
        header("Location: contact.html?status=error");
        exit();
    }
} else {
    header("Location: contact.html?status=invalid");
    exit();
}
?>
