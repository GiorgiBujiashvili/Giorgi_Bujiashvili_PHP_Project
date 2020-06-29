<?php
    session_start();
    include_once("dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
        $pid = $_GET['pid'];

        $sql = "SELECT * FROM posts WHERE id=$pid LIMIT 1";

        $results = mysqli_query($connection, $sql) or die("Connection Error1");

        $posts = "";

        if(mysqli_num_rows($results) > 0) {
            while($row = mysqli_fetch_assoc($results)){
                $id = $row['id'];
                $title = $row['title'];
                $content = $row['content'];
                $date = $row['date'];

                if(isset($_SESSION['admin']) && $_SESSION[''] == 1){
                    $admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a></div>";
                } else {
                    $admin = "";
                }

                echo "<div><h2>$title</h2><h3>$date</h3><p>$content</p><hr /></div>";
            }
        } else {
            echo "no posts to display";
        }
?>
<a href='index.php'>Return</a>
</body>
</html>