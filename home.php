<?php
    
    session_start();
    include("database.php");
    if(!isset($_SESSION['valid'])){
        header("Location:index.php");
    }

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
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    
</head>
<body>
    <header>
        <h3>HomePage</h3>
            <nav class="nav">
                <a href="edit.php">Edit Profile</a>
                <a href="logout.php"> <button class="btn">Log Out</button></a>
            </nav>
    </header>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_username ?></b>, Welcome</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

