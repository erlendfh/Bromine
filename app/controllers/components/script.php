<?php 
class ScriptComponent extends Object
{
    var $controller = true;
    var $components = array('Session');
 
    function startup(&$controller)
    {
        // This method takes a reference to the controller which is loading it.
        // Perform controller initialization here.
    }
 
    function getTestScript($id, $asArray=false){
        App::import('Model','Type');
        $this->Type = new Type();
        $extList = $this->Type->find('list', array('fields' => array('Type.extension')));
        foreach($extList as $ext){
            $file = WWW_ROOT.'testscripts'.DS.$this->Session->read('project_name').DS.$ext.DS.$id.".$ext";
            if(file_exists($file)){
                if(!$asArray){
                    return htmlspecialchars(file_get_contents($file));
                }
                else{
                    $files[] = $file;
                }               
            }
        }
        if(isset($files)){
            return $files;
        }
        return false;
    }
}
?>