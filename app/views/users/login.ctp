<h1>Login</h1>
<?php
echo $form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')));
echo $form->input('User.name');
echo $form->input('User.password');
echo $form->end('Login');
?>
<br />
<br /> 
Developed and tested in firefox 3.5. 
<br />
Other browsers might work, but probably won't.
