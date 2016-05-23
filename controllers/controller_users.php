<?php

/**
 * Kontroller, mis registreerib uue kasutaja.
 *
 * @param string $username Uue kasutaja kasutajanimi
 *        string $password Uue kasutaja parool
 *
 * @return boolean
 */
function controller_register($username, $password)
{
    // sisendite sobivuse kontroll
    if ($username == '' || $password == '') {
        message_add('Vigased sisendandmed');
        return false;
    }

    // kontroll, kas andmebaasis on juba sellenimile kasutaja või mitte
    if(model_user_add($username, $password)) {
        return true;
    } else {
        // veateade
        message_add('Konto registreerimine ebaõnnestus, kasutajanimi võib olla juba võetud');
        return false;
    }
}

/**
 * Kontroller, mis kontrollib, kas kasutaja on sisse logitud.
 *
 * @return $_SESSION['login']
 */
function controller_user()
{
    // sisendite sobivuse kontroll
    if (empty($_SESSION['login'])) {
        return false;
    }

    return $_SESSION['login'];
}

/**
 * Kontroller, mis lubab registreeritud kasutajal sisse logida
 *
 * @param string $username Registreeritud kasutaja kasutajanimi
 *        string $password Registreeritud kasutaja parool
 *
 * @return int $id Kasutaja id väärtus
 */
function controller_login($username, $password)
{
    // sisendite sobivuse kontroll
    if ($username == '' || $password == '') {
        return false;
    }
    // kui kasutajanimi on andmebaasis olemas, tagastatakse selle id
    $id = model_user_get($username, $password);

    // kui kasutanimi andmebaasist puudub, edastatakse veateade
    if(!$id) {
        message_add('Vigane kasutajanimi või parool!');
        return false;
    }
    session_regenerate_id();
    $_SESSION['login'] = $id;
    return $id;
}

/**
 * Kontroller, mis logib kasutaja lehelt välja
 *
 * @return int $id Kasutaja id väärtus
 */
function controller_logout()
{
    // kontroll, kas kasutaja on sisse loginud
    if (!controller_user()) {
        return false;
    }

    // COOKIE kirjutatakse üle ja sessioon lõpetatakse
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    $_SESSION = array();
    session_destroy();
    return true;
}

/**
 * Kontroller, mis loob sessiooni kuuluva massiivi ja lisab sinna
 * kirjeid
 *
 * @param string $message Uus kirje
 *
 */
function message_add($message)
{
    if (empty($_SESSION['messages'])) {
        $_SESSION['messages'] = array();
    }
    $_SESSION['messages'][] = $message;
}

/**
 * Kontroller, mis väljastab sessioni sõnumite massiivi kirjed.
 *
 * @return array $messages Sõnumite massiiv
 *
 */
function message_list()
{
    if (empty($_SESSION['messages'])) {
        return array();
    }
    $messages = $_SESSION['messages'];
    $_SESSION['messages'] = array();
    return $messages;
}
