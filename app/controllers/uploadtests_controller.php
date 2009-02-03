<?php
class UploadtestsController extends AppController {

	var $name = 'Uploadtests';
	var $helpers = array('Html', 'Form');
	var $uses = 'Type';
	
    function add()
    {
    
        App::import('Model','Type'); // Import Type model to get the names og the different test type (PHP, rb, java, ect...)
        $modeltype = new Type();
    
        $projectname = $this->Session->read('project_name'); // Get the projectname from the Session
        
        //The allowed type of files to upload:
        $permitted = array('application/octet-stream','text/java'); //This allows PHP, rb & Java. Might need sme other types as well
        
        // The data submitted by the user:
        $type = $this->data['Uploadtest']['File']["type"];
        $size = $this->data['Uploadtest']['File']["size"];
        $error = $this->data['Uploadtest']['File']["error"];
        $name = $this->data['Uploadtest']['File']["name"];
        $tmp_name = $this->data['Uploadtest']['File']["tmp_name"];
        
        //Find the extention of the uploaded file 
        $ext = end(explode(".", $name));
        
        //Find the typename from the Type model
        $conditions = array('extension' => $ext);
        $result = $modeltype->find($conditions);
        $typename = $result['Type']['name'];
        
        //Put the target folder together.
        $targetfolder = "tests/$projectname/$typename/";
        
        // Add the WWW_ROOT constant to the targetfolder
        $folder = WWW_ROOT . $targetfolder;
        
        //Make sure that this is a permitted type of file
        if (in_array($type, $permitted))
        {
            //If any error print it
            if ($error > 0)
            {
                $this->Session->setFlash(__("Return Code: " . $error, true));
            }
            else
            {
                //Check if file exists
                if (file_exists($folder . $name))
                {
                    $this->Session->setFlash(__($targetfolder . $name . " already exists. ", true));
                }
                else
                {
                    //Does the actual upload
                    move_uploaded_file($tmp_name,$folder . $name);
                    $this->Session->setFlash(__("Stored in: " . $targetfolder . $name, true));
                }
            }
        }
        else
        {
            $this->Session->setFlash(__("This type of file is not allow ($type). Add this type in uploadtests_controller.php, array \$permitted", true));
        }

    }
}
?>