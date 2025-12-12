<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize inputs
    $name  = htmlspecialchars(trim($_POST["modalName"]));
    $email = filter_var(trim($_POST["modalEmail"]), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST["modalPhone"]));

    // Validate inputs
    if (empty($name) || empty($email) || empty($phone)) {
        die("❌ Please fill all required fields.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Invalid email format.");
    }

    // Email settings
    $to      = "your-email@example.com";  // Change to your email
    $subject = "New Construction Request from $name";
    $message = "You have a new construction inquiry:\n\n" .
               "Name: $name\n" .
               "Email: $email\n" .
               "Phone: $phone\n";
    $headers = "From: noreply@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
     if (mail($to, $subject, $message, $headers)) {
        echo "✅ Thank you, $name. Your request has been submitted!";
    } else {
        echo "❌ Sorry, something went wrong. Please try again later.";
    }
} else {
    echo "❌ Invalid request.";
}
?>
