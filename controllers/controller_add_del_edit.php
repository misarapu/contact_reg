<?php

function controller_add_contact($fn, $ln, $date, $category, $phone, $email)
{
    if (!controller_user()) {
        return false;
    }
    if($fn == '' && $ln == '' && $category == '' && $date == '' && $phone == '' && $email == '') {
        return false;
    }

    return model_add_contact($fn, $ln, $date, $category, $phone, $email);
}

function controller_delete_contact($id)
{
    if (!controller_user()) {
        return false;
    }
    if ($id < 0) {
        return false;
    }
    return model_delete_contact($id);
}

function controller_edit_contact($id, $phone_id, $email_id, $phone, $email)
{
    if (!controller_user()) {
        return false;
    }
    if ($id < 0) {
        return false;
    }
    return model_edit_contact($id, $phone_id, $email_id, $phone, $email);
}

function controller_new_phone($id, $new_phone)
{
    if (!controller_user()) {
        return false;
    }
    if ($id < 0 || $new_phone == '') {
        return false;
    }
    return model_new_phone($id, $new_phone);
}

function controller_new_email($id, $new_email)
{
    if (!controller_user()) {
        return false;
    }
    if ($id < 0 || $new_email == '') {
        return false;
    }
    return model_new_email($id, $new_email);
}

function controller_delete_phone($id)
{
    if (!controller_user()) {
        return false;
    }
    if ($id < 0) {
        return false;
    }
    return model_delete_phone($id);
}

function controller_edit_phone($id, $new_phone)
{
    if (!controller_user()) {
        return false;
    }
    if ($id < 0) {
        return false;
    }
    return model_edit_phone($id, $new_phone);
}
function controller_delete_email($id)
{
    if (!controller_user()) {
        return false;
    }
    if ($id < 0) {
        return false;
    }
    return model_delete_email($id);
}
function controller_edit_email($id, $new_email)
{
    if (!controller_user()) {
        return false;
    }
    if ($id < 0) {
        return false;
    }
    return model_edit_email($id, $new_email);
}
