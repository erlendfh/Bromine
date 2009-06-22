
<style>

    #tree, #tree ul { 
    	padding-left: 4px; 
    	list-style-type: none;
    	line-height: 20px;
    }
    #tree {
        padding: 0px;
        margin-left: -30px;
        margin-top: -8px;
    }
    #tree div{
        display: list-item;
    }
    #tree li, #tree div, #testcases li {
        list-style-type: none;
    	margin-top: -8px;
    }
    li.req a, div.tc a, div.tcs a, a.project {
        padding: 2px 0 0 18px;
    }
    
    a.project{
    	background: url(img/tango/16x16/mimetypes/text-html.png) no-repeat left top !important;
    }
    li.req a {
    	background: url(img/tango/16x16/mimetypes/x-office-presentation.png) no-repeat left top !important;
    }
    div.tc a {
    	background: url(img/tango/16x16/mimetypes/text-x-generic.png) no-repeat left top !important;
    	border: none;
    }
    div.tcs a {
    	background: url(img/tango/16x16/mimetypes/text-x-script.png) no-repeat left top !important;
    	border: none;
    }
    div a.del{
        background: url(img/tango/16x16/mimetypes/text-x-script.png) no-repeat left top !important;
        padding: 0px;
    }
    
    .dragspacer{
        
        display: block;
        float: left;
        width: 15px;
        height: 15px;
        
    }
    
    .dragspacer.draghandle{
    background: url(/img/side.png);
        border: 1px solid lightgrey;
    	cursor: move;
    }

    #tree li span.spacer, #tree div span, .pminus {
        display: block;
        float: left;
    	width: 15px;
    	height: 12px;
    	margin: 6px 3px 0 0;
    	cursor: pointer;
    }
    
    
    #tree li span.spacer.handle{
    	background: url(img/nolines_minus.gif) no-repeat left -4px;
    }

    #tree li.closed span.handle {
    	background: url(img/nolines_plus.gif) no-repeat left -4px;
    }
    #tree li.closed div, #tree li.closed li {
    	display: none;
    }

    .drop_hover{
        background: url(img/drag.png) no-repeat bottom left;
        background-position: 32px 16px;
        border: 1px solid lightgrey;
    }
    .hide{
        display: none !important;
    }
    .del{
        display: none;
    }
    ul .tc:hover > .del{
        display: inline;
    }
    #tree ul{
        border-left: 1px dashed lightgrey;
    }
    #tree > ul{
        border-left: none;
    }


  </style>
<div class="index">
<table>
<thead>
    <tr>
        <th>
            Project structure
        </th>
        <th class="tctd" style="width: 100px; display: none;">
            Testcases
        </th>
        <th style='width: 600px'>
            Details
        </th>
    </tr>
    </thead>
    <tbody>
    <tr style='vertical-align: top;'>
    
        <td style='border-right: 1px solid lightgrey;'>
        
        
        <script type="text/javascript">
            function dragdroptoggle(tree){
                tree.toggleSortable();
                $$('.handle').each(function(s, index) {
                  //alert(s);
                  
                  //s.toggle();
                });
                $$('.tc').each(Element.toggle);
                $('enablereqlink').toggle();
                $('disablereqlink').toggle();
                $('enabletclink').toggle();
            }
            
            function removetc(tc, req){
                new Ajax.Updater('log','/requirements/updatetc/remove/'+tc.id+'/'+req.id);
                tc.remove();
            }
            
            function tctoggle(){
                $$('.req').each(function(s, index) {
                  Droppables.add(s.id, {
                      accept: 'tc',
                      hoverclass: 'drop_hover',
                      onDrop: function(drag,drop) {

                            if($$('#'+drop.id+' > ul > #tc_'+drag.id)!=''){
                                $$('#'+drop.id+' > ul > #tc_'+drag.id).each(Element.highlight);
                                return;
                            }
                        

                            var newCopy = new Element('div', { 
                                                'id' : 'tc_'+drag.id, 
                                                'class' : 'tc',
                                            }).update(drag.innerHTML); 
                                            newCopy.setStyle({
                                                'clear':'both'
                                            });
                            //$(drop).down('ul').appendChild(newCopy); 
                            $(drop).down('ul').insert({'top':newCopy});
                            new Ajax.Updater('log','/requirements/updatetc/add/'+drag.id+'/'+drop.id);
                        
                      }
                    });
                });
                
                $$('ul .del').each(function(s, index) {
                    if(s.hasClassName('hide')) {
                      s.removeClassName('hide');
                    } else {
                      s.addClassName('hide');
                    }
                });
                
                
                $$('.tctd').each(Element.toggle);
                $('enabletclink').toggle();
                $('disabletclink').toggle();
                $('enablereqlink').toggle();
            }
            
        </script>
        <a href="#" id="enablereqlink" onclick="changeUrl('asdasd'); dragdroptoggle(tree); ">Reorder requirements</a>
        <a href="#" style='display: none;' id="disablereqlink" onclick="dragdroptoggle(tree)">Done reordering</a>
        <br />
        <a href="#" id="enabletclink" onclick="tctoggle()">Assign testcases</a>
        <a href="#" style='display: none;' id="disabletclink" onclick="tctoggle()">Done assigning</a>
        <br />
        <br />
            <ul>
                <li id="tree">
                <span class='pminus'></span>
                    <?php echo 
                        $ajax->link( 
                            $session->read('project_name'), 
                            array( 'controller' => 'projects', 'action' => 'view', $session->read('project_id')), 
                            array( 'update' => 'Main', 'class'=>'project' ));
                    ?>
                    <ul>
                        <?php echo $tree->show2('Requirement/name', $data); ?>
                    </ul>
                </li>
            </ul>
        </td>
        
        <td class="tctd" style='border-right: 1px solid lightgrey; display: none;'>
            
                <input type='text' id='tcsearch' name='data[tcsearch]' value='Filter...' onclick='if(this.value=="Filter..."){this.value=""}'/>
                <br />
                <br />
            <?php
                
                echo $ajax->observeField( 'tcsearch', 
                    array(
                        'url' => array( 'controller'=>'testcases', 'action' => 'lilist' ),
                        'frequency' => 1,
                        'update' =>'testcases'
                    ) 
                );
                
                ?>
            <div id='testcases'>
                (Fetching testcases...)
                <script type="text/javascript">
                    new Ajax.Updater('testcases', '/testcases/lilist', { method: 'get', evalScripts: true});
                </script>
            </div>
        </td>
        
        <td>
            <div id='Main'></div>
        </td>
    </tr>
    </tbody>
</table>
</div>
<div id="log"></div>
<script>

  var tree = new SortableTree('tree', {
    draggable:{
        handle: 'reqhandle'
    },
    droppable: {
      container: ':not(.tc)'
    },
    onDrop: function(drag, drop, event){
      //+'/'+drag.element.getAttribute('name')
      new Ajax.Updater('log','/requirements/reorder/'+drag.id()+'/'+drag.parent.id());

  }
  });
  //tree.setSortable();

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
