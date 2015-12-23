/**
 *  0. Custom
    1.  top Menu
    2.  Main Menu
    3.  Search box
    4.  Accordion
    5.  Toggle
    6.  Owl Carousel
    7.  Sync owl carousel
    8.  Pie chart
    9.  Single-share-filter
    10. Time-filter
    11. Smooth Scrolling
    12. Scroll Slider
    13. Breadking News
    14. Validate Form
    15. Google Map
    16. Masonry
    17. Match height
    18. Mobile-menu

 *-----------------------------------------------------------------
 **/
 

"use strict";

(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
    Drupal.behaviors.kopaTheme = {
        attach: function(context, settings) {

            $(document).ready(function(){

                var kopa_variable = {
                    "contact": {
                        "address": "Lorem ipsum dolor sit amet, consectetur adipiscing elit",
                        "marker": "/url image"
                    },
                    "i18n": {
                        "VIEW": "View",
                        "VIEWS": "Views",
                        "validate": {
                            "form": {
                                "SUBMIT": "Submit",
                                "SENDING": "Sending..."
                            },
                            "name": {
                                "REQUIRED": "Please enter your name",
                                "MINLENGTH": "At least {0} characters required"
                            },
                            "email": {
                                "REQUIRED": "Please enter your email",
                                "EMAIL": "Please enter a valid email"
                            },
                            "url": {
                                "REQUIRED": "Please enter your url",
                                "URL": "Please enter a valid url"
                            },
                            "message": {
                                "REQUIRED": "Please enter a message",
                                "MINLENGTH": "At least {0} characters required"
                            }
                        },
                        "tweets": {
                            "failed": "Sorry, twitter is currently unavailable for this user.",
                            "loading": "Loading tweets..."
                        }
                    },
                    "url": {
                        "template_directory_uri": window.footmali.template_directory
                    }
                };

                var map;


                /* =========================================================
                 0. Custom
                 ============================================================ */
                
                // Mailchimp subscribe popup
                 Modernizr.load([{
                    load: kopa_variable.url.template_directory_uri + 'js/jquery.cookie.js',
                    complete: function () {
                        var showModal = $.cookie('MCEvilPopupClosed');
                        if (showModal === undefined) {
                            $('#mailchimp-modal').modal('show');
                            $.cookie('MCEvilPopupClosed', 'yes', {expires: 30} );
                        }
                    }
                }]);

                /* =========================================================
                 1. top Menu
                 ============================================================ */

                Modernizr.load([
                    {
                        load: kopa_variable.url.template_directory_uri + 'js/superfish.js',
                        complete: function () {

                            //Main menu
                            $('.top-menu').superfish({
                            });

                        }
                    }
                ]);


                /* =========================================================
                 2. Main Menu
                 ============================================================ */

                Modernizr.load([
                    {
                        load: kopa_variable.url.template_directory_uri + 'js/superfish.js',
                        complete: function () {

                            var r_ul = $('.kopa-main-nav .sf-menu');
                            //r_ul.find('> li').each(function() {
                            //    r_ul.prepend(this);
                            //});
                            r_ul.superfish({
                                speed: "fast",
                                delay: "100"
                            });

                            var r_ul2 = $('.kopa-main-nav-2 .sf-menu');
                            //r_ul2.find('> li').each(function() {
                            //    r_ul2.prepend(this);
                            //});

                            r_ul2.superfish({
                                speed: "fast",
                                delay: "100"
                            });

                            $('.header-top-list ul').superfish({
                                speed: "fast",
                                delay: "100"
                            });

                            var r_ul3 = $('.bottom-menu');
                            r_ul3.find('> li').each(function() {
                                r_ul3.prepend(this);
                            });

                            var ba1_h = $('.bottom-area-1').find(".kopa-logo").height();
                            $('.bottom-menu').css("line-height", ba1_h + "px");

                            var p_mr = (ba1_h -31)/2;
                            $('.bottom-nav-mobile').find(".pull").css({
                                "margin-top": p_mr,
                                "margin-bottom": p_mr
                            });
                            var p_h = $('.bottom-nav-mobile').find(".pull").height();
                            var btnav_p = p_mr + p_h + 15;
                            $('.bottom-nav-mobile').find(".bottom-menu-mobile").css({
                                "top": btnav_p
                            });

                        }
                    }
                ]);


                /* =========================================================
                 3. Accordion
                 ============================================================ */

                var panel_titles = $('.kopa-accordion .panel-title a');
                panel_titles.addClass("collapsed");
                $('.panel-heading.active').find(panel_titles).removeClass("collapsed");
                panel_titles.click(function(){
                    $(this).closest('.kopa-accordion').find('.panel-heading').removeClass('active');
                    var pn_heading = $(this).parents('.panel-heading');
                    if ($(this).hasClass('collapsed')) {
                        pn_heading.addClass('active');
                    } else {
                        pn_heading.removeClass('active');
                    }
                });



                /* =========================================================
                 4. Toggle
                 ============================================================ */

                //$('.kopa-toggle .panel-group .collapse').collapse({
                //    toggle: false
                //});
                var panel_titles_2 = $('.kopa-toggle .panel-title a');
                panel_titles_2.click(function(){
                    var parent = $(this).closest('.panel-heading');
                    if (parent.hasClass('active')) {
                        parent.removeClass('active');
                    } else {
                        parent.addClass('active');
                    }
                });

                /* =========================================================
                 5. Owl Carousel
                 ============================================================ */

                Modernizr.load([{
                    load: [ kopa_variable.url.template_directory_uri + 'js/owl.carousel.js'],
                    complete: function () {

                        var owl1 = $(".owl-carousel-1");
                        owl1.owlCarousel({
                            items: 10,
                            itemsDesktopSmall : [979,5],
                            itemsTablet: [799,4],
                            itemsTabletSmall: [639,3],
                            pagination: false,
                            slideSpeed: 600,
                            navigationText: false,
                            navigation: true
                        });

                        var owl2 = $(".owl-carousel-2");
                        owl2.owlCarousel({
                            singleItem: true,
                            pagination: false,
                            slideSpeed: 600,
                            navigationText: false,
                            navigation: true,
                            afterInit: function(){
                                var ow = $(".owl-carousel-2").width();
                                $(".owl-carousel-2").find(".owl-item").width(ow);
                            }
                        });

                        var owl3 = $(".owl-carousel-3");
                        owl3.owlCarousel({
                            singleItem: true,
                            pagination: false,
                            slideSpeed: 600,
                            navigationText: false,
                            navigation: true
                        });

                        var owl4 = $(".owl-carousel-4");
                        owl4.owlCarousel({
                            items : 4,
                            pagination: false,
                            navigationText: false,
                            navigation: true,
                            slideSpeed: 600
                        });

                        var owl5 = $(".owl-carousel-5");
                        owl5.owlCarousel({
                            items : 6,
                            pagination: false,
                            navigationText: false,
                            navigation: true,
                            autoPlay: true,
                            slideSpeed: 600
                        });

                        var owl6 = $(".owl-carousel-6");
                        owl6.owlCarousel({
                            singleItem: true,
                            slideSpeed: 1000,
                            navigation: false,
                            navigationText: false,
                            pagination: true
                        });

                        var owl7 = $(".owl-carousel-7");
                        owl7.owlCarousel({
                            items: 4,
                            itemsTablet: [799,4],
                            itemsTabletSmall: [719,3],
                            slideSpeed: 1000,
                            pagination: false,
                            navigation: true,
                            navigationText: false
                        });

                        var owl8 = $(".owl-carousel-8");
                        owl8.owlCarousel({
                            items: 4,
                            itemsTablet: [799,4],
                            itemsTabletSmall: [718,3],
                            slideSpeed: 1000,
                            pagination: false,
                            navigation: true,
                            navigationText: false
                        });

                        var owl9 = $(".owl-carousel-9");
                        owl9.owlCarousel({
                            items: 3,
                            itemsDesktop: [1160,3],
                            itemsTablet: [799,3],
                            itemsTabletSmall: [639,2],
                            slideSpeed: 1000,
                            pagination: false,
                            navigation: true,
                            navigationText: false
                        });

                        var owl10 = $(".owl-carousel-10");
                        owl10.owlCarousel({
                            singleItem: true,
                            slideSpeed: 1000,
                            navigation: false,
                            navigationText: false,
                            pagination: true,
                            afterInit: function(){
                                $(".kopa-gallery-carousel-widget .loading").hide();
                            }
                        });

                        var owl12 = $(".owl-carousel-12");
                        owl12.owlCarousel({
                            singleItem: true,
                            slideSpeed: 1000,
                            navigation: true,
                            navigationText: false,
                            pagination: false
                        });

                    }
                }]);



                /* =========================================================
                 6. Sync owl carousel
                 ============================================================ */


                if ($('.kopa-sync-carousel-widget').length > 0) {
                    Modernizr.load([{
                        load: kopa_variable.url.template_directory_uri + 'js/owl.carousel.js',
                        complete: function() {
                            var sync1 = $(".kopa-sync-carousel-widget .sync1");

                            sync1.owlCarousel({
                                singleItem: true,
                                slideSpeed: 1000,
                                navigation: true,
                                navigationText: false,
                                pagination: false,
                                responsiveRefreshRate: 200,
                                afterInit: function(){
                                    $(".kopa-sync-carousel-widget .loading").hide();
                                }
                            });
                        }
                    }]);

                };

                if ($('.kopa-sync-carousel-2-widget').length > 0) {
                    Modernizr.load([{
                        load: kopa_variable.url.template_directory_uri + 'js/owl.carousel.js',
                        complete: function() {
                            var sync3 = $(".kopa-sync-carousel-2-widget .sync3");
                            var sync4 = $(".kopa-sync-carousel-2-widget .sync4");

                            sync3.owlCarousel({
                                singleItem: true,
                                slideSpeed: 1000,
                                navigation: false,
                                navigationText: false,
                                pagination: false,
                                afterAction: syncPosition,
                                responsiveRefreshRate: 200,
                                afterInit: function(){
                                    $(".kopa-sync-carousel-2-widget .loading").hide();
                                }
                            });

                            sync4.owlCarousel({
                                items: 4,
                                itemsTablet: [799,3],
                                itemsTabletSmall: [639,2],
                                pagination: false,
                                navigation: true,
                                navigationText: false,
                                responsiveRefreshRate: 100,
                                afterInit: function(el) {
                                    el.find(".owl-item").eq(0).addClass("synced");
                                }
                            });

                            function syncPosition(el) {
                                var current = this.currentItem;
                                $(".sync4").find(".owl-item").removeClass("synced").eq(current).addClass("synced")
                                if ($(".sync4").data("owlCarousel") !== undefined) {
                                    center(current)
                                }
                            }

                            $(".sync4").on("click", ".owl-item", function(e) {
                                e.preventDefault();
                                var number = $(this).data("owlItem");
                                sync3.trigger("owl.goTo", number);
                            });

                            function center(number){

                                var sync4visible = sync4.data("owlCarousel").owl.visibleItems;
                                var num = number;
                                var found = false;
                                for(var i in sync4visible){
                                    if(num === sync4visible[i]){
                                        var found = true;
                                    }
                                }

                                if(found===false){
                                    if (undefined != sync4visible){
                                        if(num > sync4visible[sync4visible.length-1]){
                                            sync4.trigger("owl.goTo", num - sync4visible.length+2)
                                        }else{
                                            if(num - 1 === -1){
                                                num = 0;
                                            }
                                            sync4.trigger("owl.goTo", num);
                                        }
                                    }
                                } else if(num === sync4visible[sync4visible.length-1]){
                                    sync4.trigger("owl.goTo", sync4visible[1])
                                } else if(num === sync4visible[0]){
                                    sync4.trigger("owl.goTo", num-1)
                                }

                            }
                        }
                    }]);

                };


                /* ============================================
                 7. Search box
                 =============================================== */

                var s_title = $('.kopa-search-box > a');
                var s_form = $(".kopa-search-box > .search-form");

                s_title.click(function (e) {
                    e.preventDefault();
                    if (s_form.is(":hidden")) {
                        s_form.slideDown("slow");
                    } else {
                        s_form.slideUp("slow");
                    }
                });

                $('.search-form.custom').submit(function (event) {
                    event.preventDefault();
                    var query = $('.search-text', this).val();

                    window.location.replace('/search/node/' + query);

                });

                /* ============================================
                 9. Single-share-filter
                 =============================================== */

               $(document).on('click', '.post-share-link.closed > span', function (e) {
                    e.preventDefault();
                    var list_s = $(this).closest(".post-share-link").find("ul");

                    if (list_s.is(":hidden")) {
                        list_s.parent('.post-share-link').addClass('opened');
                        list_s.parent('.post-share-link').removeClass('closed');
                        list_s.slideDown("slow");
                    }

                });

                $(document).on('click', '.post-share-link.opened > span', function (e) {
                    e.preventDefault();
                    var list_s = $(this).closest(".post-share-link").find("ul");

                    if(!list_s.is(":hidden") ) {
                        list_s.parent('.post-share-link').addClass('closed');
                        list_s.parent('.post-share-link').removeClass('opened');
                        list_s.slideUp();
                    }

                });

                $(document).click(function(event) {
                    if(!$(event.target).closest('.post-share-link.opened').length) {
                        var opened = $('.post-share-link.opened ul');

                        opened.each(function () {
                            if($(this).is(":visible")) {
                                $(this).parent('.post-share-link').addClass('closed');
                                $(this).parent('.post-share-link').removeClass('opened');
                                $(this).slideUp();
                            }
                        })
                    }
                });


                /* ============================================
                 10. Time-filter
                 =============================================== */

                $('.time-filter > h4').click(function(e) {
                    e.preventDefault();
                    var t_f = $(this).closest(".time-filter").find("ul");
                    if (t_f.is(":hidden")) {
                        t_f.slideDown("slow");
                        $(this).find(".fa-caret-down").removeClass("fa-caret-down").addClass("fa-caret-up");
                    } else {
                        t_f.slideUp();
                        $(this).find(".fa-caret-up").removeClass("fa-caret-up").addClass("fa-caret-down");
                    }
                });

                /* ============================================
                 11. Smooth Scrolling
                 =============================================== */

                $('.time-filter ul li a[href*=#]:not([href=#]), .pr-navigation ul li a[href*=#]:not([href=#])').click(function() {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                        if (target.length) {
                            $('html,body').animate({
                                scrollTop: target.offset().top
                            }, 1000);
                            return false;
                        }
                    }
                });


                /* =========================================================
                 12. Scroll Slider
                 ============================================================ */


                if ($('.scroll-slider').length > 0) {
                    Modernizr.load([
                        {
                            load:[ kopa_variable.url.template_directory_uri + 'js/mCustomScrollbar.js', kopa_variable.url.template_directory_uri + 'js/jquery.mousewheel.min.js'],
                            complete: function () {

                                $(".scroll-slider").each(function() {
                                    var slider = $(this);
                                    var itemList = slider.find("ul");
                                    var prevSlide = slider.find("a.s-prev");
                                    var nextSlide = slider.find("a.s-next");
                                    var pos = 0;
                                    var itemCount = itemList.find("li").length;
                                    slider.find('.loading').fadeOut(function(){$('.loading').remove()});

                                    var w = Math.round((slider.find("ul").width() - 105) / 4);
                                    slider.find(".s-item").width(w);
                                    var h = slider.find(".s-item").height();
                                    slider.height(h + 20);
                                    var W = 0;
                                    slider.find("li").each(function(){
                                        W += $(this).width() + 30;
                                    });
                                    $(".mCSB_container").width(W - 15);

                                    $(window).resize(function() {
                                        var w = Math.round((slider.find("ul").width() - 105) / 4);
                                        slider.find(".s-item").width(w);
                                        var h = slider.find(".s-item").height();
                                        slider.height(h + 20);
                                        var W = 0;
                                        slider.find("li").each(function(){
                                            W += $(this).width() + 30;
                                        });
                                        $(".mCSB_container").width(W - 15);
                                    });


                                    var itemW = w + 30;

                                    itemList.mCustomScrollbar({
                                        horizontalScroll: true,
                                        mouseWheel: true,
                                        autoHideScrollbar: false,
                                        contentTouchScroll: true,
                                        scrollButtons: {
                                            enable: false
                                        },
                                        advanced:{
                                            updateOnContentResize: true,
                                            updateOnBrowserResize: true
                                        }
                                    });

                                    nextSlide.click(function(e){
                                        e.preventDefault();
                                        if(pos < itemCount) {
                                            var offset;
                                            pos++;
                                            offset = (itemW * pos);
                                            itemList.mCustomScrollbar("scrollTo", offset);
                                            if(pos+3 >= itemCount){
                                                pos=itemCount - 4;
                                            }
                                        }

                                    });

                                    prevSlide.click(function(e){
                                        e.preventDefault();
                                        if(pos > 0) {
                                            var offset;
                                            pos--;
                                            offset = itemW * pos;
                                            itemList.mCustomScrollbar("scrollTo", offset);
                                            if(pos - 3 >= itemCount){
                                                pos=0;
                                                offset = itemW * pos;
                                                itemList.mCustomScrollbar("scrollTo", offset);
                                            }
                                        }

                                    });

                                });

                            }
                        }
                    ]);
                };

                /* =========================================================
                 16. Masonry
                 ============================================================ */

                Modernizr.load([{
                    load: [kopa_variable.url.template_directory_uri + 'js/masonry.pkgd.js',   kopa_variable.url.template_directory_uri + 'js/imagesloaded.js'],
                    complete: function () {

                        var jQuerymasonry1 = $('.kopa-masonry-wrap');
                        imagesLoaded(jQuerymasonry1, function () {
                            jQuerymasonry1.masonry({
                                columnWidth: 1,
                                itemSelector: '.ms-item1'
                            });
                            jQuerymasonry1.masonry('bindResize')
                        });

                        var jQuerymasonry2 = $('.kopa-gallery-2-widget > ul');
                        imagesLoaded(jQuerymasonry2, function () {
                            jQuerymasonry2.masonry({
                                columnWidth: 1,
                                itemSelector: '.gl-item2'
                            });
                            jQuerymasonry2.masonry('bindResize')
                        });

                        var jQuerymasonry3 = $('.kopa-gallery-3-widget > ul');
                        imagesLoaded(jQuerymasonry3, function () {
                            jQuerymasonry3.masonry({
                                columnWidth: 1,
                                itemSelector: '.gl-item3'
                            });
                            jQuerymasonry3.masonry('bindResize')
                        });

                        var jQuerymasonry4 = $('.kopa-gallery-4-widget > ul');
                        imagesLoaded(jQuerymasonry4, function () {
                            jQuerymasonry4.masonry({
                                columnWidth: 1,
                                itemSelector: '.gl-item4'
                            });
                            jQuerymasonry4.masonry('bindResize')
                        });

                        var jQuerymasonry5 = $('.team-masonry');
                        imagesLoaded(jQuerymasonry5, function () {
                            jQuerymasonry5.masonry({
                                columnWidth: 1,
                                itemSelector: '.t-item'
                            });
                            jQuerymasonry5.masonry('bindResize')
                        });

                        $(".team-tab").find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                            jQuerymasonry5.masonry();
                        })

                        var jQuerymasonry6 = $('.kopa-entry-list > ul');
                        imagesLoaded(jQuerymasonry6, function () {
                            jQuerymasonry6.masonry({
                                columnWidth: 1,
                                itemSelector: '.ms-item2'
                            });
                            jQuerymasonry6.masonry('bindResize');
                        });

                        var jQuerymasonry7 = $('.kopa-related-post > ul');
                        imagesLoaded(jQuerymasonry7, function () {
                            jQuerymasonry7.masonry({
                                columnWidth: 1,
                                itemSelector: '.col-md-3'
                            });
                            jQuerymasonry7.masonry('bindResize')
                        });

                    }
                }]);

                /* ============================================
                 17. Match height
                 =============================================== */

                if ($('.article-list-5').length > 0) {

                    Modernizr.load([{
                        load: [kopa_variable.url.template_directory_uri + 'js/jquery.matchHeight.js'],
                        complete: function () {

                            var post_1 = $('.cl-item');

                            post_1.each(function() {
                                $(this).children('div').matchHeight();
                            });
                        }
                    }]);

                };

                /* ============================================
                 18. Mobile-menu
                 =============================================== */

                Modernizr.load([{
                    load: [kopa_variable.url.template_directory_uri + 'js/jquery.navgoco.js'],
                    complete: function () {

                        $(".main-menu-mobile").navgoco({
                            accordion: true
                        });
                        $(".main-menu-mobile").find(".sf-mega").removeClass("sf-mega").addClass("sf-mega-mobile");
                        $(".main-menu-mobile").find(".sf-mega-section").removeClass("sf-mega-section").addClass("sf-mega-section-mobile");

                        $(".main-nav-mobile > .pull").click(function () {
                            $(this).closest(".main-nav-mobile").find(".main-menu-mobile").slideToggle("slow");
                        });
                        $(".caret").removeClass("caret");

                        $(".bottom-nav-mobile > .pull").click(function () {
                            $(this).closest(".bottom-nav-mobile").find(".main-menu-mobile").slideToggle("slow");
                        });

                    }
                }]);

                /* ============================================
                 19. Bootstrap Slider
                 =============================================== */

                if (jQuery('.kopa-slider-ip').length > 0) {

                    Modernizr.load([{
                        load: [kopa_variable.url.template_directory_uri + 'js/bootstrap-slider.min.js'],
                        complete: function () {
                            jQuery('.kopa-slider-ip').slider({
                                tooltip: "show"
                            });
                        }
                    }]);
                };

                /* =========================================================
                 20. Sticky menu
                 ============================================================ */

                Modernizr.load([{
                    load: [kopa_variable.url.template_directory_uri + 'js/waypoints.js', kopa_variable.url.template_directory_uri + 'js/waypoints-sticky.js'],
                    complete: function () {
                        jQuery('.kopa-header-middle').waypoint('sticky');
                    }
                }]);

                $('.facebook-share').click(function () {
                    var button = $(this);
                    if(button.attr('data-url') && button.attr('data-url').length > 0){
                        FB.ui({
                            method: 'share',
                            href: button.attr('data-url'),
                        }, function(response){
                            console.log(response);
                        });
                    }
                })

            });

        }
    };


})(jQuery, Drupal, this, this.document);
