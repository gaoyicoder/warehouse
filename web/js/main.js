/**
 * Created by gaoyi on 3/31/17.
 */

function jump(url) {
    location.href = url;
}

var Tools = {
    CNYToUSD : function (CNY) {
        if(typeof (USDRate) == "number") {
            return Tools.formatNum(CNY / USDRate, 2);
        } else {
            return Tools.formatNum(CNY / 6.10, 2);
        }
    },
    formatNum: function (Num1, Num2) {
        if (isNaN(Num1) || isNaN(Num2)) {
            return (0);
        } else {
            Num1 = Num1.toString();
            Num2 = parseInt(Num2);
            if (Num1.indexOf('.') == -1) {
                return (Num1);
            } else {
                var b = Num1.substring(0, Num1.indexOf('.') + Num2 + 1);
                var c = Num1.substring(Num1.indexOf('.') + Num2 + 1, Num1.indexOf('.') + Num2 + 2);
                //alert(b);
                //alert(c);
                if (c == "") {
                    return (b);
                } else {
                    if (parseInt(c) < 5) {
                        return (b);
                    } else {
                        return ((Math.round(parseFloat(b) * Math.pow(10, Num2)) + Math.round(parseFloat(Math.pow(0.1, Num2).toString().substring(0, Math.pow(0.1, Num2).toString().indexOf('.') + Num2 + 1)) * Math.pow(10, Num2))) / Math.pow(10, Num2));
                    }
                }
            }
        }
    }
};


(function ($) {
    $.fn.autoTextarea = function (options) {
        var defaults = {
            maxHeight: null,
            minHeight: $(this).height()
        };
        var opts = $.extend({}, defaults, options);
        return $(this).each(function () {
            $(this).bind("paste cut keydown keyup focus blur", function () {
                var height, style = this.style;
                this.style.height = opts.minHeight + 'px';
                if (this.scrollHeight > opts.minHeight) {
                    if (opts.maxHeight && this.scrollHeight > opts.maxHeight) {
                        height = opts.maxHeight;
                        style.overflowY = 'scroll';
                    } else {
                        height = this.scrollHeight;
                        style.overflowY = 'hidden';
                    }
                    style.height = height + 'px';
                }
            });
        });
    };
})(jQuery);