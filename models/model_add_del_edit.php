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

function model_add_contact($fn, $ln, $date, $category, $phone, $email)
{
    global $l;

    $query_1 = 'INSERT INTO contacts (Fn, Ln, Birthdate, Category)
                VALUES (?,?,?,?)';
    $stmt_1 = mysqli_prepare($l, $query_1);
    if (mysqli_error($l)) {
        echo mysqli_error($l);
    exit;
    }
    mysqli_stmt_bind_param($stmt_1, 'ssss', $fn, $ln, $date, $category);
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
    $id_3 = mysqli_stmt_insert_id($stmt_3);
    mysqli_stmt_execute($stmt_3);
    mysqli_stmt_close($stmt_3);

    return true;

}

function model_delete_contact($id)
{
    global $l;
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

function model_edit_contact($id, $phone_id, $email_id, $phone, $email) {
    global $l;
    $query = 'UPDATE phones, emails
              SET phones.Phone = ?, emails.Email = ?
              WHERE phones.Contact_id = ?
              AND emails.Contact_id = ?';
    $stmt = mysqli_prepare($l, $query);
    if (mysqli_error($l)) {
      echo mysqli_error($l);
      exit;
    }
    mysqli_stmt_bind_param($stmt, 'ssii', $phone, $email, $id, $id);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_error($stmt)) {
      return false;
    }
    mysqli_stmt_close($stmt);
    return true;
}

function model_new_phone($id, $new_phone) {
    global $l;
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

function model_new_email($id, $new_email) {
    global $l;
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

function model_delete_phone($id)
{
    global $l;
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
function model_edit_phone($id, $new_phone)
{
    global $l;
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

function model_edit_email($id, $new_email)
{
    global $l;
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
