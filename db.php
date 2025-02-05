<?php 
$conn=mysqli_connect("Localhost","ahmed","","login");
if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>