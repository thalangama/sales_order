/**
 * Created by sameera on 1/24/2018.
 */

function showMsgText( targetClass, msg) {
    if (msg == null || msg.trim().length == 0) {
        msg = emptyMessage;
    }
    $('#msg-area').html('<p class="'+targetClass+'">' + msg + '</p>');
    $('#msg-area').show();
}

function clearMsg(targetRootElementId, targetContentElementId) {

    $('#msg-area').empty();
    $('#msg-area').hide();
}