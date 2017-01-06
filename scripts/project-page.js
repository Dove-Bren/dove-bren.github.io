function dopage() {
    var handle = findGetParameter("page");
    if (handle == null) {
        alert("wrong");
        document.location = "projects.html";
        throw 'bounce';
    } else {        
        validate(handle);
        
        pushTitle(handle);
        pushData(handle);
    }
}

function validate(handle) {
    switch(handle) {
        case "test":
            break;
        default:
            document.location = "projects.html";
            throw '';
    }
}

function pushTitle(handle) {
    var trans;
    
    switch(handle) {
        case "test":
            trans = "Test Page";
            break;
    }
    
    
    var obj = document.getElementById("header");
    obj.innerHTML = trans;
}

/* Taken from http://stackoverflow.com/questions/5448545/how-to-retrieve-get-parameters-from-javascript */
function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
    .substr(1)
        .split("&")
        .forEach(function (item) {
        tmp = item.split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    });
    return result;
}