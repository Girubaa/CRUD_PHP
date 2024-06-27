<?php
session_start();
include("database.php");

$id = $_SESSION['id'];

$query = mysqli_query($conn,"SELECT * FROM user_tbl WHERE id = $id");

while($result =mysqli_fetch_assoc($query)){
    $res_username = $result['username'];
    $res_email = $result['email'];
    $res_age = $result['age'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>

    <header class="header">
       <h3>Edit Page</h3>
            <nav class="nav">
                <a href="home.php">Home</a>
                <a href="logout.php"> <button>Log Out</button></a>
            </nav>
    </header>
    <div class="container">
        <div class="box form-box">
            <header>Edit Profile</header>
            <form action="" method="post">
                <div class="field input">
                    Username
                    <input type="text" name="username" id="username" value="<?php echo "$res_username" ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    Email
                    <input type="email" name="email" id="email" value="<?php echo "$res_email" ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    Age
                    <input type="number" name="age" id="age" value="<?php echo "$res_age" ?>" autocomplete="off" required>
                </div>
                
                <div class="field input">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
               
            </form>
            
        </div>
    </div>
    
</body>
</html>

<?php
    
    
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $age['age'];
    $id = $_SESSION['id'];
        try
        {
            $updatequery =  mysqli_query($conn,"UPDATE user_tbl SET username ='$username', email='$email', age= '$age' WHERE id='$id'");
            if($updatequery){
                echo"Profile Updated Successfully";
                header("Location:home.php");
            }
            else{
                $id = $_SESSION['id'];
                $query = mysqli_query($conn,"SELECT * FROM user_tbl  WHERE id = '$id'");
                while($result =mysqli_fetch_assoc($query)){
                    $res_username = $result['username'];
                    $res_email = $result['email'];
                    $res_age = $result['age'];
                }
            }
            
    
        }catch(Exception){
            echo "<div class='message'><p>An error occured</p></div>";
        }
    
    }





?>