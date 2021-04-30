<?php
include "../includes/db_connect.php";

header("Location: ../Home/index.php?error=notallowed");
exit();

$targetdir = "../file_uploads/";
$targetfile = $targetdir . basename($_FILES["uploadedfile"]["name"]);
$uploadOK = 1;
$fileExtension = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

//bar direct access
if (isset($_POST["submit"])) {
    //prevent duplicates
    if (file_exists($targetfile)) {
        echo "That file already exists on the server.";
        $uploadOK = 0;
    }

    //check file type
    if (
        $fileExtension != "jpg"
        && $fileExtension != "jpeg"
        && $fileExtension != "png"
        && $fileExtension != "gif"
        && $fileExtension != "pdf"
        && $fileExtension != "txt"
        && $fileExtension != "doc"
        && $fileExtension != "docx"
        && $fileExtension != "rtf"
        && $fileExtension != "zip"
    ) {
        echo "The uploaded file was not a recognised and allowed file, so I have blocked it in case you are trying to do naughty things. >:)";
        $uploadOK = 0;
    }

    //check filesize
    if ($_FILES["uploadedfile"]["size"] > 5000000) {
        echo "Uploaded files cannot be larger in filesize than 5MB.";
        $uploadOK = 0;
    }

    //upload the file
    if (!$uploadOK) {
        echo "<br>UPLOAD CANCELLED";
    } else {
        if (move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $targetfile)) {
            //we successfully uploaded the file
            header("Location: ../Home/gallery.php?result=upload");
        } else {
            echo "An uncaught error happened and the file was not uploaded. Ask GoKritz, try again later, or try a different file. If there's a bunch of weird looking SQL errors above or below this text, send a screenshot to GoKritz.";
        }
    }
}
