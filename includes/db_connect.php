<?php

//  updated for local testing on Arch
//  I use Arch, BTW

if (!$conn = mysqli_connect("localhost", "Dib", "very-secure", "zim_db")) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
