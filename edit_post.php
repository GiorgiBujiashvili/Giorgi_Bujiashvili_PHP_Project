<?php
    session_start();
    include_once("dbconnect.php");

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        return;
    }
    if(!isset($_GET['pid'])){
        header("Location: index.php");
    }

    $pid = $_GET['pid'];

    if(isset($_POST['update'])){
        $title = strip_tags($_POST['title']);
        $content = strip_tags($_POST['content']);

        $title = mysqli_real_escape_string($connection, $title);
        $content = mysqli_real_escape_string($connection, $content);

        $date = date('l js \of F Y h:i:s A');

        $sql = "UPDATE posts SET title='$title', content='$content', date='$date' WHERE id=$pid";
    
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
    <?php
        $sql_get = "SELECT * FROM posts WHERE id=$pid LIMIT 1";
        $res = mysqli_query($connection, $sql_get);
        if(mysqli_num_rows($res) > 0 ) {
            while ($row = mysqli_fetch_assoc($res)) {
                $title = $row['title'];
                $content = $row['content'];

                
                echo "<form action='edit_post.php?pid=$pid' method='POST' enctype='multipart/form-data'>";
                echo "<input placeholer='Title' type='text' name='title' value='$title' autofocus size='46'><br /> <br />";
                echo "<textarea placeholder='Content' name='content' cols='50' rows='20'>$content</textarea> <br />";
            }
        }
    ?>
        <input type="submit" name="update" value="Update">
    </form>
    
</body>
</html>