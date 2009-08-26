<?php
class PizzaController extends PizzaAppController {
    var $name = 'Pizza';
    var $uses = null;
    
    function index(){
        $this->set('gratz','gratz');   
    }
     
}
?>