/*
Template Name: SNAIL - Creative Agency & Portfolio Templates
Author: Vipul Patel
Website: https://www.chetsapp.com/
Contact: vipul@chetsapp.com
File: Cube Portfolio init js
*/

"use strict";
jQuery('#js-grid-mosaic').cubeportfolio({
    filters: '#js-filters-mosaic',
    layoutMode: 'grid',
    sortByDimension: true,
    mediaQueries: [{
        width: 1500,
        cols: 2,
    }, {
        width: 1100,
        cols: 2,
    }, {
        width: 768,
        cols: 1,
    }, {
        width: 480,
        cols: 1,
        options: {
            gapHorizontal: 60
        }
    }],
    defaultFilter: '*',
    animationType: 'fadeOut',
    gapHorizontal: 50,
    gapVertical: 50,
    gridAdjustment: 'responsive',
    caption: 'zoom',
    lightboxDelegate: '.cbp-lightbox',
    lightboxGallery: true,
    lightboxTitleSrc: 'data-title',
    lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',

    plugins: {
        loadMore: {
            element: "#js-loadMore-lightbox-gallery",
            action: "click",
            loadItems: 5,
        }
    }

})
.on('initComplete.cbp', function () {
    // your functionality
    var $this = $(this);
    if ($(".cbp-filter-item-active").attr("data-filter") === "*") {
        $("#js-loadMore-lightbox-gallery").addClass("active");
    } else {
        $("#js-loadMore-lightbox-gallery").removeClass("active");
    }
    $this.find(".cbp-wrapper").find(".cbp-item:not(.cbp-item-off)").each(function (index) {
        $(this).removeClass("even");
        var val = index + 1;
        if ($(this).css('left') !== "0px") {
            $(this).addClass("even");

        }
    });
})
.on('onAfterLoadMore.cbp', function () {
    // your functionality
    var $this = $(this);
    $("#js-loadMore-lightbox-gallery a").addClass("d-none");
    $("#js-loadMore-lightbox-gallery").addClass("active-outer");
    $this.find(".cbp-wrapper").find(".cbp-item:not(.cbp-item-off)").each(function (index) {
        $(this).removeClass("even");
        var val = index + 1;
        if ($(this).css('left') !== "0px") {
            $(this).addClass("even");
        }
    });
})
.on('filterComplete.cbp', function () {
    // your functionality
    var $this = $(this);
    if ($(".cbp-filter-item-active").attr("data-filter") === "*") {
        $("#js-loadMore-lightbox-gallery").addClass("active");
        $("#js-loadMore-lightbox-gallery").removeClass("d-none");
    } else {
        $("#js-loadMore-lightbox-gallery").removeClass("active");
        $("#js-loadMore-lightbox-gallery").addClass("d-none");
    }
    $this.find(".cbp-wrapper").find(".cbp-item:not(.cbp-item-off)").each(function (index) {
        $(this).removeClass("even");
        var val = index + 1;
        if ($(this).css('left') !== "0px") {
            $(this).addClass("even");
        }
    });
});