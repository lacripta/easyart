function getJson(url, data) {
    return JSON.parse($.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        global: false,
        async: false,
        data: data,
        success: function (json) {
            return json;
        },
        error: function (error) {
            return error;
        }
    }).responseText);
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};