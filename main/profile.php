<?php

//require '../models/model_profile.php';
/*
$profile = model_load_profile($_POST['id']);
foreach (model_load_profile($_POST['id']) as $profile) {
    if ($_POST['id'] == $profile['c_id']) {
        echo $profile['c_id'];
        echo $_POST['id'];
        echo '
            <h2>Profiil</h2>
            <div class="container" id="div-profile-main">
                <table border="1">
                    <tbody>';
        echo '
            <tr>
                <td>Nimi</td>
                <td>' . $profile['fn'] . ' ' .  $profile['ln'] . '</td>
            </tr>
            <tr>
                <td>Vanus</td>
                <td>' . $profile['birthdate'] . '</td>
            </tr>';
        if ($profile['phone'] != "") {
            echo '
            <tr>
                <td>Telefon</td>
                <td>'
                    . $profile['phone'] . '
                    <button type="button" id="button-delete-' . $profile['p_id'] . '" onclick="deletePhone(' . $profile['p_id'] . ')">Kustuta</button>
                </td>
            </tr>';
        } else {
            echo '
            <tr>
                <td>Telefon</td>
                <td>
                    <p>Puudub</p>
                </td>
            </tr>';
        }
        if ($profile['email'] != "") {
            echo '
            <tr>
                <td>Email</td>
                <td>'
                    . $profile['email'] . '
                    <button type="button" name="button">Kustuta</button>
                </td>
            </tr>';
        } else {
            echo '
            <tr>
                <td>Email</td>
                <td>
                    <p>Puudub</p>
                </td>
            </tr>';
        }
        echo '
        </tbody>
        </table>
        <button type="button" class="btn btn-primary" id="button-add">Kustuta kontakt</button>
        </div>';
    }
}
*/
