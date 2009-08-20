<div class="users form">
    
<?php 

if (!isset($registrated)){

    echo $form->create('Config', array('action' => 'register'));?>
	<fieldset>
 		<legend><?php __('Register Bromine');?></legend>
	<?php
        echo $form->input('name', array('label' => 'Type your name:'));
        echo "<br>";
        if(isset($name_error)){
            //echo "<p class='error'>$name_error</p>";
        }
		echo $form->input('email', array('label' => 'Email: (Leave blank if you don\'t want any newsletter or info from the Bromine team)'));
		if(isset($email_error)){echo "<p class='error'>$email_error</p>";}
		echo "<br>";
        echo $form->input('Size' , array('label' => 'Size of your company'));
		echo "<br>";
        echo $form->input('Employee', array('label' => 'No. of employees at your company'));
		echo "<br>";
        echo $form->input('Area', array('label' => 'Area of business'));
		echo "<br>";
        echo $form->input('Found', array('label' => 'Where did your found out about Bromine?'));
		echo "<br>";
        echo $form->input('Users', array('label' => 'How many are using Bromine at your company?'));
		echo "<br>";
        echo $form->input('usage',array('label' => 'Any other comments? eg. How are you using Bromine? How can we improve it? What should we change?', 'type' => 'testarea'));
	    echo $form->hidden('version',array('value' => $version));
	    echo $form->hidden('autoemail',array('value' => $autoemail));
	    
    ?>
	</fieldset>
<?php echo $form->end('Save registration');
} else{
    echo "<h2>$registrated<h2>";
}
?>
</div>