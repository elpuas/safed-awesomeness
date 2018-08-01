jQuery(document).ready(function($){

    // Check if Element Exist in the DOM
    $.fn.exists = function(callback) {
        var args = [].slice.call(arguments, 1);
      
        if (this.length) {
          callback.call(this, args);
        }
      
        return this;
    };

    $('.page-business-driving-records-online .button_wrapper').exists(function(){
        this.appendTo('.page-business-driving-records-online section .usa-grid');
    })

    $('.single-post .button-wrapper').exists( function(){
        this.appendTo('.single-post section .usa-grid');

    });

    console.log("%c Made with  💖 and a lot of  ☕ by el.puas | https://elpuas.com ", "color:#fff;background:gold;");
});