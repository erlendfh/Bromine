<div id='select'>
<h2>SELECT FROM</h2>
<?php
    echo $form->create('Query');
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
    echo "<h2>WHERE Requirement = </h2>";
    echo $form->input('Requirement', array('selected'=>'All', 'multiple'=>true));
    echo "</div>";
    echo "<div id='testcases' style='display: none;'>";
    echo "<h2>WHERE Testcase = </h2>";
    echo $form->input('Testcase', array('selected'=>'All', 'multiple'=>true));
    echo "</div>";
    echo "<div id='opts' style='display: none;'>";
    echo "<h2>AND Browser = </h2>";
    echo $form->input('Browser', array('selected'=>'All', 'multiple'=>true));
    echo "<h2>AND Operatingsystem = </h2>";
    echo $form->input('Operatingsystem', array('selected'=>'All', 'multiple'=>true));
    echo "<h2>AND Status = </h2>";
    echo $form->input('Status', array('selected'=>'All', 'multiple'=>true));
    echo "<h2>AND Date &gt; </h2>";
    echo $form->input('From',array('class'=>'dateformat-d-sl-m-sl-Y'));
    echo "<h2>AND Date &lt; </h2>";
    echo $form->input('To',array('class'=>'dateformat-d-sl-m-sl-Y'));
    echo $ajax->submit("Submit", array("url" => array('controller'=>'query','action'=>'getData'), "update" => "join"));
    echo "</div>";
?>
</div>
<div id="join"></div>
