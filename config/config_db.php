<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "contacts_reg";

$l = mysqli_connect($host, $user, $pass, $db);
mysqli_query($l, "SET CHARACTER SET UTF8") or die("Error, ei saa andmebaasi charsetti seatud");
if (!$l) {
    die('Could not connect: ' . mysqli_error($l));
}
