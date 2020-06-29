<?php
    session_start();
    include_once("dbconnect.php");
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
                $content = $row['content'];
                $date = $row['date'];

                $posts .= "<div><h2><a href='view_post.php?pid=$id'>$title</a></h2><h3>$date</h3><p>$content</p><hr /></div>";
            }
            echo $posts;
        } else {
            echo "no posts to display";
        }

        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
            echo "<a href='post.php' target='_blank'>Post</a> <br> <a href='admin.php'>Admin</a> | <a href='logout.php'>Logout</a>";
        }

        if(!isset($_SESSION['username'])){
            echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a>";
        }

        if(isset($_SESSION['username']) && !isset($_SESSION['admin'])){
            echo "<a href='post.php' target='_blank'>Post</a> <br> <a href='logout.php'>Logout</a>";
        }
    ?>


</body>
</html>
