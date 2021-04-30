<?php include "header.php";

$query = $conn->query("select * from `sitesettings` where `settingID` = 1");

$row = $query->fetch_row();

if ($row[2] == 1) {
    include "objects/registerform.php";
} else {
    echo "<p style='background-color: rgba(89, 42, 95, 0.685); color: white; font-size: 60px;'>Registration is currently disabled. Please come back in the future!</p>";
}
