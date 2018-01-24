/**
 * Created by sameera on 1/24/2018.
 */

function showMsgText(targetRootElementId, targetContentElementId, msg) {
    if (msg == null || msg.trim().length == 0) {
        msg = emptyMessage;
    }
    $('#' + targetContentElementId).html('<p class="error-msg">' + msg + '</p>');
    $('#' + targetRootElementId).show();
}

function clearMsg(targetRootElementId, targetContentElementId) {

    $('#' + targetContentElementId).empty();
    $('#' + targetContentElementId).hide();
}