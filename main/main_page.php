<?php

require '../models/model_add_del_edit.php';
require '../models/model_side_menu.php';
require '../models/model_profile.php';
require '../controllers/controller_add_del_edit.php';
require '../controllers/controller_side_menu.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = false;
    switch ($_POST['action']) {
        case 'add-contact':
            $fn = $_POST['fn'];
            $ln = $_POST['ln'];
            $date = $_POST['date'];
            $category = $_POST['category'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $result = controller_add_contact($fn, $ln, $date, $category, $phone, $email);
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

    }

    if ($result) {
        //header('Location: '.$_SERVER['PHP_SELF']);
    } else {
        header('Content-type: text/plain; charset=utf-8');
        echo 'Päring ebaõnnetus!';
    }

    exit;
}

require '../views/view_main.php';


mysqli_close($l);
