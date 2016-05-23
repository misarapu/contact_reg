<?php

/**
 * Kontroller, mis lisab uue kontakti.
 *
 * @param string $fn Uue kontakti eesnimi
 *        string $ln Uue kontakti perekonnanimi
 *        int $age Uue kontakti vanus
 *        string $phone Uue kontakti telefoninumber
 *        string $email Uue kontakti emailiaadress
 * @return function model_add_contact($fn, $ln, $age, $category, $phone, $email)
 */
function controller_add_contact($fn, $ln, $age, $category, $phone, $email)
{
    // kontroll, kas kasutaja on sisse loginud
    if (!controller_user()) {
        return false;
    }
    // sisendite sobivuse kontroll
    if($fn == '' && $ln == '' && $category == '' && $age < 0 && $phone == '' && $email == '') {
        return false;
    }

    return model_add_contact($fn, $ln, $age, $category, $phone, $email);
}

/**
 * Kontroller, mis kustutab kontakti koos andmetega.
 *
 * @param int $id Kontakti id väärtus
 *
 * @return function model_delete_contact($id)
 */
function controller_delete_contact($id)
{
    // kontroll, kas kasutaja on sisse loginud
    if (!controller_user()) {
        return false;
    }
    // sisendite sobivuse kontroll
    if ($id < 0) {
        return false;
    }
    return model_delete_contact($id);
}

/**
 * Kontroller, mis lisab kontaktile uue telefoninumbri.
 *
 * @param int $id Kontakti id väärtus
 *        string $new_phone Uus telefoninumber
 *
 * @return function model_new_phone($id, $new_phone)
 */
function controller_new_phone($id, $new_phone)
{
    // kontroll, kas kasutaja on sisse loginud
    if (!controller_user()) {
        return false;
    }
    // sisendite sobivuse kontroll
    if ($id < 0 || $new_phone == '') {
        return false;
    }
    return model_new_phone($id, $new_phone);
}

/**
 * Kontroller, mis lisab kontaktile uue emailiaadress.
 *
 * @param int $id Kontakti id väärtus
 *        string $new_email Uus emailiaadress
 *
 * @return function model_new_email($id, $new_email)
 */
function controller_new_email($id, $new_email)
{
    // kontroll, kas kasutaja on sisse loginud
    if (!controller_user()) {
        return false;
    }
    // sisendite sobivuse kontroll
    if ($id < 0 || $new_email == '') {
        return false;
    }
    return model_new_email($id, $new_email);
}

/**
 * Kontroller, mis kustutab kontakti ühe telefoninumbri.
 *
 * @param int $id Telefoninumbri id väärtus
 *
 * @return function model_delete_phone($id)
 */
function controller_delete_phone($id)
{
    // kontroll, kas kasutaja on sisse loginud
    if (!controller_user()) {
        return false;
    }
    // sisendite sobivuse kontroll
    if ($id < 0) {
        return false;
    }
    return model_delete_phone($id);
}

/**
 * Kontroller, mis kustutab kontakti ühe emailiaadress
 *
 * @param int $id Emailiaadressi id väärtus
 *
 * @return function model_delete_email($id)
 */
function controller_delete_email($id)
{
    // kontroll, kas kasutaja on sisse loginud
    if (!controller_user()) {
        return false;
    }
    // sisendite sobivuse kontroll
    if ($id < 0) {
        return false;
    }
    return model_delete_email($id);
}

/**
 * Kontroller, mis uuendab kontakti ühte valitud telefoninumbri.
 *
 * @param int $id Telefoninumbri id väärtus
 *        string $new_phone Uus telefoninumber
 *
 * @return function model_edit_phone($id, $new_phone)
 */
function controller_edit_phone($id, $new_phone)
{
    // kontroll, kas kasutaja on sisse loginud
    if (!controller_user()) {
        return false;
    }
    // sisendite sobivuse kontroll
    if ($id < 0) {
        return false;
    }
    return model_edit_phone($id, $new_phone);
}

/**
 * Kontroller, mis uuendab kontakti ühte valitud emailiaadressi.
 *
 * @param int $id Emailiaadressi id väärtus
 *        string $new_email Uus email
 *
 * @return function model_edit_email($id, $new_email)
 */
function controller_edit_email($id, $new_email)
{
    // kontroll, kas kasutaja on sisse loginud
    if (!controller_user()) {
        return false;
    }
    // sisendite sobivuse kontroll
    if ($id < 0) {
        return false;
    }
    return model_edit_email($id, $new_email);
}
