<?php
// process_contact.php

// Include database connection
require_once 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_NUMBER_INT);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }
    
    try {
        // Prepare SQL statement
        $sql = "INSERT INTO contacts (full_name, email, mobile_number, subject, message, created_at) 
                VALUES (:fullname, :email, :mobile, :subject, :message, NOW())";
        
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        
        // Execute the query
        if ($stmt->execute()) {
            // Success message
            $response = "Message sent successfully!";
        } else {
            $response = "Failed to send message.";
        }
        
    } catch (PDOException $e) {
        $response = "Error: " . $e->getMessage();
    }
    
    // You can redirect or show response
    echo "<script>alert('$response'); window.location.href='index.html#contact';</script>";
}
?>