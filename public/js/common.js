$(function() {
	
	$.d3POST = function(path,params,callback){

        $.ajax({
            async: true,
            url: path,
            data: params,
            type: "post",
            cache: true,
            dataType: "json",
            success: function (data) {
                callback(data);
            }
        });
    };

    $.d3GET = function(path,params,callback){

        $.ajax({
            async: true,
            url: path,
            data: params,
            type: "get",
            cache: true,
            dataType: "json",
            success: function (data) {
                callback(data);
            }
        });
    };

    $._indexOf = function(needle) {
        if(typeof Array.prototype.indexOf === 'function') {
            indexOf = Array.prototype.indexOf;
        } else {
            indexOf = function(needle) {
                var i = -1, index = -1;

                for(i = 0; i < this.length; i++) {
                    if(this[i] === needle) {
                        index = i;
                        break;
                    }
                }

                return index;
            };
        }

        return indexOf.call(this, needle);
    };

});