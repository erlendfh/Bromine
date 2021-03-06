<div class="users form">
<p>
    Registering will help us understand our users. Moreover it will let us have an idea of how many are using Bromine, which will encourage us to continue our efforts
</p>      
<?php 

if (!isset($registrated)){
    if(isset($regError)){
        echo '<div class="error">'.$regError['respons'].'<br />'.$regError['content'].'<a href="'.$regError['url'].'">'.$regError['url'].'</a></div>';
    }
    echo $form->create('Config', array('action' => 'register'));?>
	<fieldset>
 		<legend><?php __('Register Bromine');?></legend>
	<?php
        echo $form->input('name', array('label' => 'Type your name:'));
        echo "<br>";
		echo $form->input('email', array('label' => 'Email: (Leave blank if you don\'t want any newsletter or info from the Bromine team)'));
		if(isset($email_error)){echo "<p class='error'>$email_error</p>";}
		echo "<br>";
        echo $form->input('Size' , array('label' => 'Your company\'s annual turnover'));
		echo "<br>";
        echo $form->input('Employee', array('label' => 'No. of employees at your company'));
		echo "<br>";
        echo $form->input('Area', array('label' => 'Area of business'));
		echo "<br>";
        echo $form->input('Found', array('label' => 'How did you come to know about Bromine?'));
		echo "<br>";
        echo $form->input('Users', array('label' => 'How many are (or will be) using Bromine at your company?'));
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