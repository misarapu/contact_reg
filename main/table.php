<?php

require '../models/model_profile.php';


foreach (model_load_profile() as $profile) {

    $delete_contact = 'deleteContact('.$profile['c_id'].')';

    $add_input_phone = 'addInput(0,'.$profile['c_id'].')';
    $add_input_email = 'addInput(1,'.$profile['c_id'].')';

    $add_one_phone_link_id = 'add-phone-link-contact'.$profile['c_id'];
    $add_one_email_link_id = 'add-email-link-contact'.$profile['c_id'];

    echo '
        <tr>
            <td>'.$profile['c_id'].'</td>
            <td>'.$profile['fn'].'</td>
            <td>'.$profile['ln'].'</td>
            <td>'.$profile['birthdate'].'</td>
            <td>
                <div>';

                foreach (model_load_numbers($profile['c_id']) as $phones) {

                    $phone_input_id = 'input-'.$profile['c_id'].'-'.$phones['p_id'].'-phone';
                    $phone_delete_single = 'modSingle(1,'.$phones['p_id'].','.$profile['c_id'].')';
                    $phone_edit_single = 'modSingle(2,'.$phones['p_id'].','.$profile['c_id'].')';
                    echo '
                    <div>
                        <input type="text" id="'.$phone_input_id.'" value="'.$phones['phone'].'"/>
                        <button onclick="'.$phone_edit_single.'">e</button>
                        <button onclick="'.$phone_delete_single.'">x</button>
                    </div>
                    ';

                }
    echo '
                </div>
                <a id="'.$add_one_phone_link_id.'" onclick="'.$add_input_phone.'">+1</a>
            </td>
            <td>
                <div>';

                foreach (model_load_emails($profile['c_id']) as $emails) {

                    $email_input_id = 'input-'.$profile['c_id'].'-'.$emails['e_id'].'-email';
                    $email_delete_single = 'modSingle(3,'.$emails['e_id'].','.$profile['c_id'].')';
                    $email_edit_single = 'modSingle(4,'.$emails['e_id'].','.$profile['c_id'].')';
                    echo '
                    <div>
                        <input type="text" id="'.$email_input_id.'" value="'.$emails['email'].'"/>
                        <button onclick="'.$email_edit_single.'">e</button>
                        <button onclick="'.$email_delete_single.'">x</button>
                    </div>
                    ';

                }
    echo '
                </div>
                <a id="'.$add_one_email_link_id.'" onclick="'.$add_input_email.'">+1</a>
            </td>
            <td>'.$profile['category'].'</td>;
            <td>

                <button type="button" class="btn btn-warning" onclick="'.$delete_contact.'">Del</button>

            </td>
        </tr>
    ';
}
