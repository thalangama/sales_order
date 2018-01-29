/**
 * Created by sameera on 1/24/2018.
 */

function showMsgSuccess( msg ) {
    if (msg == null || msg.trim().length == 0) {
        msg = '';
    }
    $('#msg-area').html('<p class="success-msg">' + msg + '</p>');
    $('#msg-area').show();
}

function showMsgError( msg ) {
    if (msg == null || msg.trim().length == 0) {
        msg = '';
    }
    $('#msg-area').html('<p class="error-msg">' + msg + '</p>');
    $('#msg-area').show();
}

function clearMsg() {

    $('#msg-area').empty();
    $('#msg-area').hide();
}