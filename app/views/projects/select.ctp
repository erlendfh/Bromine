<h2><?php __('Select Project');?></h2>
<?php
echo $form->create('Project',array('action' => 'select'));
$options[0]="";
foreach($usersprojects as $project){
    $options[$project['Project']['id']] = $project['Project']['name']; 
}
echo $form->input('project_id',array('options' => $options));
echo $form->end('Select');
echo "<br />";
echo $html->link("Or go to the Control Panel",array('controller' => 'tabs','action' => 'menulink', 34, -2, 'Users', 'index'));

?>
