<?php
  // Set the recipient email address.
  // Update this to your desired email address.
  $to = 'ronan.tanios@gmail.com';

  // Get the form fields and sanitize them.
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
  $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

  // Check that data was sent to the mailer.
  if ($name && $email && $subject && $message) {
    // Set the email headers.
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email.
    $success = mail($to, $subject, $message, $headers);

    // Redirect to a thank-you page (optional) or return a success message.
    if ($success) {
      echo "Your message has been sent successfully.";
    } else {
      echo "There was a problem sending your message. Please try again.";
    }
  } else {
    echo "Please complete all the fields in the form.";
  }
?>
