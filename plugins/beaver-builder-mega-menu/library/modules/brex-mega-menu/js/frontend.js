"use strict";

(function ($) {
    $(function () {
        var menu_expanded = false;
        $(window).click(function (e) {

            setTimeout(function () {
                if (menu_expanded) {
                    $('.brex-mobile-menu-container').removeClass('expanded');
                }
            }, 50);
        });
        $('.brex-mobile-menu-container').unbind().click(function (event) {
            event.stopPropagation();
            return false;
        });
        $('.brex-mobile-menu-container .close-icon').unbind().click(function () {
            $(this).parents('.brex-mobile-menu-container').removeClass('expanded');
        });



        $('.fl-module-brex-mega-menu').each(function () {
            var current_node = $(this).data('node'),
                current_menu_container = $(this);
            current_menu_container.find(".brex-mobile-menu-icon a i").unbind().click(function (e) {
                event.stopPropagation();
                console.log("Click menu");
                var node_id = $(this).parents('.fl-module-brex-mega-menu').data('node');
                $('.fl-node-' + node_id).children('.brex-mobile-menu-container').toggleClass('expanded');

                if ($('.fl-node-' + node_id).children('.brex-mobile-menu-container').hasClass('expanded')) {
                    menu_expanded = true;
                } else {
                    menu_expanded = false;
                }

            });
            //$('.fl-node-' + current_node).find('.brex-mobile-menu-inner > .menu-item-has-children > a').click(function (e) {
            $('.fl-node-' + current_node).find('.brex-mobile-menu-inner a').click(function (e) {
                console.log("Click menu item");
                var href = $(this).attr('href');


                // remove expanded class from all other items
                $(this).parent().siblings().removeClass('expanded');


                if ($(this).closest('li').hasClass('menu-item-has-children')) {
                    e.stopPropagation();

                    var currently_expanded = $(this).parent().hasClass('expanded'),
                        html = $(this).parent().find('.sub-menu').first().clone(),
                        parent = $(this).parent();

                    if (currently_expanded) {

                        if (href != '#' && href != '#!') {
                            document.location.href = href;
                            return true;
                        }
                        parent.find('li.expanded').removeClass('expanded');
                        parent.find('.sub-menu').css({
                            height: 0
                        });
                        setTimeout(function () {
                            parent.removeClass('expanded');//.find('.sub-menu').first().removeAttr('style');
                        }, 250);
                        return false;
                    } else {
                        var height = getPrerenderedObjectDimensions(html, parent);
                        parent.find('.sub-menu').css({
                            height: 0
                        });
                        setTimeout(function () {
                            parent.find('.sub-menu').first().css({
                                height: height.height + 'px'
                            });
                        }, 1);
                        setTimeout(function () {
                            parent.addClass('expanded').find('.sub-menu').first().removeAttr('style');
                        }, 250);
                        return false;
                    }


                }
                else {
                    document.location.href = href;
                    return true;
                }
            });
        });

    });
})(jQuery);



function getPrerenderedObjectDimensions(html, element_to_append_to) {
    return function ($) {
        if (!element_to_append_to) {
            element_to_append_to = $("body");
        } // Declare our return


        var return_data = []; // Generate a unique ID

        var element_id = Math.round(new Date().getTime() + Math.random() * 100); // Create an invisible place to create the HTML

        $(element_to_append_to).append('<div id="' + element_id + '"" class="invisible" style="position:absolute;left:0;top:0;"></div>');
        $("#" + element_id).html(html).children().css({
            height: 'auto'
        }); // Get the height of our item

        return_data.height = $("#" + element_id).height(); // Get the outer-height of our item

        return_data.outerHeight = $("#" + element_id).outerHeight(true); // Get the width of our item

        return_data.width = $("#" + element_id).width(); // Get the width of our item

        return_data.outerWidth = $("#" + element_id).outerWidth(true); // Remove the element

        $("#" + element_id).remove();
        return return_data;
    }(jQuery);
}

(function ($) {

    if (!("ontouchstart" in document.documentElement)) {
        //document.documentElement.className += " no-touch";
        //desktop
    }
    else {
        //tablet/mobile
        top_menus = $('ul.brex-mega-menu li.mega-menu-saved-row');

        $.each(top_menus, function (index, elem) {

            $(elem).bind('touchstart', function (e) {
                console.log('click tablet');
                var current_div = $(elem).find('div.mega-menu-saved-row-container');
                var a_href = $(elem).children('a').first().attr('href');
                var a = $(elem).children('a').first();
                var a_closest = $(e.target).closest('a');
                var a_closest_href = a_closest.attr('href');

                if (a_closest.length && !a_closest.hasClass('mega-menu-saved-row-a')) {
                    document.location.href = a_closest_href;
                    return true;
                }

                if (current_div.hasClass('mega-menu-saved-row-container-opened')) {
                    if (a_closest.length && a_closest.hasClass('mega-menu-saved-row-a')) return true;
                }

                $('div.mega-menu-saved-row-container').hide().removeClass('mega-menu-saved-row-container-opened');
                current_div.show().addClass('mega-menu-saved-row-container-opened');
                e.stopPropagation();
                return false;
            });
        });

        $(document).bind('touchstart', function (e) {
            $('div.mega-menu-saved-row-container').hide().removeClass('mega-menu-saved-row-container-opened');
        });

        top_menus_dd = $('ul.brex-mega-menu li.drop-down');

        $.each(top_menus_dd, function (index, elem) {

            $(elem).bind('touchstart', function (e) {
                console.log('click tablet');
                var current_div = $(elem).find('ul.drop-down-ul');
                var a_href = $(elem).children('a').first().attr('href');
                var a = $(elem).children('a').first();
                var a_closest = $(e.target).closest('a');
                var a_closest_href = a_closest.attr('href');

                if (a_closest.length && !a_closest.hasClass('dd-saved-row-a')) {
                    document.location.href = a_closest_href;
                    return true;
                }

                if (current_div.hasClass('dd-saved-row-container-opened')) {
                    if (a_closest.length && a_closest.hasClass('dd-saved-row-a')) return true;
                }

                $('ul.drop-down-ul').hide().removeClass('dd-saved-row-container-opened');
                current_div.show().addClass('dd-saved-row-container-opened');
                e.stopPropagation();
                return false;
            });
        });

        $(document).bind('touchstart', function (e) {
            $('ul.drop-down-ul').hide().removeClass('dd-saved-row-container-opened');
        });

    }
})(jQuery);


