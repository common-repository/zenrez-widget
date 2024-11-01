(function ( $ ) {
    
    $(document).ready(function() {
        var buttonColor = $("[id = 'zenrez-input-color-dropdown']");
        var buttonBackgroundColor = $("[id = 'zenrez-input-background-color-dropdown']");
        var descriptionColor = $("[id = 'zenrez-input-description-color-dropdown']");
        var titleColor = $("[id = 'zenrez-input-title-color-dropdown']");
        
        buttonColor.click(function () {
            $("[id = 'zenrez-button-color-picker']").toggle();
        });
        buttonBackgroundColor.click(function () {
            $("[id = 'zenrez-button-background-color-picker']").toggle();
        });
        descriptionColor.click(function () {
            $("[id = 'zenrez-description-color-picker']").toggle();
        });
        titleColor.click(function () {
            $("[id = 'zenrez-title-color-picker']").toggle();
        });
    });

}) ( jQuery );


