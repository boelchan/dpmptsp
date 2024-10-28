/*
Template Name: SNAIL - Creative Agency & Portfolio Templates
Author: Vipul Patel
Website: https://www.chetsapp.com/
Contact: vipul@chetsapp.com
File: owl carousel init js
*/

"use strict";
$.fn.hasAttr = function(name) {  
    return this.attr(name) !== undefined;
};

$('.common-owl-carousel').each(function() {
    var loop = true;
    var mobile_view = 1;
    var tablet_view = 2;
    var laptop_view = 4;
    var main_view = 4;
    var auto_play = true;
    var stage_padding = 0;
    var margin = 10;
    var animate_out = 'fadeOut';
    var animate_in = 'fadeIn';
    var dots = false;
    var nav = true;
    var smart_speed = 1000;
    var center = false;

    if($(this).hasAttr('data-loop')) {
        loop = $(this).data('loop');
    }

    if($(this).hasAttr('data-mobile-view')) {
        mobile_view = $(this).data('mobile-view');
    }

    if($(this).hasAttr('data-tablet-view')) {
        tablet_view = $(this).data('tablet-view');
    }

    if($(this).hasAttr('data-laptop-view')) {
        laptop_view = $(this).data('laptop-view');
    }

    if($(this).hasAttr('data-main-view')) {
        main_view = $(this).data('main-view');
    }

    if($(this).hasAttr('data-auto-paly')) {
        auto_play = $(this).data('auto-paly');
    }

    if($(this).hasAttr('data-stage-padding')) {
        stage_padding = $(this).data('stage-padding');
    }

    if($(this).hasAttr('data-margin')) {
        margin = $(this).data('margin');
    }

    if($(this).hasAttr('data-animate-out')) {
        animate_out = $(this).data('animate-out');
    }

    if($(this).hasAttr('data-animate-in')) {
        animate_in = $(this).data('animate-in');
    }

    if($(this).hasAttr('data-dots')) {
        dots = $(this).data('dots');
    }

    if($(this).hasAttr('data-nav')) {
        nav = $(this).data('nav');
    }

    if($(this).hasAttr('data-smart-speed')) {
        smart_speed = $(this).data('smart-speed');
    }

    if($(this).hasAttr('data-center')) {
        center = $(this).data('center');
    }

    $(this).owlCarousel({
        loop: loop,
        stagePadding: stage_padding,
        margin: margin,
        autoplay: auto_play,
        animateOut: animate_out,
        animateIn: animate_in,
        dots: dots,
        nav: nav,
        smartSpeed: smart_speed,
        center: center,
        responsive: {
            0: {
                items: mobile_view
            },
            768: {
                items: tablet_view
            },
            1190: {
                items: laptop_view
            },
            1380: {
                items: main_view
            }
        },
        navText: ['<span class="ti-arrow-left">', '<span class="ti-arrow-right">'],
    });
});