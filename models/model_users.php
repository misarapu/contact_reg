<?php

require '../config/config_db.php';

/**
 * Lisab andmebaasi uue kasutajanime ja parooli.
 *
 * @param string $username Uue kasutaja kasutajanimi
 *        string $password Uue kasutaja parool
 *
 * @return int $id Uue kasutaja id väärtus
 */
function model_user_add($username, $password)
{
    global $l;

    // paroolist tehakse räsi
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // andmebaasi päring
    $query = 'INSERT INTO users (Username, Password) VALUES (?, ?)';

    $stmt = mysqli_prepare($l, $query);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'ss', $username, $hash);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);

    mysqli_stmt_close($stmt);

    return $id;
}

/**
 * Otsib andmebaasist kasutaja kasutajanime ja kontollib, kas sisestud parool
 * on vastavuses andmebaasis oleva vastava kasutaja parooliga
 *
 * @param string $username Sisetatud kasutajanimi
 *        string $password Sisestatud parool
 *
 * @return int $id Kasutaja id väärtus
 */
function model_user_get($username, $password)
{
    global $l;
    $query = 'SELECT Id, Password FROM users
              WHERE Username = ? LIMIT 1';
    $stmt = mysqli_prepare($l, $query);
    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $hash);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);


    return password_verify($password, $hash) ? $id : false;
}
