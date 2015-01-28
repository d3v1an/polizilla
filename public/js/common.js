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

});