$(document).ready(function()
{
    $('#button-add').click(function() {
        var in_fn = $.trim($('#input-add-fn').val());
        var in_ln = $.trim($('#input-add-ln').val());
        var in_category = $.trim($('#select-add-category').val());
        var in_day = $.trim($('#select-add-day').val());
        var in_month = $.trim($('#select-add-month').val());
        var in_year = $.trim($('#select-add-year').val());
        var in_phone = $.trim($('#input-add-phone').val());
        var in_email = $.trim($('#input-add-email').val());
        var in_date = getAge(in_year + "-" + in_month + "-" + in_day);

        if ((in_fn == '' && in_ln == '') || (in_category == '' || in_day == ''
            || in_month == '' || in_year == '') || (in_phone == '' && in_email == '')) {
            alert("Väljad täitmata!");
        } else {
            console.log("klikk");
            $.ajax({
                    url:"../main/main_page.php",
                    method:"POST",
                    data:{action:'add-contact',
                    fn:in_fn,
                    ln:in_ln,
                    date:in_date,
                    category:in_category,
                    phone:in_phone,
                    email:in_email
                },
                dataType:"text",
                success:function(data) {
                    $('#tbody-contacts-list').load('../main/table.php');
                    $('#div-menu-list').load('../main/side_menu.php');
                }
            });
        $('#form-add-contact').trigger("reset");
        configHideShow('#div-table');
        }
    });
});

function getAge(date)
{
    var b = date.split('-');
    var bYear = parseInt(b[0]);
    var bMonth = parseInt(b[1]);
    var bDay = parseInt(b[2]);

    var currentTime = new Date();
    var nYear = currentTime.getFullYear();
    var nMonth = currentTime.getMonth();
    var nDay = currentTime.getDate();

    var years = nYear - bYear;
    var months = nMonth - bMonth;
    var days = nDay - bDay;

    if(months + 1 < 0 || (months + 1 === 0 && days < 0)) {
        return years - 1;
    } else {
        return years;
    }
}

function deleteContact(c_id)
{

    $.ajax({
        url:"../main/main_page.php",
        method:"POST",
        data:{
              action: 'delete-contact',
              id: c_id,
        },
        dataType:"text",
        success:function(data) {
            $('#tbody-contacts-list').load('../main/table.php');
            $('#div-menu-list').load('../main/side_menu.php');
        }
    });
}

    /*$('#select-add-month').change(function() {
        var currentTime = new Date();
        var d = $('#select-add-day').val();
        var m = $('#select-add-month').val();
        var y = $('#select-add-year').val();
        if (currentTime.getFullYear() != y){
            if (m == 1 || m == 3 || m == 5 || m == 6 || m == 8 || m == 10 || m == 12) {
                $('#select-add-day').attr('max', '31');
            } else if (m == 2) {
                $('#select-add-day').attr('max', '28');
                if (d > 28) {
                    $('#select-add-day').val(28);
                }
            } else {
                $('#select-add-day').attr('max', '30');
                if (d == 31) {
                    $('#select-add-day').val(30);
                }
            }
        } else {
            $('#select-add-day').attr('max', currentTime.getDate());
            $('#select-add-month').attr('max', currentTime.getMonth() + 1);
        }
    });

    $('#select-add-year').change(function() {
        var currentTime = new Date();
        var d = $('#select-add-day').val();
        var m = $('#select-add-month').val();
        var y = $('#select-add-year').val();
        $('#select-add-year').attr('max', currentTime.getFullYear());
        if ( y == currentTime.getFullYear() && m > currentTime.getMonth() + 1) {
            $('#select-add-month').attr('max', currentTime.getMonth() + 1);
            $('#select-add-day').val(currentTime.getDate());
            $('#select-add-month').val(currentTime.getMonth() + 1);
        } else {
            $('#select-add-month').attr('max', '12');
        }
    });*/
