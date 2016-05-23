<?php

require '../config/config_db.php';

/**
 * Laeb andmebaasist kontaktid.
 *
 * @return array $data Masiiv, mis sisaldab kontakti eesnime, perekonnanime,
 *                     vanust, kategooriat
 */
function model_load_profile()
{
    global $l;

    // andmebaasi päring
    $query = 'SELECT contacts.Id, Fn, Ln, Birthdate, Category
              FROM contacts ORDER BY Fn ASC';
    $stmt = mysqli_prepare($l, $query);

    mysqli_execute($stmt);

    mysqli_stmt_bind_result($stmt, $c_id, $fn, $ln, $birthdate, $category);

    $data = array();
    while (mysqli_stmt_fetch($stmt)) {
        $data[] = array(
            'c_id' => $c_id,
            'fn' => $fn,
            'ln' => $ln,
            'birthdate' => $birthdate,
            'category' => $category
        );
    }

    mysqli_stmt_close($stmt);

    return $data;
}

/**
 * Laeb andmebaasist kontakti telefoninumbrid
 *
 * @param int $contact_id Kontakti id väärtus
 *
 * @return array $phones Masiiv, mis sisaldab kontakti telefoninumbreid
 */
function model_load_numbers($contact_id) {

    global $l;

    // andmebaasi päring
    $query = 'SELECT Id, Phone, Contact_id
              FROM phones
              WHERE Contact_id = ?';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_bind_param($stmt, 'i', $contact_id);

    mysqli_execute($stmt);

    mysqli_stmt_bind_result($stmt, $p_id, $phone, $c_id);

    $phones = array();
    while (mysqli_stmt_fetch($stmt)) {
        $phones[] = array(
            'p_id' => $p_id,
            'phone' => $phone,
            'c_id' => $p_id
        );
    }

    mysqli_stmt_close($stmt);

    return $phones;
}

/**
 * Laeb andmebaasist kontakti emailiaadressid
 *
 * @param int $contact_id Kontakti id väärtus
 *
 * @return array $emails Masiiv, mis sisaldab kontakti emailiaadresse
 */
function model_load_emails($contact_id) {

    global $l;

    // andmebaasi päring
    $query = 'SELECT Id, Email, Contact_id
              FROM emails
              WHERE Contact_id = ?';
    $stmt = mysqli_prepare($l, $query);

    mysqli_stmt_bind_param($stmt, 'i', $contact_id);

    mysqli_execute($stmt);

    mysqli_stmt_bind_result($stmt, $e_id, $email, $c_id);

    $emails = array();
    while (mysqli_stmt_fetch($stmt)) {
        $emails[] = array(
            'e_id' => $e_id,
            'email' => $email,
            'c_id' => $c_id
        );
    }

    mysqli_stmt_close($stmt);

    return $emails;
}
