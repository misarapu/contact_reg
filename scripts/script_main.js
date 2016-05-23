$(document).ready(function()
{
    // dokumendi avanedes laetakse menüü list ja kontaktide tabel
    $('#div-menu-list').load('../main/side_menu.php');
    $('#tbody-contacts-list').load('../main/table.php');

});

/**
 * Peidab kõik div-d peale soovitava mittepeidetava div-i ja main div-i.
 * Tühjendatakse kontakti lisamise vormi lahtrid
 *
 * @param tag showDivId Mitte peidetava div-i id
 *
 */
function configHideShow(showDivId) {
    $("#form-add-contact").trigger('reset');
    $(showDivId).siblings().hide();
    $('#div-menu-main').show();
    $(showDivId).show();
}
