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
