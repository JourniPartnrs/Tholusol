<?php
// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Collect form data and sanitize it for security
    // Use trim to remove whitespace and htmlspecialchars to prevent XSS
    $name = htmlspecialchars(trim($_POST['name']));
    $company = htmlspecialchars(trim($_POST['company']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $employees = htmlspecialchars(trim($_POST['employees']));
    $service = htmlspecialchars(trim($_POST['service']));
    $message = htmlspecialchars(trim($_POST['message']));

    // 2. Set up the recipient email address and email details
    // *** UPDATED RECIPIENT EMAIL ADDRESS ***
    $to = "info@tholusol.co.za";
    $subject = "New Contact Form Submission From " . $name . " (Tholusol)"; 

    // Create the email body
    $body = "You have received a new message from the Tholusol website contact form.\n\n";
    $body .= "Full Name: " . $name . "\n";
    $body .= "Company: " . $company . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Phone: " . $phone . "\n";
    $body .= "Number of Employees: " . $employees . "\n";
    $body .= "Services of interest: " . $service . "\n\n";
    $body .= "How can we help: \n" . $message . "\n";

    // Create the email headers - FIXED CONCATENATION
    // The .= operator appends to the variable, ensuring all lines are included.
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    // 3. Send the email and provide feedback to the user
    if (mail($to, $subject, $body, $headers)) {
        // Email sent successfully - Redirect the user to the "thank you" page
        header("Location: thank_you.html");
        exit;
    } else {
        // Email failed to send
        echo "Oops! Something went wrong, and we couldn't send your message. Please try again later or contact us directly at $to.";
    }

} else {
    // If someone tries to access the PHP file directly, redirect them away
    header("Location: index.html");
    exit;
}
?>
