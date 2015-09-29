'use strict';
var Karousel = (function () {
    function Karousel(options) {
        this.isExecuted = false;
        this.defaults = {
            'container': '.container'
        };
        this.options = $.extend({}, this.defaults, options);
    }
    Karousel.prototype.slide = function (direction) {
        var _this = this;
        var $container = $(this.options.container);
        var width = $container.find('li').first().outerWidth(true);
        var to = $container.css('left');
        var destination = parseInt(to, 10);

        if (this.isExecuted)
            return;

        if (direction === 'left') {
            destination += width;

            this.isExecuted = true;
        } else if (direction === 'right') {
            destination -= width;

            this.isExecuted = true;
        }

        $container.css({ 'transition-property': 'left' }).css({ left: destination });

        $container.off('transitionend').on('transitionend', function (event) {
            if (direction === 'left') {
                $(_this.options.container).find('li').first().before($(_this.options.container).find('li').last());
            } else if (direction === 'right') {
                $(_this.options.container).find('li').last().after($(_this.options.container).find('li').first());
            }

            $container.css({ 'transition-property': 'none' }).css({ left: to });

            _this.isExecuted = false;
        });
    };
    return Karousel;
})();
