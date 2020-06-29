<?php
    session_start();
    include_once("dbconnect.php");

    if(isset($_POST['post'])){
        $title = strip_tags($_POST['title']);
        $content = strip_tags($_POST['content']);

        $title = mysqli_real_escape_string($connection, $title);
        $content = mysqli_real_escape_string($connection, $content);

        $date = date('l js \of F Y h:i:s A');

        $sql = "INSERT INTO posts (title, content, date) VALUES ('$title', '$content', '$date')";
    
        if($title == "" || $content == "") {
            echo "complete your post";
            return;
        }
        mysqli_query($connection, $sql);

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog - post</title>
</head>
<body>
    <form action="post.php" method="POST" enctype="multipart/form-data">
        <input placeholer="Title" type="text" name="title" autofocus size="46"><br /> <br />
        <textarea placeholder="Content" name="content" cols="50" rows="20"></textarea> <br />
        <input type="submit" name="post" value="Post">
    </form>
    
</body>
</html>