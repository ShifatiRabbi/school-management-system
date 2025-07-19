<?php 
session_start();
include "../DB_connection.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];
    
    // Validate inputs
    if (empty($full_name)) {
        $em = "Full name is required";
        header("Location: ../contact.php?error=$em");
        exit;
    } else if (empty($email)) {
        $em = "Email is required";
        header("Location: ../contact.php?error=$em");
        exit;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $em = "Invalid email format";
        header("Location: ../contact.php?error=$em");
        exit;
    } else if (empty($mobile)) {
        $em = "Mobile number is required";
        header("Location: ../contact.php?error=$em");
        exit;
    } else if (empty($message)) {
        $em = "Message is required";
        header("Location: ../contact.php?error=$em");
        exit;
    } else {
        // Insert into database
        $sql = "INSERT INTO message (sender_full_name, sender_email, sender_mobile, message, date_time) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $date_time = date("Y-m-d H:i:s");
        $stmt->execute([$full_name, $email, $mobile, $message, $date_time]);
        
        $sm = "Your message has been sent successfully!";
        header("Location: ../contact.php?success=$sm");
        exit;
    }
} else {
    header("Location: ../contact.php");
    exit;
}