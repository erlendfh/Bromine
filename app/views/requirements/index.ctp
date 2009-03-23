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
    	width: 200px;
    }
    #tree li {
        list-style-type: none;
        margin: 0px 0px 0px 0px;
    	margin-top: -6px;
    }
    #tree li a {
      padding: 2px 0 0 32px;
    }
    #tree li.req a {
      background: url(/img/tango/32x32/mimetypes/text-x-generic.png) no-repeat left top;
    }
    #tree li.tc a {
    	background: url(/img/tango/32x32/mimetypes/application-x-executable.png) no-repeat left top;
    }
    #tree li span {
      display: block;
      float: left;
      width: 15px;
      height: 12px;
      margin: 6px 3px 0 0;
      cursor: pointer;
    }
    #tree li span.handle {
    	background: url(/img/folder_open.png) no-repeat 3px 3px;
    }
    #tree li.closed span.handle {
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
  </style>
<table>
    <tr style='vertical-align: top;'>
        <td>
            <ul id='mehe' >
                <li>
                    <?php echo $session->read('project_name'); ?>
                    <ul id="tree">
                        <?php echo $tree->show2('Requirement/name', $data); ?>
                    </ul>
                </li>
            </ul>
            

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
      new Ajax.Updater('log','/requirements/reorder/'+drag.id()+'/'+drag.parent.id());
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
