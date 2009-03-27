<style>
    html, body {
     	font: normal 12px Helvetica,Arial,Verdana,sans-serif;
    	line-height: 20px;
    	color: #444;
    }
    #tree, #tree ul { 
    	padding-left: 4px; 
    	list-style-type: none;
    	cursor: move;
    }
    #tree {
      padding: 0px;
	    margin: 12px;
    	width: 200px;
    }
    #tree li {
    list-style-type: none;
    	margin-top: -6px;
    }
    #tree li a {
    padding: 2px 0 0 18px;
    }
    #tree li.req a {
      
    	background: url(img/tango/16x16/mimetypes/x-office-presentation.png) no-repeat left top;
    }
    #tree li.tc a {

    	background: url(img/tango/16x16/mimetypes/text-x-generic.png) no-repeat left top;
    }
    #tree li.tcs a {

    	background: url(img/tango/16x16/mimetypes/text-x-script.png) no-repeat left top;
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
    	background: url(img/nolines_minus.gif) no-repeat left -4px;
    }
    #tree li.closed span.handle {
    	background: url(img/nolines_plus.gif) no-repeat left -4px;
    }
    #tree li.closed li {
    	display: none;
    }
    #tree .drop_hover {
    	background: url(img/drag.png) no-repeat bottom left;
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
var MAX_DUMP_DEPTH = 2;

      

       function dumpObj(obj, name, indent, depth) {

              if (depth > MAX_DUMP_DEPTH) {

                     return indent + name + ": <Maximum Depth Reached>\n";

              }

              if (typeof obj == "object") {

                     var child = null;

                     var output = indent + name + "\n";

                     indent += "\t";

                     for (var item in obj)

                     {

                           try {

                                  child = obj[item];

                           } catch (e) {

                                  child = "<Unable to Evaluate>";

                           }

                           if (typeof child == "object") {

                                  output += dumpObj(child, item, indent, depth + 1);

                           } else {

                                  output += indent + item + ": " + child + "\n";

                           }

                     }

                     return output;

              } else {

                     return obj;

              }

       }


  var tree = new SortableTree('tree', {
    droppable: {
      container: ':not(.tc)'
    },
    onDrop: function(drag, drop, event){
      //$('log').update($('log').innerHTML + "<p>" + drag.to_params() + "</p>")
      new Ajax.Updater('log','/requirements/reorder/'+drag.id()+'/'+drag.parent.id()+'/'+drag.element.getAttribute('name'));
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
