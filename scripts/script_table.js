/**
 * Moodustab kontaktide tabelis uue telefoninumbri või emaliaadressi
 * sisestamiseks ajutise inputi.
 *
 * @param int 0 või 1, vastavalt, kas soovitakse lisada uus telefoninumber
 *                või emailiaadress
 *        int c_id Kontakti id väärtus
 */


function addInput(boolean, c_id)
{
    // kontakti id
    var contactId = c_id;
    // ajutine div
    var infoTypeDiv;
    // ajutine input
    var newInputId;

    // Aktsiooni kontroll - kas input luuakse telefoninumbri või emailiaadressi
    // jaoks. Defineeritakse ajutised id-d, mis omistatakse hiljem ajutisele
    // inputile ja inputi õigesse tabeli lahtrisse esile kutsuvale lingile.
    // Id-d peavad olema samad, mis on loodud vastavalt ka failis
    // '../main/table.php'
    if (boolean == 0) {
        infoTypeDiv = '#add-phone-link-contact-' + c_id;
        newInputId = 'temp-input-phone-' + c_id;
    } else if (boolean == 1) {
        infoTypeDiv = '#add-email-link-contact-' + c_id;
        newInputId = 'temp-input-email-' + c_id;
    }

    // lingile vajutamisel link peidetakse
    $(infoTypeDiv).css('display', 'none');

    // luuakse inputi parent ajutine div
    var div = $('<div/>', {
        class: 'input-group'
    });

    // luuakse input ja seotakse see div-ga
    var input = $('<input/>', {
        type: 'text',
        id: newInputId,
        class: 'form-control',
        style: 'background-color: #ccffff'
    }).appendTo(div);

    // luuakse ajutise inputi eemaldamise nupu parent span
    // ja seotakse seotakse div-ga
    var buttonRemoveSpanOut = $('<span/>', {
        class: 'input-group-btn',
    }).appendTo(div);

    // luuakse ajutise inputi eemaldamise nupp ja soetakse see parent span-ga
    var buttonRemove = $('<button/>', {
        style: 'display: inline-block; background-color: transparent;',
        type: 'button',
        id: 'button-remove-extra-input',
        class: 'btn'
    }).appendTo(buttonRemoveSpanOut);

    // luuakse ajutise inputi eemaldamise nupu child span
    // ja seotakse see parent nupuga
    var buttonRemoveSpanIn = $('<span/>', {
        class: 'glyphicon glyphicon-remove-circle',
    }).appendTo(buttonRemove);

    // luuakse ajutise inputi submit nupu parent span
    // ja seotakse seotakse div-ga
    var buttonSubmitSpanOut = $('<span/>', {
        class: 'input-group-btn',
    }).appendTo(div);

    // luuakse ajutise inputi submit nupp ja soetakse see parent span-ga
    var buttonSubmit = $('<button/>', {
        type: 'button',
        class: 'btn',
        style: 'display: none; background-color: transparent;',
        onclick: 'addSingle(' + boolean + ',' + c_id + ')'
    }).appendTo(buttonSubmitSpanOut);

    // luuakse ajutise inputi submit nupu child span
    // ja seotakse see parent nupuga
    var buttonSubmitSpan = $('<span/>', {
        class: 'glyphicon glyphicon-ok-circle'
    }).appendTo(buttonSubmit);

    // ajutine div seotakse uue inputi lisamise ikooni asemele
    div.appendTo($(infoTypeDiv).prev());

    /**
     * Ajutise inputi eemaldamise nupule vajutades eemeldatakse
     * ajutine div ja tuuakse esile ajutise inputi lisamise ikoon.
     */
    buttonRemove.on('click', function() {
        $(this).parent().parent().remove();
        $(infoTypeDiv).css('display', 'inline-block');
    });

    /**
     * Kui ajutise inputi väärtus ei ole tühi, siis on eemaldamise ja submit nupp
     * nähtavad. Kui input on tühi, siis submit nupp.
     */
    input.on('keyup', function() {
        if(input.val() != '') {
            buttonRemove.css('display', 'inline-block');
            buttonSubmit.css('display', 'inline-block');
        } else if (input.val() == '') {
            buttonSubmit.css('display', 'none');
        }
    });

}

/**
 * Saadetakse andmebaasi ajax päring, et lisada uus üks telefoninumber
 * või emailiaadress.
 *
 * @param int boolean 0 või 1, vastavalt, kas soovitakse saata uus
 *                    telefoninumber või emailiaadress.
 *        int c_id    Kontakti id väärtus
 */
function addSingle(boolean, c_id)
{
    // unikaalne CSRF token
    var csrf_token = $('#csrf_token').val();
    // uue telefoninumbri või emailiaadressi muutuja
    var newValue;
    // post aktsioon
    var in_action;

    // Aktsiooni kontroll - kas saatma hakatakse telefoninumbrit või
    // emailiaadressi. Uuele väärtus on vastava ajutise inputi väärtus
    // Id-d peavad olema samad, mis on loodud vastavalt ka failis
    // '../main/table.php'. Defineeritakse vastav post aktsioon.
    if (boolean == 0) {
        newValue = $('#temp-input-phone-' + c_id).val();
        in_action = 'add-new-phone';
    } else {
        newValue = $('#temp-input-email-' + c_id).val();
        in_action = 'add-new-email';
    }

    // ajax päring
    $.ajax({
        url:"../main/main_page.php",
        method:"POST",
        data:{
              csrf_token: csrf_token,
              action: in_action,
              id: c_id,
              new_value: newValue
        },
        dataType:"text",
        success:function(data) {

            // eduka päringu korral, laetakse uuesti tabeli tbody
            $('#tbody-contacts-list').load('../main/table.php');
        }
    });
}

/**
 * Saadetakse andmebaasi päring vastavalt, kas soovitakse muuta või kustutada
 * telefoninumbrit või emailiaadressi.
 *
 * @parma int mission 1, 2, 3, 4 vastavalt, kas soovitakse kustutada
 *                    telefoninumbrit, uuendada telefoninumbrit, kustutada
 *                    emailiaadressi, muuta emailiaadressi
 *        int pe_id Telefoninumbri või emailiaadressi id väärtus
 *        int c_id Kontakti id väärtus
 */
function modSingle(mission, pe_id, c_id)
{
    // unikaalne CSRF token
    var csrf_token = $('#csrf_token').val();
    // post aktsiooni muutuja
    var in_action;
    // uus väärtus
    var newValue;
    // Kontrollitakse, millist post päringut saata. Telefoninumbri või
    // emailiaadressi uuendamise korral saadakse uus väärtus ajutisest
    // inputist, mille id on on loodud vastavalt ka failis
    // '../main/table.php'
    switch (mission) {
        case 1:
            in_action = 'delete-phone';
            break;
        case 2:
            in_action = 'edit-phone';
            newValue = $('#input-'+c_id+'-'+pe_id+'-phone').val();
            '#input-'+c_id+'-'+pe_id+'-phone'
            break;
        case 3:
            in_action = 'delete-email';
            break;
        case 4:
            in_action = 'edit-email';
            newValue = $('#input-'+c_id+'-'+pe_id+'-email').val();
            break;
    }

    // ajax päring
    $.ajax({
            url:"../main/main_page.php",
            method:"POST",
            data:{
                csrf_token: csrf_token,
                action: in_action,
                id: pe_id,
                new_value: newValue
        },
        dataType:"text",
        success:function(data) {

            // eduka päringu korral laetakse kontaktide tbody uuesti.
            $('#tbody-contacts-list').load('../main/table.php');
        }
    });
}
