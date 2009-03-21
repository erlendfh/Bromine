<style>

    #tree, #tree ul {
        margin: 0px 0px 0px 0px;
    	padding-left: 20px; 
    	list-style-type: none;
    	cursor: move;
    	line-height: 28px;
    }
    #tree {
      padding: 0px;
	    margin: 12px;
    	width: 400px;
    }
    #tree li {
        list-style-type: none;
        margin: 0px 0px 0px 0px;
    	margin-top: -6px;
    }
    #tree li a {
      padding: 2px 0 0 18px;
    	background: url(/img/file.png) no-repeat left top;
    }
    #tree li.file {
    	padding-left: 18px;
    }
    #tree li.file a {
    	padding-left: 18px;
    	background: url(/img/file.png) no-repeat left top;
    }
    #tree li span.handle {
      display: block;
      float: left;
    	width: 15px;
    	height: 12px;
    	margin: 6px 3px 0 0;
    	cursor: pointer;
    }
    #tree li span {
    	background: url(/img/folder_open.png) no-repeat 3px 3px;
    }
    #tree li.closed span {
    	background: url(/img/folder_closed.png) no-repeat 3px 3px;
    }
    #tree li.closed li {
    	display: none;
    }
    #tree .drop_hover {
    	background: url(/img/drag.png) no-repeat bottom left;
    }
    #tree .drop_top {
    	background-position: 12px top;
    }
    #tree .drop_bottom {
    	background-position: 12px bottom;
    }
    #tree .drop_insert {
    	background-position: 32px 100%;
    }
    #log {
      padding: 12px;
      color: #999;
      line-height: 12px;
    }
  </style>
<table>
    <tr style='vertical-align: top;'>
        <td>
            <?php echo $tree->show('Menu/name', $data); ?>
        </td>
        <td>
            <div id='lala'></div>
        </td>
    </tr>
</table>
<div id="log"></div>
<script>
  var tree = new SortableTree('tree', {
    droppable: {
      container: ':not(.2)'
    },
    onDrop: function(drag, drop, event){
      //$('log').update($('log').innerHTML + "<p>" + drag.to_params() + "</p>")
      new Ajax.Updater('log','/menus/reorder/'+drag.id()+'/'+drag.parent.id());
    }
  });
  tree.setSortable();

  function log(line) {
    $('log').update($('log').innerHTML + "<p>" + line + "</p>");
  }
  
  function toggle_folder(event) {
    var element = event.element().ancestors().first();
    if(element.hasClassName('closed')) {
      element.removeClassName('closed');
    } else {
      element.addClassName('closed');
    }
  }
  
  Event.observe(window, "load", function(){
    $$('.handle').each(function(element){
      Event.observe(element, 'click', toggle_folder);
    });
  });
</script>
