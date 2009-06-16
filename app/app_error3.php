<?php
class AppError extends ErrorHandler {

function __construct($method, $messages) {
   Configure::write('debug', 1);
   parent::__construct($method, $messages);
}

function _outputMessage($template) {
   $this->controller->render($template);
   $this->controller->afterFilter();

    $this->log($this->controller->output);
    
}
function logf($text){
        $fp = fopen('C:\logs\log_BR.txt','a');
        fwrite($fp, time(). ': ' . $text."\n");
        fclose($fp);
    }

}
?>
