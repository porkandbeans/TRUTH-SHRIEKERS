<?php
include "../includes/db_connect.php";

if (!isset($_POST["submit"])) {
    header("Location: ../Home/index.php?error=notallowed");
    exit();
} else {
    if (empty($_POST["userName"]) || empty($_POST["userPass"])) {
        //both fields require input
        header("Location: ../Home/index.php?error=emptyfields&username=" . $_POST["userName"]);
        exit();
    } else {
        //store username
        $postuser = $_POST["userName"];
        $sql = "SELECT * FROM `users` WHERE `userNameUpper` = ?";
        $stmt = mysqli_stmt_init($conn); //this shit is always the same
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../Home/index.php?error=notprepared");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", strtoupper($postuser));
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                //got the username, now we're gonna check the password
                $passcheck = password_verify($_POST["userPass"], $row["userPassword"]);
                if (!$passcheck) {
                    //password bad, no permit.
                    header("Location: ../Home/index.php?error=badpassword&username=" . $postuser);
                    exit();
                } else {
                    session_start();

                    $_SESSION["userName"] = $row["userName"];
                    $_SESSION["userID"] = $row["userID"];
                    $_SESSION["admin"] = $row["admin"];

                    header("Location: ../Home/index.php?result=login");
                    exit();
                }
            } else {
                header("Location: ../Home/index.php?error=nouserfound&username=" . $postuser);
                exit();
            }
        }
    }
}
