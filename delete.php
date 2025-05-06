<?php
session_start();

include("./db/connect.php");
$id = $_GET['id'];
//chek if id is set or not
if(isset($id)){
    //delete query
    $deleteQuery="DELETE FROM student WHERE id=$id";
    //bind with db
    $result=mysqli_query($conn,$deleteQuery);
    if($result){
        //redirect
        $_SESSION['deleleted']="student deleted successfully";
        header("Location: ./select.php");
    }
}