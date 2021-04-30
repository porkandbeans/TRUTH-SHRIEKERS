<?php include "header.php";

?>


<h1>Archive</h1>
<a href="file_upload.php" style="background-color: rgba(255, 255, 255, 0.452);">Upload a document</a><br>
<div class="gallery">

    <?php

    //resource: http://www.learningaboutelectronics.com/How-to-list-all-files-in-a-directory-using-PHP.php

    $dir = "../file_uploads/";
    if (is_dir($dir)) {
        if ($opendirectory = opendir($dir)) {
            while ($file = readdir($opendirectory)) {
                //loop once for each file in the directory
                $pathinfo = pathinfo($file, PATHINFO_EXTENSION);
                //specified that I only need PATHINFO_EXTENSION because I was getting an undefined array key error that made my brain hurt
                $extensions = ["txt", "png", "jpg", "jpeg", "bmp", "pdf"];
                foreach ($extensions as $exten) {
                    if ($pathinfo == $exten) {
                        //will only display files with allowed extensions
                        include "objects/file_display.php";
                    }
                }
            }
            closedir($opendirectory);
        }
    } else {
        echo "The directory is missing!";
        exit();
    }
