


function configHideShow(showDivId) {
    $(showDivId).siblings().hide();
    $('#div-menu-main').show();
    $(showDivId).show();
}


/*function loadProfile(in_id)
{
    //var csrf_token = "<?= $_SESSION['csrf_token']; ?>";

    $.ajax({
        url:"../main/profile.php", // või lihsalt
        method:"POST",
        data:{
            //csrf_token: csrf_token,
            id: in_id
        },
        dataType:"text",
        success:function(data) {
            $('#div-profile-main').html(data);
            //$('#ul-menu-list').load('../main/side_menu.php');
        }
    });

}*/
