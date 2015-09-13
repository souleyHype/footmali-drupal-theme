/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
    Drupal.behaviors.footmali = {
        attach: function (context, settings) {

            //Video page when new videos load grab the list item put them inside a ul tag
            $.when( $.ajax( "/video" ) ).then(function() {

                var items = $('.kopa-entry-list > li');
                $('.kopa-entry-list').append('<ul class="row clearfix"></ul>');
                $('.kopa-entry-list ul:empty').first().html(items);

            });
        }
    };


})(jQuery, Drupal, this, this.document);
