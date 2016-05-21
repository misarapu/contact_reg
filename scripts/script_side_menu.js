


function configHideShow(showDivId) {
    $(showDivId).siblings().hide();
    $('#div-menu-main').show();
    $(showDivId).show();
}


function loadProfile(in_id)
{
    console.log(in_id + " js");
    console.log("loadprofile klikk");

    $.ajax({
        url:"../main/profile.php", // või lihsalt
        method:"POST",
        data:{
            id: in_id
        },
        dataType:"text",
        success:function(data) {
            $('#div-profile-main').html(data);
            //$('#ul-menu-list').load('../main/side_menu.php');
        }
    });

}
