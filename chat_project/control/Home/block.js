function User_block(e){
    const val_block = e.value;
    $.ajax({
        type: "POST",
        url: "../control/Block_user/BLOCK_USER.php",
        data: {
            block_name: val_block,
        },
        
    })

}

function User_unblock(e) {
    var UserName = $.ajax({
        type: "POST",
        url: "../control/Block_user/Unblock_user.php",
        data:{
            un_block_name: e.value 
        }
    });

    
}

$(document).ready(function () {
    var Users_Block = $.ajax({
        type: "GET",
        url: "../Data/users/users.json",
        async: false
    }).responseJSON;

    var username_block = $.ajax({
            type: "GET",
            url: "../control/USER.php",
            async: false
    }).responseText;

    var Users_Block_array = Object.entries(Users_Block)

    for (i of Users_Block_array) {
        console.log(i[1]['block']);
        if (i[0] === username_block && i[1]['block'] === true) {
            $( "#btn-submit" ).prop( "disabled", true);
            $("#message").prop( "disabled", true);
            $("#image_uplode_btn").prop( "disabled", true);
            break;
        }else{
            $( "#btn-submit" ).prop( "disabled", false);
            $("#message").prop( "disabled", false);
            $("#image_uplode_btn").prop( "disabled", false);

        }
    }

});

