<?php
$localhost="localhost";
$username="root";
$password="";
$db="etsk";
$port=3306;

//match the connection by using php mysql procedure
$conn=mysqli_connect($localhost,$username,$password,$db,$port);
//test if connection done
if(!$conn){
die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

