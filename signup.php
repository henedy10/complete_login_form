<?php 
include("db.php");
$passwordErr=$nameErr=$confpassErr=$specialErr="";
$name=$password=$confpass=$special="";
if(isset($_POST['register'])){
    //username field
    if(empty($_POST['username']))
        $nameErr="Your Username Is Required !";
    else{
        $name=$_POST['username'];
        if(!preg_match('/^[a-zA-Z\s]*$/',$name)){
            $nameErr = "Only letters and white space allowed";
        }
    }

    //password field
    if(empty($_POST['password']))
        $passwordErr ="Your Password Is Required !";
    else
        $password=$_POST["password"];

   //confirm password field

   if(empty($_POST['confirmpassword']))
      $confpassErr ="This Field Is Required !";
   else{
        $confpass=$_POST["confirmpassword"];
        if($confpass!=$password){
        $confpassErr ="You Have An Error ! check your password";
        }
    }


    if($passwordErr==""&&$confpassErr==""&&$nameErr==""){
        $sql="SELECT * FROM login3 WHERE username='$name'";
        $result= mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)>0){
         if($result){
           $special="This name is used already!";
         }
        }
        else{
            $sql="INSERT INTO login3 (username, password) VALUES ('$name','$password')";
            $result= mysqli_query($conn,$sql);
            if($result){
                $special="New Recorded is Successful";
            }
            
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
    <title>Sign Up</title>
</head>
<body class="bg-green-300">
<div class="h-screen  w-1/4 m-auto flex flex-col justify-center content-center">
  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="signup.php">
  <div class="text-orange-600"><?php echo $specialErr ?></div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
        Username
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="username" id="username" type="text" placeholder="Username">
      <div class="text-orange-600"><?php echo $nameErr ?></div>
    </div>
    <div class="mb-3">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Password
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" type="password" placeholder="******************">
      <div class="text-orange-600"><?php echo $passwordErr ?></div>
    </div>
    <div>
      <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm password">
       Confirm Password
      </label>
      <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="confirmpassword" id="confirm password" name="confirm password" type="password" placeholder="******************">
      <div class="text-orange-600"><?php echo $confpassErr ?></div>
    </div>
    <div class="flex items-center justify-between">
      <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Register" name="register">
    </div>
    <div class="text-orange-600"><?php echo $special ?></div>
  </form>
</div>
</body>
</html>