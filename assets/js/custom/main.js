/**
 * Custom JavaScript
 *
 * @since 1.0.0
 */

jQuery(document).ready(function ($) {
	//mobile menu modifications
	if (screen.width < 800) {
		$("#menu-mobile-menu").on(
			"click",
			".menu-item-has-children > a",
			function (event) {
				event.preventDefault();
				$(this).next(".sub-menu").slideToggle();
			}
		);
	}

	// slider homepage
	if ($(".home .wp-block-columns").length && screen.width < 600) {
		$(".home .wp-block-columns p:first-of-type")
			.next()
			.after('<p class="mobile-more">Weiterlesen</p>')
			.nextAll()
			.addClass("hide-mobile");

		$(".home .wp-block-columns .wp-block-column:nth-child(2)").addClass(
			"hide-mobile"
		);

		$(".home .wp-block-columns").on("click", ".mobile-more", function () {
			$(".hide-mobile").slideToggle();
		});
	}

	if ($(".block-slider .swiper-wrapper").length) {
		if (screen.width < 800) {
			const swiperHomeMobile = new Swiper(".swiper-container", {
				// Optional parameters
				direction: "horizontal",
				loop: true,
				slidesPerView: 1,
				autoplay: {
					delay: 4000,
				},
				speed: 600,

				// If we need pagination
				pagination: {
					el: ".swiper-pagination",
					clickable: true,
				},

				// Navigation arrows
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
		} else {
			const swiperHome = new Swiper(".swiper-container", {
				// Optional parameters
				direction: "horizontal",
				loop: true,
				slidesPerView: 1,

				// If we need pagination
				pagination: {
					el: ".swiper-pagination",
					clickable: true,
				},

				// Navigation arrows
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
		}
	}

	let catName = "alleprojekte";

	// slider on projekte
	if ($(".projekte-wrapper").length) {
		const isoProjekte = $(".projekte-wrapper");

		const swiperProjekte = new Swiper(".projekt-slider", {
			// Optional parameters
			direction: "horizontal",
			loop: true,
			slidesPerView: 1,
			// Navigation arrows
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		});

		isoProjekte.isotope({
			// options
			itemSelector: ".projekt",
		});

		$(".projekt-slide").on("click", function () {
			const projekt = $(this);

			if ($(".active-projekt").length) {
			} else {
				isoProjekte.isotope("destroy");
				projekt.parent().parent().parent().toggleClass("active-projekt");
				$(".projekte").toggleClass("single-projekt-view");

				projekt
					.parent()
					.parent()
					.parent()
					.find(".projekt-foto")
					.each(function () {
						const bgr = "url(" + $(this).data("foto") + ")";
						$(this).css("background-image", bgr);
					});
			}
		});

		$("#grid-view").on("click", function () {
			$(".active-icon").removeClass("active-icon");
			$(this).addClass("active-icon");
			$(".projekte").removeClass("text-view").addClass("grid-view");
			isoProjekte.isotope("layout");
		});

		$("#text-view").on("click", function () {
			$(".active-icon").removeClass("active-icon");
			$(this).addClass("active-icon");
			$(".projekte").removeClass("grid-view").addClass("text-view");
			isoProjekte.isotope("layout");
		});

		$("#projekte-filter").on("click", function () {
			$(".projekte-nav").addClass("cat-view");
		});

		$("#projekte-cats ul li").on("click", function () {
			const cat = $(this).text().toLowerCase();
			catName = cat.replace(/\s/g, "");

			if (!(catName === "alleprojekte")) {
				$("#projekte-current-cat")
					.addClass("active-filter")
					.text($(this).text());
			} else {
				$("#projekte-current-cat").removeClass("active-filter").text("");
			}
			isoProjekte.isotope({
				filter: "." + catName,
			});
		});

		$("#projekte-cats").on("click", function () {
			$(".projekte-nav").removeClass("cat-view");
		});

		$(".projekte .close, .projekt-category span.projekt-back").on(
			"click",
			function () {
				$(".single-projekt-view").removeClass("single-projekt-view");
				$(".projekt.active-projekt").removeClass("active-projekt");
				isoProjekte.isotope({
					filter: "." + catName,
				});
			}
		);

		$(".projekt-category span.projekt-ca").on("click", function () {
			$(".single-projekt-view").removeClass("single-projekt-view");
			$(".projekt.active-projekt").removeClass("active-projekt");
			var currentCat = $(this).attr("data-ca");

			$("#projekte-current-cat").addClass("active-filter").text(currentCat);

			isoProjekte.isotope({
				filter: "." + currentCat.toLowerCase(),
			});
		});
	}

	if ($(".team-wrapper").length) {
		const isoTeam = $(".team-wrapper");
		isoTeam.isotope({
			// options
			itemSelector: ".team-member",
			layoutMode: "packery",
		});

		$(".team-wrapper").on("click", ".team-member", function () {
			let th = this;
			$(".team-members > img").fadeOut();

			if ($(this).hasClass("active-member")) {
				$(".team-member.active-member").removeClass("active-member");
				$(".team-members > img").fadeIn();
			} else {
				$(".team-member.active-member").removeClass("active-member");
				$(this).addClass("active-member");
			}
			isoTeam.isotope("layout");
		});
	}

	$("#nav-toggle").on("click", function () {
		if ($("body").hasClass("active-nav")) {
			$("body").removeClass("active-nav");
			$("#nav-toggle").removeClass("active");
		} else if ($("body").hasClass("active-search")) {
			$("#search-overlay").fadeToggle();
			$("body").removeClass("active-search");
			$("#nav-toggle").removeClass("active");
		} else {
			$("body").addClass("active-nav");
			$("#nav-toggle").addClass("active");
		}
	});

	// move sub logo after slider on mobile
	if (
		$(".home .block-slider").length &&
		$(".home .alt-logo").length &&
		$(window).width() < 769
	) {
		$(".alt-logo").insertAfter(".swiper-wrapper");
	}

	// move slogan in slider on mobile
	if (
		$(".home .block-slider").length &&
		$(".home #sub-title").length &&
		$(window).width() < 769
	) {
		$(".swiper-text, .swiper-link").remove();
		$("#sub-title")
			.appendTo(".swiper-slide")
			.wrap('<div class="swiper-text"></div>');

		const pagginationTop = $(".swiper-wrapper").height() - 40;
		$(".swiper-pagination").css({
			top: pagginationTop,
			bottom: "auto",
			opacity: 1,
		});
	}
});

//scroll to top for projects
document.querySelectorAll(".to-the-top svg").forEach(function (arrow) {
	arrow.addEventListener("click", function () {
		window.scrollTo({ top: 0, behavior: "smooth" });
	});
});
