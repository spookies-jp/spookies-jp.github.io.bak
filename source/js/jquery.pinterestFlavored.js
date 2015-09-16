'use strict';
var Grid = (function () {
    function Grid(options) {
        this.columns = [];
        this.defaults = {
            'container': '.container',
            'itemsSelector': '.item'
        };
        var width = 0;

        this.options = $.extend({}, this.defaults, options);

        width = Math.floor($(this.options.itemsSelector).first().outerWidth(true)) - parseInt($(this.options.itemsSelector).first().css('marginRight'), 10);

        this.columns = new Array(Math.floor($(this.options.container).width() / width));

        for (var i = 0, l = this.columns.length; i < l; i++) {
            this.columns[i] = { height: 0 };
        }
    }
    Grid.prototype.min = function () {
        var result = { x: 0, height: this.columns[0].height };

        for (var x = 0, l = this.columns.length; x < l; x++) {
            if (result.height > this.columns[x].height) {
                result = { x: x, height: this.columns[x].height };
            }
        }

        return result.x;
    };

    Grid.prototype.max = function () {
        return this.columns.map(function (item) {
            return item.height;
        }).reduce(function (previousValue, currentValue, index, array) {
            return Math.max(previousValue, currentValue);
        });
    };

    Grid.prototype.lay = function () {
        var _this = this;
        var $items = $(this.options.itemsSelector);
        var width = $items.first().outerWidth();

        var marginTop = parseInt($items.first().css('marginTop'), 10);
        var marginRight = parseInt($items.first().css('marginRight'), 10);

        $items.each(function (index, Element) {
            var x = _this.min();

            $(Element).css({
                'left': (width * x) + (marginRight * x),
                'top': _this.columns[x].height,
                'position': 'absolute'
            });

            _this.columns[x].height += $(Element).outerHeight(true);
        });

        $(this.options.container).height(this.max());
    };
    return Grid;
})();
