<?php 
session_start();
include("db.php");
$name=$newpass=$renewpass=$special="";
$newpassErr=$renewpassErr=$nameErr=$specialErr="";
if(isset($_POST['update'])){

  // username field

  if(empty($_POST['username']))
      $nameErr="Your Username Is Required !";
  else{
      $name=$_POST['username'];
      if(!preg_match('/^[a-zA-Z\s]*$/',$name)){
          $nameErr = "Only letters and white space allowed";
      }
  }

  
 // new password field

  if(empty($_POST['newpassword']))
      $newpassErr ="Your Password Is Required !";
  else
      $newpassword=$_POST["newpassword"];

 // Repassword field
  if(empty($_POST['renewpassword']))
      $renewpassErr ="This Field Is Required !";
  else{
    $renewpass=$_POST["renewpassword"];
    if($renewpass!=$newpassword){
      $renewpassErr ="You Have An Error ! check your password";
    }
  }

  if($newpassErr==""&&$renewpassErr==""&&$nameErr==""){
    $sql="SELECT * FROM login3 WHERE username='$name'";
    $result= mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
     $sql= "UPDATE login3 SET password='$newpassword' WHERE username='$name'";
     $result= mysqli_query($conn,$sql);
     if($result){
       $special="Record updated successfully";
     }
    else 
      $specialErr="Error updating record ".mysqli_error($conn);
    }
    else{
      $specialErr="This Account is not exist";
    }
  }

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>forgetpass</title>
</head>
<body class="bg-green-300">
<div class="h-screen  w-1/4 m-auto flex flex-col justify-center content-center">
  <form class="bg-white shadow-md rounded px-8 pt-8 pb-8 mb-4" method="POST" action="forgetpass.php">
  <div class=" bg-black mb-3 text-center text-green-600 text-lg rounded "><?php echo $special ?></div>
  <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
        Username
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" name="username">
      <div class="text-orange-600 mt-1"><?php echo $nameErr ?></div>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="newpassword">
        New Password
      </label>
      <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="newpassword" name="newpassword" type="password" placeholder="******************">
      <div class="text-orange-600 "><?php echo $newpassErr ?></div>
    </div>
    <div>
      <label class="block text-gray-700 text-sm font-bold mb-2" for="repassword">
       RePassword
      </label>
      <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="repassword" name="renewpassword" type="password" placeholder="******************">
      <div class="text-orange-600"><?php echo $renewpassErr ?></div>
    </div>
    <div class="mt-4">
      <input type="submit" name="update" value="Update" class=" block m-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      <div class="text-orange-600"><?php echo $specialErr ?></div>
    </div>
  </form>
</div>
</body>
</html>