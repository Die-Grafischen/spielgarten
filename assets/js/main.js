"use strict";

/**
 * Custom JavaScript
 *
 * @since 1.0.0
 */
jQuery(document).ready(function ($) {
  // slider homepage
  if ($(".block-slider .swiper-wrapper").length) {
    var swiper = new Swiper(".swiper-container", {
      // Optional parameters
      direction: "horizontal",
      loop: true,
      // If we need pagination
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
      // Navigation arrows
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      // And if we need scrollbar
      scrollbar: {
        el: ".swiper-scrollbar"
      }
    });
  } // slider homepage


  if ($(".projekte-wrapper").length) {
    var _swiper = new Swiper(".projekt-slider", {
      // Optional parameters
      direction: "horizontal",
      loop: true,
      slidesPerView: 1,
      // Navigation arrows
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      }
    }); // $(".projekt-slider").on("click", function () {
    // 	if ($(".single-projekt-view").length) {
    // 		isoProjekte.isotope({
    // 			itemSelector: ".projekt",
    // 		});
    // 	} else {
    // 		isoProjekte.isotope("destroy");
    // 	}
    // 	$(".active-projekt").removeClass("active-projekt");
    // 	$(this).parent().toggleClass("active-projekt");
    // 	$(".projekte-wrapper").toggleClass("single-projekt-view");
    // });


    $("#projekte-view").on("click", function () {
      isoProjekte.isotope("destroy");
      $(this).parent().parent().toggleClass("text-view");
      isoProjekte.isotope("reloadItems");
    });
    $("#projekte-dropdown-cat").on("click", function () {
      $(this).parent().toggleClass("cat-view");
    });
    $("#projekte-cats").on("click", function () {
      $("#projekte-dropdown-cat").trigger("click");
    });
    $("#projekte-cats ul li").on("click", function () {
      var cat = $(this).text().toLowerCase();
      var catName = cat.replace(/\s/g, "");
      $("#projekte-current-cat").text($(this).text());
      isoProjekte.isotope({
        filter: "." + catName
      });
    });
    var isoProjekte = $(".projekte-wrapper");
    isoProjekte.isotope({
      // options
      itemSelector: ".projekt"
    });
  }

  if ($(".team-wrapper").length) {
    var isoTeam = $(".team-wrapper");
    isoTeam.isotope({
      // options
      itemSelector: ".team-member",
      layoutMode: "packery"
    });
    $(".team-wrapper").on("click", ".team-member", function () {
      if ($(this).hasClass("active-member")) {
        $(".team-member.active-member").removeClass("active-member");
      } else {
        $(".team-member.active-member").removeClass("active-member");
        $(this).addClass("active-member");
      }

      isoTeam.isotope("layout");
    });
  } //.active-member

});