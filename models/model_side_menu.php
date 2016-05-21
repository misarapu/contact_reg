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

function model_load_menu_list() {
    global $l;
    $query = 'SELECT Id, Fn, Ln, Birthdate FROM contacts ORDER BY Fn ASC';
    $stmt = mysqli_prepare($l, $query);
    mysqli_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $fn, $ln, $birthdate);
    $data = array();
    while (mysqli_stmt_fetch($stmt)) {
        $data[] = array(
            'id' => $id,
            'fn' => $fn,
            'ln' => $ln,
            'birthdate' => $birthdate,
        );
    }
    mysqli_stmt_close($stmt);
    return $data;
}
