;(function ($) {
    "use strict";

    // Prevent global conflict
    if (typeof window.yesno != 'undefined') {
        return;
    }

    window.yesno = {
        /**
         * Init
         *
         */
        init: function()
        {

        },

        registerDialogs: function(dialog, showDialogButton){
            if (! dialog.showModal) {
                dialogPolyfill.registerDialog(dialog);
            }
            showDialogButton.addEventListener('click', function() {
                dialog.showModal();
            });
            //dialog.querySelector('.close').addEventListener('click', openDialog());

            // ajax onclick event
            $(dialog).find('.mdl-button-yes').on('click', {dialog: dialog, answer: 'yes'}, voteSubmit);
            $(dialog).find('.mdl-button-no').on('click', {dialog: dialog, answer: 'no'}, voteSubmit);
            $(dialog).find('.mdl-button-maybe').on('click', {dialog: dialog, answer: 'maybe'}, voteSubmit);
        },

        openDialog: function(){
            dialog.close();
        },

    }
})(jQuery);
