var Popup = {
  open: function(options)
  {
    this.options = {
      url: '#',
      width: 600,
      height: 500,
      name:"_blank",
      location:"no",
      menubar:"no",
      toolbar:"no",
      status:"yes",
      scrollbars:"yes",
      resizable:"yes",
      left:"",
      top:"",
      normal:false
    }
    Object.extend(this.options, options || {});

    if (this.options.normal){
        this.options.menubar = "yes";
        this.options.status = "yes";
        this.options.toolbar = "yes";
        this.options.location = "yes";
    }

    this.options.width = this.options.width < screen.availWidth?this.options.width:screen.availWidth;
    this.options.height=this.options.height < screen.availHeight?this.options.height:screen.availHeight;
    var openoptions = 'width='+this.options.width+',height='+this.options.height+',location='+this.options.location+',menubar='+this.options.menubar+',toolbar='+this.options.toolbar+',scrollbars='+this.options.scrollbars+',resizable='+this.options.resizable+',status='+this.options.status
    if (this.options.top!="")openoptions+=",top="+this.options.top;
    if (this.options.left!="")openoptions+=",left="+this.options.left;
    window.open(this.options.url, this.options.name,openoptions );
    return false;
  }
}
