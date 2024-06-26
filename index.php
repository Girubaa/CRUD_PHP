<?php
    session_start();
    include("database.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <div class="field input">
                    Username
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    Password
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
            
        </div>
    </div>
    
</body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    try{
        $result = mysqli_query($conn,"SELECT * FROM user_tbl WHERE username ='$username'");
        $row = mysqli_fetch_assoc($result);
        if(!password_verify($password,$row['password'])){
            echo"<div class='message'><p>Incorrect Password, Try again</p></div>";
        }else{
            $_SESSION['valid'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['age'] = $row['age'];
            $_SESSION['id'] = $row['id'];
        }
        if(isset($_SESSION['valid'])){
            header("Location:home.php");
        }
    }catch(Exception){
        echo"Error";
    }


}

?>
