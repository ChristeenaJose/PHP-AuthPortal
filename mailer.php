<?php

// Include the PHPMailer autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure to include the Composer autoload file

class Mailer {
    private $mail;

    public function __construct() {
        // Initialize PHPMailer object
        $this->mail = new PHPMailer(true);
        
        // SMTP configuration for Gmail
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'xxxxxxxxxxx'; // Your Gmail username
        $this->mail->Password = 'xxxxxxxx'; // Your Gmail password (use App Password if 2FA enabled)
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }

    public function sendMail($to, $subject, $body) {
        try {
            // Sender's email address
            $this->mail->setFrom('xxxxxxxxxxx', 'Your Name');
            
            // Add recipient's email address
            $this->mail->addAddress($to);

            // Set email format to HTML
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            // Send the email
            if ($this->mail->send()) {
                return true;
            }
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            return FALSE;
        }
    }
}
?>
