<?php

require '../models/model_profile.php';

// luuakse kontaktide tabeli tbody

foreach (model_load_profile() as $profile) {

    // Kontakti kustutamise nupu funktsioon
    $delete_contact = 'deleteContact('.$profile['c_id'].')';

    // ajutise inputi loomise funktsioon vastavalt uue telefoninumbri ja
    // uue emailiaadressi jaoks
    $add_input_phone = 'addInput(0,'.$profile['c_id'].')';
    $add_input_email = 'addInput(1,'.$profile['c_id'].')';

    // Uuea telefoninumbri ja emaili lisamise nupu funktsioon
    $add_one_phone_link_id = 'add-phone-link-contact-'.$profile['c_id'];
    $add_one_email_link_id = 'add-email-link-contact-'.$profile['c_id'];

    // laetakse kõik kontaktid
    echo '
        <tr>
            <td>'.$profile['c_id'].'</td>
            <td>'.$profile['fn'].'</td>
            <td>'.$profile['ln'].'</td>
            <td style="text-align: center">'.$profile['birthdate'].'</td>
            <td>
                <div>';

                // laetakse ühe kontakti kõik telefoninumbrid
                foreach (model_load_numbers($profile['c_id']) as $phones) {

                    // telefoninumbri inputi eriline id
                    $phone_input_id = 'input-'.$profile['c_id'].'-'.$phones['p_id'].'-phone';
                    // telefoninumbri kustutamise aktsioon
                    $phone_delete_single = 'modSingle(1,'.$phones['p_id'].','.$profile['c_id'].')';
                    // telefoninumbri uuendamise aktsioon
                    $phone_edit_single = 'modSingle(2,'.$phones['p_id'].','.$profile['c_id'].')';

                    // telefoninumbrite vormid koos inputiga ning kustamise ja muutmise nupuga
                    echo '
                    <div class="input-group">
                        <input type="text" class="form-control" id="'.$phone_input_id.'" value="'.$phones['phone'].'"/>
                        <span class="input-group-btn">
                            <button class="btn" onclick="'.$phone_edit_single.'">
                                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                            </button>
                        </span>
                        <span class="input-group-btn">
                            <button class="btn" onclick="'.$phone_delete_single.'">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>
                    ';
                }

                // ajutise inputi lisamise link telefoninubri jaoks
    echo '
                </div>

                <a id="'.$add_one_phone_link_id.'" onclick="'.$add_input_phone.'">
                    <span class="glyphicon glyphicon-plus" style="text-decoration: none; color: black"></span>
                </a>
            </td>
            <td>
                <div>';

                // laetakse ühe kontakti kõik emailiaadressid
                foreach (model_load_emails($profile['c_id']) as $emails) {

                    // emailiaadressi inputi eriline id
                    $email_input_id = 'input-'.$profile['c_id'].'-'.$emails['e_id'].'-email';
                    // emailiaadressi kustutamise aktsioon
                    $email_delete_single = 'modSingle(3,'.$emails['e_id'].','.$profile['c_id'].')';
                    // emailiaadressi uuendamise aktsioon
                    $email_edit_single = 'modSingle(4,'.$emails['e_id'].','.$profile['c_id'].')';

                    // emailiaadressi vormid koos inputiga ning kustamise ja muutmise nupuga
                    echo '
                    <div class="input-group">
                        <input type="text" class="form-control" id="'.$email_input_id.'" value="'.$emails['email'].'"/>
                        <span class="input-group-btn">
                            <button class="btn" onclick="'.$email_edit_single.'">
                                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                            </button>
                        </span>
                        <span class="input-group-btn">
                            <button class="btn" onclick="'.$email_delete_single.'">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>
                    ';

                }

                // ajutise inputi lisamise link emailiaadressi jaoks
    echo '
                </div>
                <a id="'.$add_one_email_link_id.'" onclick="'.$add_input_email.'">
                    <span class="glyphicon glyphicon-plus" style="text-decoration: none; color: black"></span>
                </a>
            </td>
            <td style="text-align: center">'.$profile['category'].'</td>;
            <td>

                <button type="button" class="btn btn-danger" onclick="'.$delete_contact.'">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>

            </td>
        </tr>
    ';
}
