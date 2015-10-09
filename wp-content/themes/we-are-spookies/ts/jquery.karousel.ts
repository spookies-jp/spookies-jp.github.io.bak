/// <reference path="d.ts/DefinitelyTyped/jquery/jquery.d.ts" />
'use strict';

class Karousel {
    isExecuted: boolean = false;
    options: any;
    defaults: any = {
        'container': '.container',
    };

    constructor(options: any) {
        this.options = $.extend({}, this.defaults, options);
    }

    // TODO: アニメーション中か確認する
    slide(direction: string): void {
        var $container: JQuery = $(this.options.container);
        var width: number = $container.find('li').first().outerWidth(true);
        var to: string = $container.css('left');
        var destination: number = parseInt(to, 10);

        if (this.isExecuted) return;

        if (direction === 'left') {
            destination += width;

            this.isExecuted = true;
        } else if (direction === 'right') {
            destination -= width;

            this.isExecuted = true;
        }

        $container.css({ 'transition-property': 'left' }).css({ left: destination });

        $container.off('transitionend').on('transitionend', (event) => {
            if (direction === 'left') {
                $(this.options.container).find('li').first().before($(this.options.container).find('li').last());
            } else if (direction === 'right') {
                $(this.options.container).find('li').last().after($(this.options.container).find('li').first());
            }

            $container.css({ 'transition-property': 'none' }).css({ left: to });

            this.isExecuted = false;
        });
    }
}
