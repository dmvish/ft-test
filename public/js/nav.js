(function ($) {
    "use strict";

    $('[data-nav]').each(function(){
        var navIndex = $(this).attr('data-split');
        var navActive = $(this).attr('data-active').replace('.', '_');

        if(navIndex > 0)
        {
            var activeIndex = navActive.split('_');
            navActive = activeIndex[navIndex - 1];
        }

        $(this).find('li#' + navActive).find('> a').addClass('active');
    });

})(jQuery);
