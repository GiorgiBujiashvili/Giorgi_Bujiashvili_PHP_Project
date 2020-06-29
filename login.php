<?php
    session_start();

    if(isset($_POST['login'])) {
        include_once("dbconnect.php");
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);

        $username = stripslashes($username);
        $password = stripslashes($password);

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

    
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $query = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($query);
        $id = $row['id'];
        $db_password = $row['password'];
        $admin = $row['admin'];

        if($password == $db_password) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            if($admin == 1) {
                $_SESSION['admin'] = 1;
            }
            header("Location: index.php");
        } else {
            echo "Username or Password is incorrect.";
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>login</h1>
    <form action="login.php" method="post">
        <input placeholder="Username" name="username" type="text" autofocus>
        <input placeholder="Password" name="password" type="text">
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>