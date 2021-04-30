<?php include "header.php";
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] == 0) {
    header("Location: ../Home/index.php?error=notallowed");
    exit();
}
?>

<form action="../db_scripts/file_upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="uploadedfile" id="uploadedfile">
    <input type="submit" value="upload" name="submit">
</form>