<?php
    session_start();
    include_once("dbconnect.php");
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        return;
    }
    if(!isset($_GET['pid'])){
        header("Location: index.php");
    } else {
        $pid = $_GET['pid'];
        $sql = "DELETE FROM posts WHERE id=$pid";
        mysqli_query($connection, $sql);
        header("Location: index.php");
    }
?>