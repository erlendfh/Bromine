<?php
    echo $form->create('Uploadtests', array('action' => 'add', 'type' => 'file'));
    echo $form->file('File');
    echo $form->submit('Upload');
    echo $form->end();
?>
