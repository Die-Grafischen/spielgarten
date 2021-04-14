/**
 * Custom JavaScript
 *
 * @since 1.0.0
 */

jQuery(document).ready(function ($) {
	// slider homepage
	if ($(".block-slider .swiper-wrapper").length) {
		const swiper = new Swiper(".swiper-container", {
			// Optional parameters
			direction: "horizontal",
			loop: true,

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

	// slider on homepage
	if ($(".projekte-wrapper").length) {
		let catName;
		const isoProjekte = $(".projekte-wrapper");

		const swiper = new Swiper(".projekt-slider", {
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
						console.log(bgr);
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
			}
			isoProjekte.isotope({
				filter: "." + catName,
			});
		});

		$("#projekte-cats").on("click", function () {
			$(".projekte-nav").removeClass("cat-view");
		});

		$(".close-projekt").on("click", function () {
			console.log("test");
			$(".single-projekt-view").removeClass("single-projekt-view");
			$(".projekt.active-projekt").removeClass("active-projekt");
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
			$(".team-members > img").fadeOut();

			if ($(this).hasClass("active-member")) {
				$(".team-member.active-member").removeClass("active-member");
			} else {
				$(".team-member.active-member").removeClass("active-member");
				$(this).addClass("active-member");
			}
			isoTeam.isotope("layout");
		});
	}

	//.active-member
});
