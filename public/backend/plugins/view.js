(function ($) {
    $.View = function (options) {

        var defaults = {
            _ns: '',
            _ns_full: '',
            _form_default: '#main-form'
        },
        plugin = this,
        options = options || {};

        plugin.init = function () {
            var settings = $.extend({}, defaults, options);
            settings['buis'] = {};
            $.data(document, 'View', settings);
        }

        plugin.blockUI = function () {}

        plugin.init();

    }

    $.View.init = function (grid, callback) {
        console.log('Init view js...');
    }

    $.View.blockUI = function (eselector, status) {
        var settings = ($.data(document, 'View'));
        var buis = settings['buis'];
        if (status === true) {
            selector = $(eselector);
            var offset = selector.offset();
            var width = selector.outerWidth();
            var height = selector.outerHeight();
            if (buis.hasOwnProperty(eselector)) {
                var bui = buis[eselector];
            } else {
                var bui = $("#blockui").clone();
                settings['buis'][eselector] = bui;
                $.data(document, 'View', settings);
            }
            bui.addClass('blockui').css({"left": offset.left, "top": offset.top, "display": "block"}).width(width).height(height).appendTo("body");
        } else {
            if (buis.hasOwnProperty(eselector)) {
                var bui = buis[eselector];
                bui.remove();
            }
        }
    }

}(jQuery));