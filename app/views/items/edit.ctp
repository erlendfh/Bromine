<div id='select'>
<?php
    echo $form->create('Item');
    echo $form->input('id');
    echo $form->input('Model',array('selected'=>'Select', 'onchange'=>
    '
    $("opts").hide();
    $("requirements").hide();
    $("testcases").hide();
    if(this.value!="Select"){
        $("opts").show();
        if(this.value == "Requirement"){
            $("requirements").show();
        }
        if(this.value == "Testcase"){
            $("testcases").show();
        }
    }
    ;'
    ));
    echo "<div id='requirements' style='display: none;'>";
    echo $form->input('Requirement', array('selected'=>'All', 'multiple'=>true));
    echo "</div>";
    echo "<div id='testcases' style='display: none;'>";
    echo $form->input('Testcase', array('selected'=>'All', 'multiple'=>true));
    echo "</div>";
    echo "<div id='opts' style='display: none;'>";
    echo $form->input('Browser', array('selected'=>'All', 'multiple'=>true));
    echo $form->input('Operatingsystem', array('selected'=>'All', 'multiple'=>true));
    echo $form->input('Status', array('selected'=>'All', 'multiple'=>true));
    echo $form->input('From',array('class'=>'dateformat-d-sl-m-sl-Y'));
    echo $form->input('To',array('class'=>'dateformat-d-sl-m-sl-Y'));
    //echo $ajax->submit("Submit", array("url" => array('controller'=>'query','action'=>'getData'), "update" => "join"));
    echo $form->end('Submit');
    echo "</div>";
?>
</div>
<div id="join"></div>
