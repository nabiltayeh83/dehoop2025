
$("#closeAlert").click(function(){
    hideAlert();
});
function showAlert(msg, status) {
    var alert = $('#alert');
    alert.removeClass();
    alert.addClass("alert show alert-" + status);
    $(".alert-text").html(msg);
    $(".scroll-to-top").click();
}
function hideAlert(){
    var alert = $('#alert');
    alert.removeClass();
    alert.addClass("hide");
}


function showConfirm(title, btn_id ,msg, width) {
    $('#confirm-title').html(title);
    $('#confirm-body').html(msg);
    var footer =
        " <button type='button' class='btn btn-danger' data-bs-dismiss='modal' id='confirmCancel'>Cancel</button>" +
        "<button type='button' class='btn btn-info' id="+btn_id+">Yes</button>";
    $('#confirm-footer').html(footer);
    $("#confirm-dialog").removeClass();
    $("#confirm-dialog").addClass('modal-dialog');
    $("#confirm-dialog").addClass(width);
    $('#myConfirm').modal('show');
}

function hideConfirm(){
    $('#myConfirm').modal('hide');
}


function showMsg(title,msg,status,width){ // show message only
    $("#msg-dialog").removeClass();
    $("#msg-dialog").addClass('modal-dialog');
    $("#msg-dialog").addClass(width);
    if(status == "success")
        var iconClass = "";
    else if(status == "danger")
        var iconClass = "";
    var msgBtn = $("#msgCancelBtn");
    msgBtn.removeClass();
    msgBtn.addClass('btn btn-'+status);
    // msgBtn.;

    $('#msg-title').html(title);
    $('#msg-body').html("<i class='"+iconClass+"' style='font-size: 25px;'></i>  "+msg);
    $('#MyMsg').modal('show');
}

function hideMsg(){
    $('#MyMsg').modal('hide');
}

function hideModal(){
    $("#modalCancel").click();
}




