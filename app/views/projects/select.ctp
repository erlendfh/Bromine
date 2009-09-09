<h2><?php __('Select Project');?></h2>
<?php
if(!empty($userprojects)){
    echo $form->create('Project',array('action' => 'select'));
    $options[0]="";
    foreach($userprojects as $project){
        $options[$project['id']] = $project['name']; 
    }
    echo $form->input('project_id',array('options' => $options));
    echo $form->end('Select');
    echo "<br />";
}else{
    echo "You do not have access to any projects. Contact an administrator";
}
echo $html->link("Or go to the Control Panel",array('controller' => 'projects', 'action' => 'index'));

?>
