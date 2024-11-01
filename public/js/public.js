(function ( $ ) {
    
    $(document).ready(function() {
        var name =$("[id = 'zenrez-first-name-form']")[0].value = "";
        var lastName = $("[id = 'zenrez-last-name-form']")[0].value = "";
        var email = $("[id = 'zenrez-email-form']")[0].value = "";
        var button = $("[id = 'zenrez-button-form']");
        var descriptionWidget = $("[id = 'zenrez-title-form']");
        var titleWidget = $("[id = 'zenrez-description-form']");
        var descriptionShortcode = $("[id = 'zenrez-title-shortcode']");
        var titleShortcode = $("[id = 'zenrez-description-shortcode']");

        if(descriptionWidget[0].value===""){
            descriptionWidget.hide();
        }

        if(descriptionShortcode[0].value===""){
            descriptionShortcode.hide();
        }

        if(titleWidget[0].value===""){
            titleWidget.hide();
        }

        if(titleShortcode[0].value===""){
            titleShortcode.hide();
        }
    });

}) ( jQuery );

