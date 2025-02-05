<?php 
session_start();

include("db.php");
$passwordErr=$nameErr=$specialErr="";
$name=$password="";
if(isset($_POST['signin'])){

  // username field

  if(empty($_POST['username']))
      $nameErr="Your Username Is Required !";
  else{
      $name=$_POST['username'];
      if(!preg_match('/^[a-zA-Z\s]*$/',$name)){
          $nameErr = "Only letters and white space allowed";
      }
  }

 // password field

  if(empty($_POST['password']))
    $passwordErr ="Your Password Is Required !";
  else
    $password=$_POST["password"];
  
  if($nameErr==""&& $passwordErr==""){
    $sql= "SELECT *FROM login3 WHERE username='$name'";
    $result= mysqli_query($conn,$sql);
    $row= mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
      if($row['password']!=$password)
      $passwordErr="This Password Is Incorrect";
    else{
      $_SESSION['name']=$name;
      header("Location:home.php");
    }
    }
    else{
      $specialErr="This Account Is not exist (check username or password)";
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
    <title>Home</title>
</head>
<body class="bg-green-300">
<div class="  h-screen w-1/4  m-auto flex flex-col justify-center content-center ">
  <form class="bg-white shadow-md rounded px-8 pt-8 pb-8 mb-4 " method="POST" action="index.php">
  <div class="text-orange-600"><?php echo $specialErr ?></div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
        Username
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" placeholder="Username" value="<?php echo $name ?>">
      <div class="text-orange-600"><?php echo $nameErr ?></div>
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Password
      </label>
      <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" type="password" value="<?php echo $password ?>" placeholder="******************">
      <div class="text-orange-600"><?php echo $passwordErr ?></div>
    </div>
    
    <div class="flex items-center justify-between">
      <input type="submit" name="signin" value="Sign In" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="forgetpass.php">
        Forgot Password?
      </a>
    </div>
    <div class="text-red-500 mt-4 text-center hover:text-blue-800"><a href="signup.php">Don't Have an account? Register now</a></div>
  </form>
</div>
</body>
</html>