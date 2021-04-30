<?php

//  these are for connection on my local machine where I test stuff.
//  Don't worry and don't bother. :)

$conn = mysqli_connect("localhost", "GoKritz", "bHPfC24jvl599KLR", "userinfo");

if (!$conn) {
    die("Connection to Database failed: " . mysqli_connect_error());
}

session_start();
