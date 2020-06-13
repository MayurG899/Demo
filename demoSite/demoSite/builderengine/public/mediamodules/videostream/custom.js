$(document).ready(function() {
    var genreSliders = $(".genreSliders");
    genreSliders.owlCarousel({
        autoPlay: false,
        stopOnHover: true,
        navigation: true,
		responsive:true,
		navigationText: ["<i class='fa fa-chevron-left fa-3x'></i>", "<i class='fa fa-chevron-right fa-3x'></i>"],

    });
    var testSlider = $("#testSlider");
    testSlider.owlCarousel({
        autoPlay: true,
        stopOnHover: true,
        navigation: true,
        itemsCustom: [
            [0, 1],
            [450, 1],
            [600, 2],
            [700, 3],
            [1000, 4],
            [1200, 5],
            [1400, 5],
            [1600, 5]
        ],
    });
    var firstRow = $("#owl-firstRow");
    firstRow.owlCarousel({
        autoPlay: true,
        stopOnHover: true,
        navigation: true,
        itemsCustom: [
            [0, 1],
            [450, 1],
            [600, 2],
            [700, 3],
            [1000, 4],
            [1200, 5],
            [1400, 5],
            [1600, 5]
        ],
    });
    var xsItemPage = $("#owl-main-item-xs");
    xsItemPage.owlCarousel({
        autoPlay: true,
        stopOnHover: true,
        navigation: true,
        navigationText: ["<i class='fa fa-chevron-left fa-3x'></i>", "<i class='fa fa-chevron-right fa-3x'></i>"],
        itemsCustom: [
            [0, 1],
            [450, 1],
            [600, 1],
            [700, 1],
            [1000, 1],
            [1200, 5],
            [1400, 5],
            [1600, 5]
        ],
    });
    var secondRow = $("#owl-secondRow");
    secondRow.owlCarousel({
        autoPlay: true,
        stopOnHover: true,
        navigation: true,
        itemsCustom: [
            [0, 1],
            [450, 1],
            [600, 2],
            [700, 3],
            [1000, 4],
            [1200, 5],
            [1400, 5],
            [1600, 5]
        ],
    });
    var thirdRow = $("#owl-thirdRow");
    thirdRow.owlCarousel({
        autoPlay: true,
        stopOnHover: true,
        navigation: true,
        itemsCustom: [
            [0, 1],
            [450, 1],
            [600, 2],
            [700, 3],
            [1000, 4],
            [1200, 5],
            [1400, 5],
            [1600, 5]
        ],
    });
});