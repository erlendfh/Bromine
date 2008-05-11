var Popup = { };

(function(){

/* Ceased with NN6 */
var isNN4 = !(!document.layers);

/* popup test */
//var strTest = "This site has some of the greatest scripts around!<br>heheheheheheeh<br>hbehehehehehe";
//var descarray = isNN4 ? new Array(strTest) : [ strTest ];

var overdiv= false;
var pad = "1px", bord="0";



Popup.popLayer = function(strTest){



a=0;

/*if ( !descarray[a] ){
descarray[a] ="<font color=red>This popup (#"+a+") isn't setup correctly - needs description</font>";
}
*/

descarray = isNN4 ? new Array(strTest) : [ strTest ];
kk=String(descarray[a]);
kk=kk.replace(/!112!/g,"?");
kk=kk.replace(/!911!/g,"&");
if (document.getElementById) {
pad ="0px";
bord="1 bordercolor=black";
}

/* forced to use new, here */
var arDesc = new Array(
"<table cellspacing=\"0\" cellpadding=\"",
pad,
"\" border=\"",
bord,
"\" bgcolor=\"#000000\"><tr><td>",
"<table cellspacing=\"0\" cellpadding=\"3\" border=\"0\" width=\"100%\"><tr><td bgcolor=\"#ffffff\">",
kk,
"</td></tr></table>",
"</td></tr></table>").join("");

if( isNN4) {
document.object1.document.write(arDesc);
document.object1.document.close();
document.object1.left=x+30+'px';
document.object1.top=y-10+'px';

} else if (document.all){
object1.innerHTML=arDesc;
object1.style.pixelLeft=x+30+'px';
object1.style.pixelTop=y-10+'px';

} else {
var obj1 = document.getElementById("object1");
obj1.innerHTML=arDesc;
obj1.style.left=x+30+'px';
obj1.style.top=y-10+'px';
}

}

Popup.hideLayer = function(){
//if ( !overdiv) {
if( isNN4 ) {
eval(document.object1.top="-500px");
} else if (document.all) {
object1.innerHTML="";
} else {
document.getElementById("object1").style.top="-500px";
}
//}
}

Popup.out = function(){
overdiv =false;
//setTimeout('Popup.hideLayer()',1000);
}

Popup.over = function(){
overdiv =true;
}

function handlerMM(e){
x = (e ===undefined) ? event.clientX +document.body.scrollLeft : e.pageX;
y = (e ===undefined) ? event.clientY +document.body.scrollTop : e.pageY;
}
if (document.captureEvents){ document.captureEvents(Event.MOUSEMOVE); }
document.onmousemove = handlerMM;

})();
