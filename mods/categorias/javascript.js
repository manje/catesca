$( document ).ready(function() {

  tinyMCE.init({    mode : "textareas",
     menubar : false,
     theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,jqueryspellchecker",
     theme_advanced_buttons2 : "",
     theme_advanced_buttons3 : "",
     theme_advanced_toolbar_location : "top",
     theme_advanced_toolbar_align : "left",
     theme_advanced_statusbar_location : "bottom",
     theme_advanced_resizing : true
  
   });  

    //Handles menu drop down
        $('.dropdown-menu').find('form').click(function (e) {
                e.stopPropagation();
                    });


  $('#listcategorias').change(function () {
    c=$("#listcategorias").val();
    $(".txtdeunacategoria").hide();
    $("#cat"+c).show();
  });


});

