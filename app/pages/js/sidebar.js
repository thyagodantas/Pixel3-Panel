$(function () {
  var open = true;
  var windowSize = $(window)[0].innerWidth;

  var targetSizeMenu = windowSize < 500 ? 200 : 250;

  if (windowSize <= 768) {
    $(".sidebar").css("width", "0");
    open = false;
  }

  $(".menu-btn").click(function () {
    if (open) {
      $(".sidebar").animate({ width: "0" }, function () {
        open = false;
      });
      $(".content, header").css("width", "100%");
      $(".content, header").animate({ left: "0" }, function () {
        open = false;
      });
    } else {
      $(".sidebar").css("display", "block");
      if (windowSize <= 768) {
        $(".sidebar").animate({ width: targetSizeMenu + "px" }, function () {
          open = true;
        });
        $(".content, header").animate(
          { left: targetSizeMenu + "px" },
          function () {
            open = true;
          }
        );
      } else {
        $(".sidebar").animate({ width: targetSizeMenu + "px" }, function () {
          open = true;
        });
        $(".content, header").css("width", "calc(100% - 250px)");
        $(".content, header").animate(
          { left: targetSizeMenu + "px" },
          function () {
            open = true;
          }
        );
      }
    }
  });

  $(window).resize(function () {
    windowSize = $(window)[0].innerWidth;
    targetSizeMenu = windowSize <= 400 ? 250 : 200;
    if (windowSize <= 768) {
      $(".sidebar").css("width", "0");
      $(".content, header").css("width", "100%").css("left", "0");
      open = false;
    } else {
      $(".sidebar").animate({ width: targetSizeMenu + "px" }, function () {
        open = true;
      });

      $(".content, header").css("width", "calc(100% - 250px)");
      $(".content, header").animate(
        { left: targetSizeMenu + "px" },
        function () {
          open = true;
        }
      );
    }
  });
});
