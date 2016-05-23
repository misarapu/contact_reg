<?php

session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(20));
}

require '../models/model_add_del_edit.php';
require '../models/model_profile.php';
require '../models/model_users.php';
require '../controllers/controller_add_del_edit.php';
require '../controllers/controller_users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = false;
    $result_reg = false;
    if (!empty($_POST['csrf_token']) && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
        switch ($_POST['action']) {

            case 'add-contact':
                $fn = $_POST['fn'];
                $ln = $_POST['ln'];
                $age = $_POST['date'];
                $category = $_POST['category'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $result = controller_add_contact($fn, $ln, $age, $category, $phone, $email);
                break;

            case 'delete-contact':
                $id = $_POST['id'];
                $result = controller_delete_contact($id);
                break;

            case 'add-new-phone':
                $id = $_POST['id'];
                $new_phone = $_POST['new_value'];
                $result = controller_new_phone($id, $new_phone);
                break;

            case 'add-new-email':
                $id = $_POST['id'];
                $new_email = $_POST['new_value'];
                $result = controller_new_email($id, $new_email);
                break;

            case 'delete-phone':
                $id = $_POST['id'];
                $result = controller_delete_phone($id);
                break;

            case 'edit-phone':
                $id = $_POST['id'];
                $new_phone = $_POST['new_value'];
                $result = controller_edit_phone($id, $new_phone);
                break;

            case 'delete-email':
                $id = $_POST['id'];
                $result = controller_delete_email($id);
                break;

            case 'edit-email':
                $id = $_POST['id'];
                $new_email = $_POST['new_value'];
                $result = controller_edit_email($id, $new_email);
                break;

            case 'register':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $result_reg = controller_register($username, $password);
                break;

            case 'login':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $result_reg = controller_login($username, $password);
                break;

            case 'logout':
                $result_reg = controller_logout();
                break;
        }
    } else {
        message_add('Vigane päring, CSRF token ei vasta oodatule');
    }
    header('Location: '.$_SERVER['PHP_SELF']);
    exit;
}


if(!empty($_GET['view'])) {
    switch ($_GET['view']) {

        case 'register':
            require '../views/view_register.php';
            break;

        case 'login':
            require '../views/view_login.php';
            break;

        default:
            header('Content-Type: text/plain; Charset=utf-8');
            echo 'Tundmatu valik!';
            exit;
    }
} else {
    if (!controller_user()) {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=login');
        exit;
    }

    require '../views/view_main.php';
}

mysqli_close($l);
