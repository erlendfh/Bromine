function changeUrl(value){
    url = window.location.toString();
    url = url.split('#');
    window.location =  url[0]+"#"+value;
}
function getAnchor(){
    url = window.location.toString();

        url = url.split('#');
        if(url.length<=1){
            return false;
        }
        return url[1];
    
}
