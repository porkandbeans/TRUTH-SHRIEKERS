<?php include "header.php";

echo "<h1>" . $_GET["file"] . "</h1>"; ?>

<div class="gallery">
    <?php

    if (!isset($_GET["file"])) {
    ?>
        <div class="errorbox">Uh oh! There was no file specified.</div>
    <?php

    }

    $dir = "../file_uploads/";
    if ($opendir = opendir($dir)) {
        $ext = pathinfo($dir . $_GET["file"], PATHINFO_EXTENSION);

        switch ($ext) {
            case "txt":
                $file = fopen($dir . $_GET["file"], "r") or die("Unable to open file");

                if (filesize($dir . $_GET["file"]) <= 0) {
                    echo "<p style='color: gray'>File is empty!</p>";
                } else {
                    $content = nl2br(htmlentities(fread($file, filesize($dir . $_GET["file"]))));
                    //YOWZA that's complex, I'll do my patented "dumb but sometimes useful comment breakdown"

                    //fopen() - opens the target file - in our case $dir(../file_uploads/) . then get data for the filename
                    //nl2br() - converts new line data into <br>
                    //htmlentities() - turns stuff like </div> <h1> in the .txt into safe to view HTML entities
                    //fread() - reads the contents of the file, the amount specified by filesize()

                    //then I just display it with echo
                    echo $content;
                }
                break;
            case "jpg":
                echo "<img src='" . $dir . $_GET["file"] . "'></img>";
                break;
            case "jpeg":
                echo "<img src='" . $dir . $_GET["file"] . "'></img>";
                break;
            case "png":
                echo "<img src='" . $dir . $_GET["file"] . "'></img>";
                break;
            case "bmp":
                echo "<img src='" . $dir . $_GET["file"] . "'></img>";
                break;
        }
    }

    //annoyingly, I have to prepare my statement since i'm using GET data
    $filequery = strtolower($_GET["file"]);

    $sql = "SELECT * FROM `files` WHERE `fileName` = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "ERROR: " . mysqli_error($conn);
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $filequery);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $assoc = mysqli_fetch_assoc($result);
        echo "<div class='commentsbox'>" . $assoc["comments"] . "</div>";
    }
