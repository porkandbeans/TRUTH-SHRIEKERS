<?php include "../includes/db_connect.php";

if (!isset($_SESSION["userID"])) {	
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="main.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRUTH SHRIEKERS</title>
</head>

<body onresize="getScreenSize()">

    <div class="navbar" id="pghed">
        <ul class="site-nav">
            <a class="navlink" href="index.php">
                <li class="nav-item">Home</li>
            </a>
            <a class="navlink" href="index.php">
                <li class="nav-item">News</li>
            </a>
            <a class="navlink" href="gallery.php">
                <li class="nav-item">Archive</li>
            </a>
            <a class="navlink" href="discords.php">
                <li class="nav-item">Discord Servers</li>
            </a>
        </ul>
    </div>

    <div class="accountbar" id="pghed">
        <div class="userinfo">
            <?php if (isset($_SESSION["userName"])) {
                echo "Logged in as " . $_SESSION["userName"];
            } ?>
        </div>
        <div class="account-content">
            <?php
            if (!isset($_SESSION["userID"])) {
                include "objects/loginform.php";
            } else {
                echo "<a href='../db_scripts/logout.php'>logout</a>";
            }
            ?>
        </div>
    </div>
    <?php
    include "objects/error.php";
    ?>
