$(document).ready(function() {

	(function ($) {
		"use strict";

		$(window).load(function () {
			// ----------------------------------------------------------------------------------------------------------------------->
			// SITE LOADER                     ||----------- 
			// ----------------------------------------------------------------------------------------------------------------------->
			$('#loader').fadeOut();
			$('#preloader').delay(350).fadeOut('slow');
			$('body').delay(350).css({ 'overflow': 'visible' });
		})
		// ---------------------------------------------------------------------------------------------------------------------------->
		// GENERAL SCRIPTS FOR ALL PAGES    ||----------- 
		// ---------------------------------------------------------------------------------------------------------------------------->
		$(document).ready(function () {
			openSite();

		});

		function openSite() {
			sliderAll();
			containerGridMasonry();
		};
	})(jQuery);
	// ---------------------------------------------------------------------------------------------------------------------------->
	// SLIDER FUNCTIONS   ||-----------
	// ---------------------------------------------------------------------------------------------------------------------------->
	function sliderAll() {

		$('.image-slider').owlCarousel({
			navigation: true,  // Show next and prev buttons
			pagination: true,  // Show pagination buttons
			slideSpeed: 350,
			paginationSpeed: 400,
			singleItem: true,
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			autoPlay: false,
			autoHeight: true,
			responsive: true
		});
	};
	// ---------------------------------------------------------------------------------------------------------------------------->
	// CONTAINER GRID & MESONRY FUNCTIONS (Portfolio, blog, etc)   ||-----------
	// ---------------------------------------------------------------------------------------------------------------------------->
	function containerGridMasonry() {

		// Gria Element
		if ($(this).length > 0) {
			// ISOTOPE MASONRY ELEMENT  ||--------------
			var $container = $('.container-masonry');
			$container.imagesLoaded(function () {
				$container.isotope({
					itemSelector: '.nf-item',
					percentPosition: true, //added
					layoutMode: 'fitRows', //changed instead of 'masonry'
					masonry: {
					//	columnWidth: 0,
					//	gutter: 0
					},
				});
			});
			
			// bind filter button click
			$('.container-filter').on('click', '.categories', function () {
				var filterValue = $(this).attr('data-filter');
				$container.isotope({ filter: filterValue });
			});

			// ISOTOPE GRID ELEMENT  ||--------------
			var $container2 = $('.container-grid');
			$container2.imagesLoaded(function () {
				$container2.isotope({
					itemSelector: '.nf-item',
					layoutMode: 'fitRows'
				});
			});

			// bind filter categories click
			$('.container-filter').on('click', '.categories', function () {
				var filterValue = $(this).attr('data-filter');
				$container2.isotope({ filter: filterValue });
			});

			// change active class on categories
			$('.categories-filter').each(function (i, buttonGroup) {
				var $buttonGroup = $(buttonGroup);
				$buttonGroup.on('click', '.categories', function () {
					$buttonGroup.find('.active').removeClass('active');
					$(this).addClass('active');
				});

			});
		};

		// Masonry Element
		if ($(this).length > 0) {
			var container = $('.masonry');
			container.masonry({
				// columnWidth: 0,
				itemSelector: '.nf-item'
			});
		};
	};
});