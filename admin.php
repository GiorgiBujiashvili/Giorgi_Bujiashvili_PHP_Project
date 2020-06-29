<?php
    session_start();
    include_once("dbconnect.php");

    if(!isset($_SESSION['admin']) && $_SESSION['admin'] !=1) {
        header("Location: login.php");
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
</head>
<body>
    <?php
        $sql = "SELECT * FROM posts ORDER BY id DESC";

        $results = mysqli_query($connection, $sql) or die("Connection Error1");

        $posts = "";

        if(mysqli_num_rows($results) > 0) {
            while($row = mysqli_fetch_assoc($results)){
                $id = $row['id'];
                $title = $row['title'];
                $date = $row['date'];

                $admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a></div>";

                $posts .= "<div><h2><a href='view_post.php?pid=$id' target='_blank'>$title</a></h2><h3>$date</h3>$admin<hr /></div>";
            }
            echo $posts;
        } else {
            echo "no posts to display";
        }
    ?>

    <a href='post.php' target='_blank'>Post</a>
    <a href='index.php'> Return </a>
    
    
</body>
</html>
