function highLightCurPage(){
  curPage=location.href.split('?').shift()
  for (var i=0;i < document.links.length;i++) {
    if(document.links[i].href.indexOf(curPage)!=-1 && document.links[i].name=='menulink'){
      document.links[i].style.color='black';
    }
  }
}
