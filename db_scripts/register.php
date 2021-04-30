<?php include "../includes/db_connect.php";

$query = $conn->query("select * from `sitesettings` where `settingID` = 1");
$row = $query->fetch_row();

if ($row[2] == 0) {
    //check if registration is allowed
    header("Location: ../Home/index.php?error=nosignups");
    exit();
} else {
    if (!isset($_POST["submit-butt"])) { //HAHAHA BUTTS
        //check submit button
        header("Location: ../Home/index.php?error=notallowed");
        exit();
    } else {
        $postuname = $_POST["uname"];
        $postemail = $_POST["uemail"];

        if ($_POST["pass1"] != $_POST["pass2"]) {
            //check passwords
            header("Location: ../Home/register.php?error=password_missmatch&username="
                . $postuname . "&email=" . $postemail);
            exit();
        } else {
            $postpass = $_POST["pass1"];
        }

        if (empty($postuname) || empty($postemail) || empty($postpass)) {
            //check empty fields
            header("Location: ../Home/register.php?error=empty_fields&username="
                . $postuname . "&pass=" . $postpass . "&email=" . $postemail);
            exit();
        }

        if (!filter_var($postemail, FILTER_VALIDATE_EMAIL)) {
            //validate email
            header("Location: ../Home/register.php?error=invalid_email&username="
                . $postuname . "&pass=" . $postpass);
            exit();
        }

        if (!preg_match("/\w{5,29}$/", $postuname)) {
            //validate username
            header("Location: ../Home/register.php?error=invalid_username&pass="
                . $postpass . "&email=" . $postemail);
            exit();
        }

        //SQL query to check if the user already exists
        $sqlgetusers = "SELECT * FROM `users` WHERE `userNameUpper` = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlgetusers)) {
            header("Location: ../Home/register.php?error=not_prepared");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", strtoupper($postuname));
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                //finally
                header("Location: ../Home/register.php?error=user_exists&pass="
                    . $postpass . "&email=" . $postemail);
                exit();
            }
        }

        //now check emails already in use
        $sqlgetemails = "SELECT * FROM `users` WHERE `userEmail` = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlgetemails)) {
            header("Location: ../Home/register.php?error=not_prepared");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", strtoupper($postemail));
            //make sure you SAVE emails in the database as uppercase too
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                header("Location: ../Home/register.php?error=email_in_use&username="
                    . $postuname . "&pass=" . $postpass);
                exit();
            }
        }

        //okay, I guess at this point you're good to go

        $sql = "INSERT INTO `users`
            (userName, userEmail, userPassword, userNameUpper, dateCreated) VALUES
            (?, ?, ?, ?, CURRENT_TIMESTAMP);";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../Home/register.php?error=not_prepared_insert");
            echo (mysqli_error($conn));
            exit();
        } else {
            mysqli_stmt_bind_param(
                //bind variables to statement
                $stmt,
                "ssss",
                $postuname,
                strtoupper($postemail),
                password_hash($postpass, PASSWORD_DEFAULT),
                strtoupper($postuname),
            );

            //execute
            mysqli_stmt_execute($stmt);

            //thanks, now GTFO
            header("Location: ../Home/index.php?result=register");
            exit();
        }
    }
}
