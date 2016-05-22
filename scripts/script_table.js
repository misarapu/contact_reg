function addInput(boolean, c_id)
{
    var contactId = c_id;

    var infoTypeDiv;
    var newInputId;
    if (boolean == 0) {
        infoTypeDiv = '#add-phone-link-contact' + c_id;
        newInputId = 'temp-input-phone-' + c_id;
    } else if (boolean == 1) {
        infoTypeDiv = '#add-email-link-contact' + c_id;
        newInputId = 'temp-input-email-' + c_id;
    }

    $(infoTypeDiv).css('display', 'none');
    var div = $('<div/>');

    var buttonRemove = $('<button/>', {
        style: 'display: inline-block',
        type: 'button',
        id: 'button-remove-extra-input',
        text: 'x'
    }).appendTo(div);

    var input = $('<input/>', {
        type: 'text',
        id: newInputId
    }).appendTo(div);

    var buttonSubmit = $('<button/>', {
        type: 'button',
        text: 'lisa',
        style: 'display: none',
        onclick: 'addSingle(' + boolean + ',' + c_id + ')'
    }).appendTo(div);

    div.appendTo($(infoTypeDiv).prev());

    buttonRemove.on('click', function() {
        $(this).parent().remove();
        $(infoTypeDiv).css('display', 'inline-block');
    });

    input.on('keyup', function() {
        if(input.val() != '') {
            buttonRemove.css('display', 'inline-block');
            buttonSubmit.css('display', 'inline-block');
        } else if (input.val() == '') {
            $(infoTypeDiv).css('display', 'none');
        }
    });

}

function addSingle(boolean, c_id)
{
    var csrf_token = $('#csrf_token').val();

    var newValue;
    var in_action;
    if (boolean == 0) {
        newValue = $('#temp-input-phone-' + c_id).val();
        in_action = 'add-new-phone';
    } else {
        newValue = $('#temp-input-email-' + c_id).val();
        in_action = 'add-new-email';
    }

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
            $('#tbody-contacts-list').load('../main/table.php');
        }
    });
}

function modSingle(mission, pe_id, c_id) {

    var csrf_token = $('#csrf_token').val();

    var in_action;
    var newValue;
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

    console.log(newValue);
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
            $('#tbody-contacts-list').load('../main/table.php');
        }
    });
}
