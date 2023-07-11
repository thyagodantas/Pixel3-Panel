$(function() {

    $(function () {
        $(".open-menu").click(function (e) {
          var listaMenu = $("nav.menu ul");
          e.preventDefault();
      
          if (listaMenu.is(":hidden") == true) {
            //fa-solid fa-bars
            //fa-solid fa-x
            var icone = $(".user-menu").find("i");
            icone.removeClass("fa-square-arrow-down");
            icone.addClass("fa-square-arrow-up");
            listaMenu.slideToggle();
          } else {
            var icone = $(".user-menu").find("i");
            icone.removeClass("fa-square-arrow-up");
            icone.addClass("fa-square-arrow-down");
            listaMenu.slideToggle();
          }
        });
      });
      
    
})