CUtils = {

    jsonToUL: function(json){
        var ul = $("<ul>");
        jQuery.each(json, function(i, val) {
            ul.append(
                $("<li>").append(
                    val
                )
            );
        });

        var msg =  $("<p>");
        msg = msg.append(
            ul[0].outerHTML
        )[0].outerHTML;

        return msg;
    },
}

