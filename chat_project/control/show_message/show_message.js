function limit(e)
{
    if ($('#message').val().length+1 >= 100) {
        $( "#btn-submit" ).prop( "disabled", true);
        $("#message").addClass('limit_char');
    }else{
        $( "#btn-submit" ).prop( "disabled", false);
        $("#message").removeClass('limit_char');

    }
}


function scroll() {
    $('#main-chat').scrollTop($('#main-chat').prop("scrollHeight"));
}

$(document).ready(function () {
    scroll()

    setInterval(() => {
        $('#messages').load(document.URL +  ' #messages');
    }, 1000);
    

    $("#btn-submit").click(function() { 
        var message = $("#message").val();
        // get user name for show in chatt room
        var user = $.ajax({
            type: "GET",
            url: "../control/USER.php",
            async: false
        }).responseText;
        username = user.replace(/\"/g,'')

        // get random id for divs and buttons
        var id = $.ajax({
            type: "GET",
            url: "../control/show_message/random_id_now.php",
            async: false
        }).responseText;
        

        // send message for save in JSON FILE
        var data = {
            'message': message
        }
        $.post("../control/Home/home.php", data);
        
        // get json file key for add attrbiute value to buttons
        var json_response = $.ajax({
            type: "GET",
            url: "../Data/messages/messages.json",
            async: false
        }).responseJSON;

        for (key in json_response) {
            var value = key
        }
        
        // creat daivs and buttons
        var divShow = '<div class="text_show bg-green-400" id='+id+'>'+'<span class="main-text-message text-white" id='+'0'+id+'>'+username+' '+':'+' '+ message+'</span>'+'</div>';
        var btn = '<button onclick="remove_li(this)" id='+'_'+id+' value='+value+'>'+'<svg class="h-4 w-4 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>'+
        '</svg>'
      +'</button>'
        var btnEdit = '<button onclick="edit_li(this)" id='+'!'+id+' value='+value+'>'
        +'<svg class="h-4 w-4 text-blue-500"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
        '<path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />  <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />'
        +'<line x1="16" y1="5" x2="19" y2="8" /></svg>'+'</button>'
        $("#messages").append(divShow);
        $('#messages #'+id).append(btn);
        $('#messages #'+id).append(btnEdit);
        $('#messages #'+id).addClass("message-show");


        // remove element    
        $("#"+'_'+id).click(function () {
            $('#message #'+id).remove();
            
        });
        $('#message').val('');

        scroll()
        // window.location.reload();


        
    });
    $('#message').keypress(function(e){
    if (e.which == 13){
        $("#btn-submit").click();
    }


    
});

    
});


// creat function for remove message in JSON FILE 
function remove_li(e){
    parent_id =  e.id.replace(/\_/g,'')
    var json_response = $.ajax({
        type: "GET",
        url: "../Data/messages/messages.json",
        async: false
    }).responseJSON;
    console.log(json_response)
    for (var key in json_response) {
        if (key === e.value) {
            var id_2 = key
            break;
        }
        
    }

    $('#'+parent_id).remove();
    $.ajax({
        type: "POST",
        url: "../control/Home/remove_message.php",
        data: {
            id : parent_id,
            id_2: id_2
        }
    });
}

// edit message---------------

var modal = document.getElementById("edit_modal");

// Get the <span> element that closes the modal
var span = document.getElementById("close_modal");

// When the user clicks the button, open the modal 
function edit_li(e) {

    // set value for input_edit
    modal.style.display = "block";
    var parentID = e.id.replace(/!/,"")
    var inner_text = $('#'+parentID).text();
    
    var regex = /(:\s=?).*/
    var b = inner_text.match(regex)[0]

    var id_json = $.ajax({
        type: "GET",
        url: "../Data/messages/messages.json",
        async: false
    }).responseJSON;
    $('#btn-edit').val(e.value); 
    for (var key in id_json) {
        if (key !== parentID) {
            for (var i of Object.values(id_json[key])) {
                if (e.value === key) {
                    $("#edit-text").val(i)
                }
                
            }
            
        }else{
            $("#edit-text").val(b.replace(/\:\s/,""));
            break;
        }
        
    }
    
    // start editing
    $('#btn-edit').click(function () { 

        // get data from JSON FILE
        var json_DATA = $.ajax({
            type: "GET",
            url: "../Data/messages/messages.json",
            async: false
        }).responseJSON;
        for (var key in json_DATA) {
            if (key === e.value && $(this).val() === e.value) {
                // JSON FILE
                var id_js = key

                // home page
                var inner_text = $('#0'+parentID).text();
                var containerTEXT = inner_text.split(':')

                var end_level_1 = containerTEXT[0].replace(/\s/,"")+' : '+$("#edit-text").val()
                break;
            }
        }
        // edit message in home page
        $('#0'+parentID).text(end_level_1);

        // edit message in JSON FILE
        $.ajax({
            type: "POST",
            url: "../control/Home/edit_message.php",
            data: {
                message_edit : $("#edit-text").val(),
                id_js: id_js,
            },
        });

    });
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    console.log(event)
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function save_edit(e) {
    modal.style.display = "none";
}