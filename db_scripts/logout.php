<?php
include "../includes/db_connect.php";


if (isset($_SESSION["userName"])) {
    unset($_SESSION["userName"]);
}

if (isset($_SESSION["userID"])) {
    unset($_SESSION["userID"]);
}

if (isset($_SESSION["admin"])) {
    unset($_SESSION["admin"]);
}

header("Location: ../Home/index.php?result=logged_out");
exit();
