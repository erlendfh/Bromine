<?php
class PizzaController extends PizzaAppController {
    var $name = 'Pizza';
    var $uses = null;
    
    function index(){
        $this->layout = null;
        $this->view = null;
        header("Location: http://www.google.com/search?q=pizza&btnI");   
    }
     
}
?>