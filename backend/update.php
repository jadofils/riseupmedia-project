<?php
// Start session to store data
session_start();

// Import connection file to connect to the database
include("../db/connect.php");

if (isset($_POST['update'])) {

    // Store error messages
    $_SESSION['error'] = [];
    
    // Get user inputs (without escaping for teaching purposes)
    $id=$_POST['id'];
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
var_dump($_POST);

if(empty($fname) || empty($lname)|| empty($email) || $password==""){
           $_SESSION['error'][] = "All fields are required";

    }
    //password len
    if(strlen($password)<6){
        $_SESSION['error'][] = "Password must be at least 6 characters long";
    }
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'][] = "Invalid email format";
    }
    //pregmatch pattern
    $pattern = "/^[A-Za-z0-9]+$/";
    if(!preg_match($pattern,$password)){
        $_SESSION['error'][] = "Password must only contain letters and numbers (no special characters allowed)";
    }
    //update the student
    $updateQuery = "UPDATE student SET fname='$fname', lname='$lname', email='$email', password='$password' WHERE id=$id";
    //bind with db
    $result=mysqli_query($conn,$updateQuery);
    if($result){
        //redirect
        $_SESSION['message'] = "Student updated successfully";
        header("Location: ../select.php");
        exit();        
    }

}