<?php
    if(isset($_SESSION['id'])) {
        header("Location: index.php");
    }
    if(isset($_POST['register'])) {
        include_once("dbconnect.php");

        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        $password_confirm = strip_tags($_POST['password_confirm']);
        $email = strip_tags($_POST['email']);

        $username = stripslashes($username);
        $password = stripslashes($password);
        $password_confirm = stripslashes($password_confirm);
        $email = stripslashes($email);

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $password_confirm = mysqli_real_escape_string($connection, $password_confirm);
        $email = mysqli_real_escape_string($connection, $email);

        $sql_store = "INSERT into users (username, password, email) VALUES ('$username', '$password', '$email')";
        $sql_fetch_username = "SELECT username FROM users WHERE username = '$username'";
        $sql_fetch_email = "SELECT email FROM users WHERE email = '$email'";

        $query_username = mysqli_query($connection, $sql_fetch_username);
        $query_email = mysqli_query($connection, $sql_fetch_email);

        if(mysqli_num_rows($query_username)) {
            echo "that username is already in use.";
            return;
        }
        if($username == "") {
            echo "your username cannot be empty";
            return;
        }
        if($password == "" || $password_confirm == "") {
            echo "make sure you enter and confirm your password.";
            return;
        }
        if($password != $password_confirm) {
            echo "the passwords don't match.";
            return;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email = "" ) {
            echo "this email is not valid";
            return;
        }
        if(mysqli_num_rows($query_email)) {
            echo "that Email is already in use.";
            return;
        }
        mysqli_query($connection, $sql_store);

        header("Location: index.php");

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
    <form action="register.php" method="post" enctype="multipart/form-data">
        <input placeholder="Username" name="username" type="text" autofocus>
        <input placeholder="Password" name="password" type="password">
        <input placeholder="Confirm Password" name="password_confirm" type="password">
        <input placeholder="E-Mail Address" name="email" type="text">
        <input name="register" type="submit" value="Register">
    </form>
</body>
</html>