<?php

require '../config/config_db.php';

/**
 * Lisab andmebaasi uue kontakti ja selle kontakt andmed vastavatesse
 * andmebaasi tabelitesse
 *
 * @param string $fn Uue kontakti eesnimi
 *        string $ln Uue kontakti perekonnanimi
 *        int $age Uue kontakti vanus
 *        string $phone Uue kontakti telefoninumber
 *        string $email Uue kontakti emailaadress
 *
 * @return boolean
 */
function model_add_contact($fn, $ln, $age, $category, $phone, $email)
{
    global $l;

    // andmebaasi päring
    $query_1 = 'INSERT INTO contacts (Fn, Ln, Birthdate, Category)
                VALUES (?,?,?,?)';
    $stmt_1 = mysqli_prepare($l, $query_1);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
    exit;
    }

    mysqli_stmt_bind_param($stmt_1, 'ssss', $fn, $ln, $age, $category);
    mysqli_stmt_execute($stmt_1);

    $id_1 = mysqli_stmt_insert_id($stmt_1);

    mysqli_stmt_close($stmt_1);

    $query_2 = 'INSERT INTO phones (Phone, Contact_id) VALUES (?,?)';
    $stmt_2 = mysqli_prepare($l, $query_2);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
    exit;
    }

    mysqli_stmt_bind_param($stmt_2, 'si', $phone, $id_1);
    mysqli_stmt_execute($stmt_2);

    $id_2 = mysqli_stmt_insert_id($stmt_2);
    mysqli_stmt_close($stmt_2);

    $query_3 = 'INSERT INTO emails (Email, Contact_id) VALUES (?,?)';
    $stmt_3 = mysqli_prepare($l, $query_3);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
    exit;
    }

    mysqli_stmt_bind_param($stmt_3, 'si', $email, $id_1);
    mysqli_stmt_execute($stmt_3);

    $id_3 = mysqli_stmt_insert_id($stmt_3);
    mysqli_stmt_close($stmt_3);

    return true;
}

/**
 * Kustutab kontakti ja kontakti andmed vastavatest andmebaasi
 * tabelistest
 *
 * @param int $id Kasutaja id väärtus
 *
 * @return boolean
 */
function model_delete_contact($id)
{
    global $l;

    // andmebaasi päring
    $query_1 = 'DELETE FROM contacts
                WHERE Id = ? LIMIT 1';
    $query_2 = 'DELETE FROM phones
                WHERE Contact_id = ? LIMIT 1';
    $query_3 = 'DELETE FROM emails
                WHERE Contact_id = ? LIMIT 1';
    $stmt_1 = mysqli_prepare($l, $query_1);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
    exit;
    }

    mysqli_stmt_bind_param($stmt_1, 'i', $id);
    mysqli_stmt_execute($stmt_1);

    if (mysqli_stmt_error($stmt_1)) {
        return false;
    }

    mysqli_stmt_close($stmt_1);

    $stmt_2 = mysqli_prepare($l, $query_2);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
    exit;
    }

    mysqli_stmt_bind_param($stmt_2, 'i', $id);
    mysqli_stmt_execute($stmt_2);

    if (mysqli_stmt_error($stmt_2)) {
        return false;
    }

    mysqli_stmt_close($stmt_2);

    $stmt_3 = mysqli_prepare($l, $query_3);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
    exit;
    }

    mysqli_stmt_bind_param($stmt_3, 'i', $id);
    mysqli_stmt_execute($stmt_3);

    if (mysqli_stmt_error($stmt_3)) {
        return false;
    }

    mysqli_stmt_close($stmt_3);

    return true;
}

/**
 * Lisab andmebaasi uue telefoninumbri
 *
 * @param int $id Kasutaja id väärtus
 *        string $new_phone Uus telefoninumber
 *
 * @return boolean
 */
function model_new_phone($id, $new_phone)
{
    global $l;

    // andmebaasi päring
    $query = 'INSERT INTO phones (Phone, Contact_id)
              VALUES (?,?)';
    $stmt = mysqli_prepare($l, $query);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;

    }
    mysqli_stmt_bind_param($stmt, 'si', $new_phone, $id);
    mysqli_stmt_execute($stmt);

    $row = mysqli_stmt_insert_id($stmt);

    mysqli_stmt_close($stmt);

    return true;
}

/**
 * Lisab andmebaasi uue emailiaadressi
 *
 * @param int $id Kasutaja id väärtus
 *        string $new_email Uus emailaadress
 *
 * @return boolean
 */
function model_new_email($id, $new_email) {

    global $l;

    // andmebaasi päring
    $query = 'INSERT INTO emails (Email, Contact_id)
              VALUES (?,?)';
    $stmt = mysqli_prepare($l, $query);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'si', $new_email, $id);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);

    mysqli_stmt_close($stmt);

    return true;
}

/**
 * Kustutab andmebaasist ühe telefoninumbri
 *
 * @param int $id Telefoninumbri id väärtus
 *
 * @return int $deleted Andmebaasi tabeli rea väärtus
 */
function model_delete_phone($id)
{
    global $l;

    // andmebaasi päring
    $query = 'DELETE FROM phones
              WHERE Id=?
              LIMIT 1';
    $stmt = mysqli_prepare($l, $query);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $deleted = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);

    return $deleted;
}

/**
 * Uuendab andmebaasist ühte telefoninumbrit
 *
 * @param int $id Telefoninumbri id väärtus
 *        string $new_phone Uus telefoninumber
 *
 * @return boolean
 */
function model_edit_phone($id, $new_phone)
{
    global $l;

    // andmebaasi päring
    $query = 'UPDATE phones
              SET Phone = ?
              WHERE Id = ?';
    $stmt = mysqli_prepare($l, $query);

    if (mysqli_error($l)) {
      echo mysqli_error($l);
      exit;
    }

    mysqli_stmt_bind_param($stmt, 'si', $new_phone, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_error($stmt)) {
      return false;
    }

    mysqli_stmt_close($stmt);

    return true;
}

/**
 * Kustutab andmebaasist ühe emailiaadressi
 *
 * @param int $id emailiaadressi id väärtus
 *
 * @return int $deleted Andmebaasi tabeli rea väärtus
 */
function model_delete_email($id)
{

    global $l;

    $query = 'DELETE FROM emails
              WHERE Id=?
              LIMIT 1';
    $stmt = mysqli_prepare($l, $query);

    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $deleted = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);

    return $deleted;
}

/**
 * Uuendab andmebaasist ühte emailiaadressi
 *
 * @param int $id Emailiaadressi id väärtus
 *        string $new_email Uus email
 *
 * @return boolean
 */
function model_edit_email($id, $new_email)
{
    global $l;

    // andmebaasi päring
    $query = 'UPDATE emails
              SET Email = ?
              WHERE Id = ?';
    $stmt = mysqli_prepare($l, $query);

    if (mysqli_error($l)) {
      echo mysqli_error($l);
      exit;
    }

    mysqli_stmt_bind_param($stmt, 'si', $new_email, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_error($stmt)) {
      return false;
    }

    mysqli_stmt_close($stmt);

    return true;
}
