<?php

include("database.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <div class="field input">
                    Username
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    Email
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    Age
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    Password
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already have an account? <a href="index.php">Log In</a>
                </div>
            </form>
            
        </div>
    </div>
    
</body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
    $age = filter_input(INPUT_POST,"age",FILTER_VALIDATE_INT);
    $password = $_POST["password"];
    $password_hash = password_hash($password,PASSWORD_DEFAULT);

    if(!empty($username) && !empty($email) && !empty($age) && !empty($password_hash))
    {
        $verify_email = mysqli_query($conn,"SELECT email FROM user_tbl WHERE email='$email'");
        $verify_username = mysqli_query($conn,"SELECT username FROM user_tbl WHERE username='$username'");

        if(mysqli_num_rows($verify_email) !=0){
            echo"<div class='message'><p>This email is already in use,Try with a new one</p></div>";

        }else if(mysqli_num_rows($verify_username) !=0){
            echo"<div class='message'><p>This username is already in use,Try with a new one</p></div>";

        }else{
            try
            {
                $insertquery = "INSERT INTO user_tbl(username,email,age,password) VALUES('$username','$email','$age','$password_hash')";
                mysqli_query($conn,$insertquery);
                mysqli_close($conn);
        
                echo"Registration Successfull";
                header("Location:index.php");
        
            }catch(Exception){
                echo "<div class='message'><p>An error occured</p></div>";
            }
        
        }
       
    }
    else
    {
        echo"<div class='message'><p>Enter all the details to continue</p></div>";

    }

    
    
}





?>