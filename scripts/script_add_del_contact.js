$(document).ready(function()
{
    /**
      * Uue kontakti andmete saatmine andmebaasi.
      */

    $('#button-add').click(function() {

        // unikaalne CSRF token
        var csrf_token = $('#csrf_token').val();

        // andmete päring lahtritest ja tühjaruumi eemaladamine kirjest
        var in_fn = $.trim($('#input-add-fn').val());
        var in_ln = $.trim($('#input-add-ln').val());
        var in_category = $.trim($('#select-add-category').val());
        var in_day = $.trim($('#select-add-day').val());
        var in_month = $.trim($('#select-add-month').val());
        var in_year = $.trim($('#select-add-year').val());
        var in_phone = $.trim($('#input-add-phone').val());
        var in_email = $.trim($('#input-add-email').val());

        // sünnikuupäeva põhjal vanuse arvutamine
        var in_date = getAge(in_year + "-" + in_month + "-" + in_day);

        // väljade täidetatavuse kontroll ja ajax päringu loomine
        if ((in_fn == '' && in_ln == '') || (in_category == '' || in_day == ''
            || in_month == '' || in_year == '') || (in_phone == '' && in_email == '')) {

            alert("Väljad täitmata!");

        // sünnikuupäeva kontroll
    } else if (checkBirthdate(in_day, in_month, in_year) == false) {

            alert("Vigane sünnikuupäev!")
            
        } else {
            $.ajax({
                    url:"../main/main_page.php",
                    method:"POST",
                    data:{
                        action:'add-contact',
                        csrf_token: csrf_token,
                        fn:in_fn,
                        ln:in_ln,
                        date:in_date,
                        category:in_category,
                        phone:in_phone,
                        email:in_email
                },
                dataType:"text",
                success:function(data) {

                    // eduka päringu korral laetakse uuesti kontaktide tabeli
                    // tbody ja vasak menüü list
                    $('#tbody-contacts-list').load('../main/table.php');
                    $('#div-menu-list').load('../main/side_menu.php');
                }
            });

        // pärast postitust tühjendatakse vormi lahtrid
        $('#form-add-contact').trigger("reset");

        // peidekse vormi div ja kuvatakse tabeli div
        configHideShow('#div-table');
        }
    });
});

/**
 * Kustutakse kontakt.
 *
 * @param int c_id Kontakti id väärtus
 *
 * @return boolean
 */
function deleteContact(c_id)
{
    // unikaalne CSRF token
    var csrf_token = $('#csrf_token').val();

    // ajax päringu loomine
    $.ajax({
        url:"../main/main_page.php",
        method:"POST",
        data:{
              action: 'delete-contact',
              csrf_token: csrf_token,
              id: c_id
        },
        dataType:"text",
        success:function(data) {
            // eduka päringu korral laetakse uuesti kontaktide tabeli
            // tbody ja vasak menüü list
            $('#tbody-contacts-list').load('../main/table.php');
            $('#div-menu-list').load('../main/side_menu.php');
        }
    });

    return true;
}

/**
 * Arvutatakse vanus.
 *
 * @param string data Sünnikuupäev
 *
 * @return int years Vanus aastates
 */
function getAge(date)
{
    // eraldatakse sünnikuupäeva stringist päeva, kuu ja aasta väärtus,
    // mille järel teisendatakse need int tüüpi väärtusteks
    var b = date.split('-');
    var bYear = parseInt(b[0]);
    var bMonth = parseInt(b[1]);
    var bDay = parseInt(b[2]);

    // leitakse hetkeaja päeva, kuu ja aasta väärtus
    var currentTime = new Date();
    var nYear = currentTime.getFullYear();
    var nMonth = currentTime.getMonth();
    var nDay = currentTime.getDate();

    // arvutatakse hetke- ja sünniaja parameetrite vahed
    var years = nYear - bYear;
    var months = nMonth - bMonth;
    var days = nDay - bDay;

    // kontrollitakse, kas aastate vahe peaks jääma samaks või olema ühe võrra
    // väiksem, vastalt sellele, kas sünnipäev on hetkeaastas veel tulevikus
    // või mitte
    if(months + 1 < 0 || (months + 1 === 0 && days < 0)) {
        return years - 1;
    } else {
        return years;
    }
}

/**
 * Kontrollitakse sünnikuupäeva korrektsust
 *
 * @param int day Sünnipäev
 *        int month Sünnikuu
 *        int year Sünniaasta
 *
 * @return boolean
 */
function checkBirthdate(day, month, year)
{
    var currentTime = new Date();
    // massiiv kuudest, milles on 30 päeva
    var months30 = [4, 6, 9, 11];

    // ajaühikute suuruse pädevuse kontroll
    if(day < 0 || month < 0 || year < 1916 || month > 12 || year > currentTime.getFullYear()) {
        return false;

    // maksimaalse päeva numbti kontoll kuus
    } else if (day == 31 && $.inArray(month, months30)) {
        return false;

    // 29. veebruari kontroll
    } else if (month == 2 && year%4 != 0 && day > 28) {
        return false;
    } else {
        return true;
    }
}
