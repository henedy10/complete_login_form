<?php 
 session_start();
 $name=$_SESSION['name'];
 include("db.php");
    if(isset($_POST['logout'])){
        $sql="DELETE FROM login3 WHERE username='$name'";
        $result=mysqli_query($conn,$sql);
        if($result)
        header("Location: index.php");
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
<body class="bg-green-300" >
    <div class="flex flex-col justify-center content-center h-screen  w-1/4 m-auto text-center">
        <form action="home.php" method="POST">
            <h1 class="py-2 text-lg"> <?php echo "HELLO . $name ";?> </h1> 
           <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Log Out" name="logout" onclick="alert('Are you sure')">
        </form>
    </div> 
</body>
</html>