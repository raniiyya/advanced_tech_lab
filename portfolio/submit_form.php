<?php
// submit_form.php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate form inputs
    if (empty($name) || empty($email) || empty($message)) {
        die('All fields are required. Please go back and fill in the form.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format. Please go back and correct it.');
    }

    // Prepare email content
    $to = 'davurova.raniya@gmail.com'; // Replace with your email address
    $subject = "New Message from Portfolio Contact Form";
    $email_body = "Name: $name\n" .
                  "Email: $email\n" .
                  "Message: \n$message";

    $headers = "From: $email\r\n";

    // Send the email
    if (mail($to, $subject, $email_body, $headers)) {
        echo "<h1>Thank you, $name! Your message has been sent successfully.</h1>";
    } else {
        echo "<h1>Sorry, there was an error sending your message. Please try again later.</h1>";
    }
} else {
    // Redirect back to the form if accessed directly
    header('Location: index.html');
    exit();
}
?>
