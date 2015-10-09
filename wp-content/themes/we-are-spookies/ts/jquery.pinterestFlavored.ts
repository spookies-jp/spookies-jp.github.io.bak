/// <reference path="d.ts/DefinitelyTyped/jquery/jquery.d.ts" />
'use strict';

interface column {
  height: number;
}

class Grid {
    // インターフェースを定義するかも
    columns: column[] = [];
    options: any;
    defaults: Object = {
        'container': '.container',
        'itemsSelector': '.item'
    };

    constructor(options: Object) {
        var width:number = 0;

        this.options = $.extend({}, this.defaults, options);

        width = Math.floor($(this.options.itemsSelector).first().outerWidth(true)) - parseInt($(this.options.itemsSelector).first().css('marginRight'), 10);

        this.columns = new Array(Math.floor($(this.options.container).width() / width));

        for (var i:number = 0, l:number = this.columns.length; i < l; i++) {
            this.columns[i] = { height: 0 };
        }
    }

    min() : number {
        var result:any = { x: 0, height: this.columns[0].height };

        for (var x:number = 0, l:number = this.columns.length; x < l; x++) {
            if (result.height > this.columns[x].height) {
                result = { x: x, height: this.columns[x].height };
            }
        }

        return result.x;
    }

    max() : number {
        // index を返したいが、実装が楽なので高さを返す
        return this.columns
            .map((item) => { return item.height; })
            .reduce((previousValue, currentValue, index, array) => {
                return Math.max(previousValue, currentValue);
            });
    }

    lay() : void {
        var $items:JQuery = $(this.options.itemsSelector);
        var width:number = $items.first().outerWidth();
        // もう少しやり方があるのでは？
        var marginTop:number = parseInt($items.first().css('marginTop'), 10);
        var marginRight:number = parseInt($items.first().css('marginRight'), 10);

        $items.each((index, Element) => {
            var x:number = this.min();

            $(Element).css({
                'left': (width * x) + (marginRight * x),
                'top': this.columns[x].height,
                'position': 'absolute'
            });

            this.columns[x].height += $(Element).outerHeight(true);
        });

        $(this.options.container).height(this.max());
    }
}
