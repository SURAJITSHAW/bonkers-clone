<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the form fields are set and not empty
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        // Create and send the email
        $to = "surajit.runtime@gmail.com"; // Replace with your email address
        $subject = "Contact Form Submission from $name";
        $headers = "From: $email";
        $messageBody = "Name: $name\nEmail: $email\nMessage:\n$message";

        if (mail($to, $subject, $messageBody, $headers)) {
            // Email sent successfully
            header("Location: contact.php?status=success");
            exit;
        } else {
            // Email sending failed
            header("Location: contact.php?status=error");
            exit;
        }
    } else {
        // Invalid or incomplete form data
        header("Location: contact.php?status=invalid");
        exit;
    }
} else {
    // If the form wasn't submitted, redirect to the contact page
    header("Location: contacts.php");
    exit;
}
