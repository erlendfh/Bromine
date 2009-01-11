<h2>Login</h2>
<?php
echo $form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')));
echo $form->input('User.name');
echo $form->input('User.password');
echo $form->end('Login');
?>
