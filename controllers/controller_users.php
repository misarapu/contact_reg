<?php

function controller_register($username, $password)
{
    if ($username == '' || $password == '') {
        return false;
    }


    return model_user_add($username, $password);
}

function controller_user()
{
    if (empty($_SESSION['login'])) {
        return false;
    }
    return $_SESSION['login'];
}

function controller_login($username, $password)
{
    if ($username == '' || $password == '') {
        return false;
    }

    $id = model_user_get($username, $password);

    if (!$id) {
        return false;
    }

    session_regenerate_id();
    $_SESSION['login'] = $id;
    return $id;
}

function controller_logout()
{
    if (!controller_user()) {
        return false;
    }
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    $_SESSION = array();
    session_destroy();
    return true;
}
