(function(){ 
    'use strict';

    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    }); 

    $('.additionalImages').click(function(){
        var imagePath = $(this).attr('src');
        $(".listingDetailImage").attr("src", imagePath);
    });

    
    $('.delete').click (function(){
        $(this).closest('tr').remove();
        $.post('../model/deleteListingFromDB.php', {id: this.id}
        ).fail(function (jqxhr) {
            alert(jqxhr.statusText);
        });
    });

}());