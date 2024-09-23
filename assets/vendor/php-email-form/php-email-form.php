<?php
class PHP_Email_Form {
  
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $smtp = array();
  public $ajax = false;
  private $messages = array();
  private $headers = '';

  public function add_message($message, $label, $priority = 0) {
    $this->messages[$priority][] = array('label' => $label, 'message' => $message);
  }

  public function send() {
    $message_body = $this->compose_message();
    
    $this->headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
    $this->headers .= "Reply-To: " . $this->from_email . "\r\n";
    $this->headers .= "MIME-Version: 1.0\r\n";
    $this->headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // If SMTP is configured
    if (!empty($this->smtp)) {
      return $this->send_with_smtp($message_body);
    }

    // Use PHP's built-in mail() function
    return mail($this->to, $this->subject, $message_body, $this->headers);
  }

  private function compose_message() {
    $message = "<html><body>";
    ksort($this->messages); // Sort by priority
    foreach ($this->messages as $priority => $fields) {
      foreach ($fields as $field) {
        $message .= "<strong>" . htmlspecialchars($field['label']) . ":</strong> " . htmlspecialchars($field['message']) . "<br>";
      }
    }
    $message .= "</body></html>";
    return $message;
  }

  private function send_with_smtp($message_body) {
    // Set up SMTP connection and send mail here
    // This is just a placeholder. You'll need to use something like PHPMailer for actual SMTP handling.

    // Example of PHPMailer use:
    // $mail = new PHPMailer(true);
    // try {
    //     $mail->isSMTP();
    //     $mail->Host = $this->smtp['host'];
    //     $mail->SMTPAuth = true;
    //     $mail->Username = $this->smtp['username'];
    //     $mail->Password = $this->smtp['password'];
    //     $mail->SMTPSecure = 'tls';
    //     $mail->Port = $this->smtp['port'];
    //
    //     $mail->setFrom($this->from_email, $this->from_name);
    //     $mail->addAddress($this->to);
    //     $mail->Subject = $this->subject;
    //     $mail->Body = $message_body;
    //
    //     $mail->send();
    //     return true;
    // } catch (Exception $e) {
    //     return false;
    // }
    return false; // Remove this once SMTP is implemented
  }
}
?>
