<?php
// Start session to store data
session_start();

// Import connection file to connect to the database
include("../db/connect.php");

if (isset($_POST['register'])) {
    // Store error messages
    $_SESSION['error'] = [];
    
    // Get user inputs (with proper sanitization)
    $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if required fields are empty
    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($cpassword)) {
        $_SESSION['error'][] = "All fields are required";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'][] = "Invalid email format";
    }

    // Check if passwords match
    if ($password !== $cpassword) {
        $_SESSION['error'][] = "Passwords do not match";
    }

    // Password validation
    if (!preg_match("/^[A-Za-z0-9]+$/", $password)) {
        $_SESSION['error'][] = "Password must only contain letters and numbers (no special characters allowed)";
    }

    // Check if email already exists
    $check_email = "SELECT email FROM student WHERE email = '$email'";
    $email_result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($email_result) > 0) {
        $_SESSION['error'][] = "Email is already registered";
    }
    
    // File Upload Handling
    $file_path = "";
    if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx');
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_ext_array = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext_array));
        
        // Check if file extension is allowed
        if(!in_array($file_ext, $allowed_extensions)) {
            $_SESSION['error'][] = "File extension not allowed. Allowed extensions: " . implode(', ', $allowed_extensions);
        } else {
            // Generate unique filename to prevent overwriting
            $new_file_name = uniqid('file_') . '.' . $file_ext;
            $upload_dir = "../uploads/";
            
            // Create directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_path = $upload_dir . $new_file_name;
            
            // Move uploaded file
            if(!move_uploaded_file($file_tmp, $file_path)) {
                $_SESSION['error'][] = "Failed to upload file";
            }
        }
    }

    // If there are errors, redirect back to the registration page
    if (!empty($_SESSION['error'])) {
        header("Location: ../registration.php");
        exit();
    }

    // Hash password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user details into the database, including the file path
    $sql = "INSERT INTO student (fname, lname, email, password, file) VALUES ('$fname', '$lname', '$email', '$hashed_password', '$file_path')";
    $result = mysqli_query($conn, $sql);

    // Check if data is inserted successfully
    if ($result) {
        $_SESSION['message'] = "Registration successful for $fname $lname";
    } else {
        $_SESSION['error'][] = "Failed to register: " . mysqli_error($conn);
    }

    // Redirect after registration attempt
    header("Location: ../registration.php");
    exit();
}
