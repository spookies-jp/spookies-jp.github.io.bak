$(function() {
    $(window.document).on('click', '#works [data-toggle]', function(event) {
        var $c = $(event.currentTarget);
        var $closest = $c.closest($c.attr('data-parent'));

        $closest.toggleClass('active');
    });

    $(window.document).on('click', '#spoo a', function(event) {
        $('html,body').animate({ scrollTop: 0 }, 350);
    });
});

(function($) {
    var func = function(event) {
        var container = '#toppage #posts';
        var items = container + ' .post';
        var grid = new Grid({
            'container': container,
            'itemsSelector': '.post'
        });
        var $container = $(container);

        // iOS はいらない
        if (($(window).width() < 980) || Modernizr.touch) {
            $container.css({ height: 'auto' });
            $(items).css({ top: 'auto', left: 'auto', position: 'static', width: 'auto' });

            return;
        } else {
            $container.css({ position: 'relative' });
            $(items).css({ position: 'absolute' });
        }

        if ($container.length > 0) grid.lay();
    };

    if ($('#posts').length > 0) $(window).on('load resize', func);

    if (!Modernizr.csstransitions) return;

    var karousel = new Karousel({
        'container': '#carousel_ul',
    });

    var intervalID = window.setInterval(function() { karousel.slide('right') }, 4000);

    $(window.document).on('click', '[data-trigger-for-us="karousel"]', function(event) {
        event.preventDefault();

        karousel.slide($(event.currentTarget).data('direction'));
    });
})(window.jQuery);
