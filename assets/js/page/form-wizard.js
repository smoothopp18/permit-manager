'use strict';
$(function () {
    console.log('hello world');
    //Horizontal form basic
    $('#wizard_horizontal').steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        onInit: function (event, currentIndex) {
            console.log("we here: " + currentIndex);
            setButtonWavesEffect(event);
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            console.log("we here: " + currentIndex);
            setButtonWavesEffect(event);
        },

        onFinished: function () {
            $('#businessCertificateForm').submit();
          }
    });

});

function setButtonWavesEffect(event) {
    $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
    $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
}


