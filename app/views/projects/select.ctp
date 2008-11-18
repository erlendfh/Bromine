<h2><?php __('Select Project');?></h2>
<?php 
echo $form->create('Project',array('action' => 'select'));
$options[0]="";
foreach($usersprojects as $project){
    $options[$project['id']] = $project['name']; 
}
echo $form->input('project_id',array('options' => $options));
echo $form->end('Select');
if($controlPanelLink){
    echo "<br />";
    echo "Or go to the ";
    echo $html->link("Control Panel",array('controller'=>'Tabs', 'action' => 'admin'));
}
?>
