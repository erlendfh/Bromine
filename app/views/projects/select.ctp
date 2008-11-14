<h2><?php __('Select Project');?></h2>
<?php 
echo $form->create('Project',array('action' => 'select'));
$options[0]="";
foreach($usersprojects as $project){
    $options[$project['id']] = $project['name']; 
}
echo $form->input('project_id',array('options' => $options));
echo $form->end('Select');
if($manageProjectsLink){
    echo "<br />";
    echo "Or ";
    echo $html->link("manage projects",array('controller'=>'Projects', 'action' => 'index'));
}
?>
