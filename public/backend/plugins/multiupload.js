(function ($) {
    $.fn.multiupload = function (options) {
        var rootElement = this;
        var defaults = {
            pathfile: '',
            btnaddimg: '#addnewimg',
            btninputimg: '#unewimg',
            storedimg: [],
            storedoldnameremove: [],
            oldimg: ''
        };
        var settings = $.extend({}, defaults, options); //Gop tham so      
        //Ham xu ly cho plugin
        var methods = {
            init: function () {},
            load: function () {},
            addImg: function () {},
            removeImg: function () {},
            getOldName: function () {},
            getOldNameRemove: function () {}
        };
        //Trien khai ham init
        methods.init = function () {
            methods.load();
            $(settings.btnaddimg).click(function (evt) {
                evt.preventDefault();
                $(settings.btninputimg).click();
            });
            $(settings.btninputimg).change(function (evt) {
                var files = evt.target.files;
                for (var i = 0, f; f = files[i]; i++) {
                    if (!f.type.match('image.*'))
                        continue;
                    // insert file to array to upload
                    settings.storedimg.push(f);
                    // read and show file
                    var reader = new FileReader();
                    reader.onload = (function (theFile) {
                        return function (e) {
                            methods.addImg(theFile.name, e.target.result);
                        };
                    })(f);
                    reader.readAsDataURL(f);
                }
            });
        };
        //Trien khai ham load
        methods.load = function () {
            if (settings.oldimg !== '') {
                var or = settings.oldimg.split(";");
                for (var r in or) {
                    methods.addImg(or[r]);
                }
            } else {
                $(".oneimg", rootElement).remove();
                $(".noimg", rootElement).show();
            }
        };
        // Add row (from db and click button add new)
        methods.addImg = function (name, src) {
            var typeclass = 'newimg';
            if (typeof src === 'undefined') {
                src = settings.pathfile + name;
                typeclass = 'oldimg';
            }
            $(".noimg", rootElement).hide();
            var ele = $('<div class="oneimg ' + typeclass + '" name="' + name + '"><div class="rmoneimg"></div><img src="' + src + '" class="imgupload"/></div>');
            ele.appendTo(rootElement).show();
            $(".rmoneimg", ele).click(function (i) {
                var index = $('.newimg', rootElement).index($(this).parent('.newimg'));
                methods.removeImg(ele, index);
            });
        };
        methods.removeImg = function (ele, i) {
            if (ele.hasClass("oldimg")) {
                // remember old name file to remove file from store folder
                settings.storedoldnameremove.push($('img', ele).attr("name"));
            } else {
                // remove new image in array store
                console.log("remove ele new " + i);
                settings.storedimg.splice(i, 1);
            }
            // remove element
            ele.remove();
            // check show no img
            if ($('.oneimg', rootElement).length === 0) {
                $(".noimg", rootElement).show();
            }
        };
        methods.getOldName = function () {
            var arr = [];
            $('.oldimg', rootElement).each(function () {
                arr.push($(this).attr("name"));
            });
            return arr;
        };
        methods.getOldNameRemove = function () {
            return settings.storedoldnameremove;
        };
        methods.getNewFile = function () {
            return settings.storedimg;
        };
        methods.init();
        //Ham xu ly cho plugin
        return methods; //Tra ve jQuery object
    }
})(jQuery);