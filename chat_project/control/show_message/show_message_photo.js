// modal for uplode

var moda = document.getElementById("uplode-message");

// Get the <span> element that closes the modal
var s = document.getElementById("close_modal_uplode");

// When the user clicks the button, open the modal 
function uplodeImage(e) {

    // set value for input_edit
    moda.style.display = "block";

}

// When the user clicks on <span> (x), close the modal
s.onclick = function () {
    moda.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    console.log(event)
    if (event.target == moda) {
        moda.style.display = "none";
    }
}

// uplode photo

$(document).ready(function () {

    $("#uplode-end").click(function (e) {

        var fd = new FormData();
        var files = $('#uplod')[0].files;

        var IdNow = $.ajax({
            type: "GET",
            url: "../control/show_message/random_id_now.php",
            async: false
        }).responseText;

        var USER_NAME = $.ajax({
            type: "GET",
            url: "../control/USER.php",
            async: false
        }).responseText;

        // Check file selected or not
        if (files.length > 0) {
            fd.append('file', files[0]);

            $.ajax({
                url: '../control/Home/photo_message/uplode_message.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        var image_show = '<div class="image-show bg-green-400" id=' + IdNow + '></div>';
                        var uName = '<span id=' + USER_NAME + '!' + IdNow + ' class="message-show bg-green-400">' + USER_NAME +'</span>'
                        var image_main = '<img id=' + '_' + IdNow + '></img>'
                        var DeleteButton = '<button id="photo-delete">delete</button>'

                        $("#messages").append(image_show);
                        $('#' + IdNow).append(uName);
                        $('#' + IdNow).append(image_main);
                        $('#' + IdNow).append(DeleteButton);

                        var removeModal = document.getElementById("delete_box");

                        // Get the <span> element that closes the modal
                        var spanClose = document.getElementById("close_delete_box");

                        // When the user clicks the button, open the modal 
                        $('#photo-delete').click(function (e) { 
                            removeModal.style.display = "block";
                        });
                        
                        
                        spanClose.onclick = function () {
                            removeModal.style.display = "none";
                        }
                        
                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function (event) {
                            if (event.target == removeModal) {
                                removeModal.style.display = "none";
                            }
                        }
                        $('#remove_image').click(function (e) { 
                            $('#'+IdNow).remove();
                            removeModal.style.display = "none";

                            $.ajax({
                                type: "POST",
                                url: "../control/Home/photo_message/delete_image.php",
                                data: {
                                    id_remove : response.split('/')[2].split('.')[0],
                                }
                            });
                        });
                        
                        var JSON_FILE = $.ajax({
                            type: "GET",
                            url: "../Data/messages/messages.json",
                            async: false
                        }).responseJSON;
                        console.log(JSON_FILE)

                        $('#' + '_' + IdNow).attr("src", '../Data/' + response);
                        $('#uplod').val('');
                        scroll()
                    
                    }else{
                        alert('File not uploaded')
                    }

                },
            });
        } else {
            alert("Please select a file.");
        }
        moda.style.display = "none";
    });
})



var removeModal_old = document.getElementById("delete_box_old");

// Get the <span> element that closes the modal
var spanClose_old = document.getElementById("close_delete_old");

spanClose_old.onclick = function () {
    removeModal_old.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == removeModal_old) {
        removeModal_old.style.display = "none";
    }
}

function DELETE_Image(e) {
    removeModal_old.style.display = "block";
    $('#remove_image_old').click(function () { 
        $.ajax({
            type: "POST",
            url: "../control/Home/photo_message/delete_image_old.php",
            data: {
                id_remove_old: e.value
            }
        });
        $('#'+e.value).remove();
        removeModal_old.style.display = "none";
    });
}

