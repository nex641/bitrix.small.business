jQuery(document).ready(function () {
  //menu
  jQuery(".drop").on("click", function () {
    if (jQuery(this).hasClass("active")) {
      jQuery(this).removeClass("active");
      jQuery(this).text("Развернуть опции");
      jQuery(this).next().slideUp()
    } else {
      jQuery(this).addClass("active");
      jQuery(this).text("Свернуть опции");
      jQuery(this).next().slideDown()
    }
  });
  //menu
  jQuery(".mobile-menu").on("click", function () {
    if (jQuery(this).hasClass("active")) {
      jQuery(this).removeClass("active");
      jQuery("#navi").removeClass("active");
    } else {
      jQuery(this).addClass("active");
      jQuery("#navi").addClass("active");
    }
  });

  //delete product
  jQuery(".delete").click(function () {
    if (jQuery(".delete").length == 1) {
      jQuery(".my-orders").html("Ваша корзина пуста");
    } else {
      jQuery(this).parent().parent().remove();
    }
    total();
    return false;
  })
  jQuery("td .quantity input").on("keyup", function () {
    var cur = jQuery(this).parents("tr").find(".cost-bag span").text() * 1;
    var count = jQuery(this).val() * 1;
    var sum = cur * count;
    sum = sum.toString();

    jQuery(this).parents("tr").find(".sum-bag span").text(sum);
    total();
  });

  counter();
  total();

  $(".various").fancybox({
    maxWidth: 1030,
    maxHeight: 850,
    fitToView: false,
    width: '90%',
    height: '90%',
    autoSize: false,
    closeClick: false,
    padding: [20, 25, 20, 25],
    openEffect: 'none',
    closeEffect: 'none',
    afterShow: function () {
      $('.cusrousel-mini').slick({
        dots: false,
        infinite: false,
        speed: 500,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              centerPadding: '5px',
            }
          }


        ]
      });
      //event slider
      jQuery(".cusrousel-mini a").click(function () {
        if (!jQuery(this).hasClass("active")) {
          jQuery(".cusrousel-mini a").removeClass("active");
          jQuery(this).addClass("active");
          var src = jQuery(this).attr("href");
          jQuery(".big-image img").fadeOut();
          setTimeout(function () {
            jQuery(".big-image img").attr("src", src);
            jQuery(".big-image a").attr("href", src);
          }, 300)
          jQuery(".big-image img").fadeIn();
        }
        return false;
      })
      //buttons
      jQuery(".quantity div").on("click", function () {

        var button = jQuery(this);
        var oldValue = button.parent().find("input").val();

        if (button.text() == "+") {
          var newVal = oldValue * 1 + 1;
        } else {
          // Don't allow decrementing below zero
          if (oldValue > 0) {
            var newVal = oldValue * 1 - 1;
          } else {
            newVal = 0;
          }
        }

        button.parent().find("input").val(newVal);
        jQuery(this).parents(".quantity").find("input").trigger("keyup")
      });
    }
  });
  //fancy
  jQuery(".fancy").fancybox({
    openEffect: 'none',
    closeEffect: 'none',
    helpers: {
      overlay: {
        locked: false
      }
    }
  })
  $('a.fancy').zoom();
  //tabs
  jQuery(".tab-list li a").click(function () {
    if (!jQuery(this).parent().hasClass("active")) {
      jQuery(this).parents(".tab-list").find("li").removeClass("active");
      jQuery(this).parent().addClass("active");
      var tabBox = jQuery(this).attr("href");
      jQuery(this).parents(".tab-list").next().find(".tab").hide()
      jQuery(tabBox).show();
    }
    return false;
  });
  $('.cusrousel-mini').slick({
    dots: false,
    infinite: false,
    speed: 500,
    slidesToShow: 5,
    slidesToScroll: 5,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          centerPadding: '5px',
        }
      }


    ]
  });
  //event slider
  jQuery(".cusrousel-mini a").click(function () {
    if (!jQuery(this).hasClass("active")) {
      jQuery(".cusrousel-mini a").removeClass("active");
      jQuery(this).addClass("active");
      var src = jQuery(this).attr("href");
      jQuery(".big-image img").fadeOut();
      setTimeout(function () {
        jQuery(".big-image img").attr("src", src);
        jQuery(".big-image a").attr("href", src);
      }, 300)
      jQuery(".big-image img").fadeIn();
    }
    return false;
  })
  //buttons
  jQuery(".quantity div").on("click", function () {

    var button = jQuery(this);
    var oldValue = button.parent().find("input").val();

    if (button.text() == "+") {
      var newVal = oldValue * 1 + 1;
    } else {
      // Don't allow decrementing below zero
      if (oldValue > 0) {
        var newVal = oldValue * 1 - 1;
      } else {
        newVal = 0;
      }
    }

    button.parent().find("input").val(newVal);
    jQuery(this).parents(".quantity").find("input").trigger("keyup")
  });

  //put your scripts here
  $(".color-filter li").on("click", function () {
    if ($(this).hasClass("active")) {
      jQuery(this).removeClass("active");

    } else {
      jQuery(this).addClass("active");

    }
    jQuery(".result").fadeIn();
  })
  $(".result").on("click", function () {
    jQuery(".result").fadeOut();
  });
  $(".down").on("click", function () {
    jQuery("html, body").animate({ scrollTop: 0 }, 1000);
    return false;
  });
  $('.carousel').flexslider({
    controlNav: false,

  });

  $('.goods-slider').flexslider({
    controlNav: false,
    slideshow: false,
  });

  $("#slider-range").slider({
    range: true,
    min: 1000,
    max: 10800,
    values: [2290, 7800],
    slide: function (event, ui) {
      $(".range-min").text(ui.values[0]);
      $(".range-max").text(ui.values[1]);
    }
  });
  $(".range-min").text($("#slider-range").slider("values", 0));
  $(".range-max").text($("#slider-range").slider("values", 1));

});

jQuery(window).load(function () {
  setEqualMinHeight(jQuery(".goods"));

})
jQuery(window).resize(function () {
  setEqualMinHeight(jQuery(".goods"));

})

function total() {
  var total = 0;
  jQuery(".sum-bag span").each(function () {
    var s = jQuery(this).text().replace(' ', '') * 1;
    total += Number(s);
  })
  total = total.toString();
  jQuery(".total-n span").text(total);
}
function counter() {
  jQuery(".quantity input").each(function () {
    var cur = jQuery(this).parents("tr").find(".cost-bag span").text() * 1;
    var count = jQuery(this).val() * 1;
    var sum = cur * count;

    sum = sum.toString();
    jQuery(this).parents("tr").find(".sum-bag span").text(sum);
  });

}




// EqualHeight
function setEqualMinHeight(columns) {
  var tallestcolumn = 0;
  columns.each(function () {
    jQuery(this).css({ "height": "auto" });
    currentHeight = jQuery(this).find(".goods-inner").height();
    if (currentHeight > tallestcolumn) {
      tallestcolumn = currentHeight;
    }
  });
  columns.css({ height: tallestcolumn });
}
