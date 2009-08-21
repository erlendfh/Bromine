<?php
class ConfigsController extends AppController {

	var $name = 'Configs';
	var $helpers = array('Html', 'Form');
	var $main_menu_id = -2; 
	var $uses = array();
	
	function checkForUpdates(){
        $c = 0;

        $serverpath = 'http://192.168.0.101/app/webroot/updates/';
        $u = file($serverpath.'updates.txt');
        $updates = array();
        foreach ($u as $value) {
        	$updates[] = str_replace("\r\n",'',$value);
        }
        
        pr($updates);
        
        if (end($updates) == $this->version){
            echo "no new updates";
        }else{
            $c = array_search($this->version, $updates);
            $c++;
            echo count($updates) - $c;
            echo " new update(s)!";
        
            foreach ($updates as $key=>$value) {
                    
                    if ($handle = opendir($serverpath . "$value/")) {
                    while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != "..") {
                            echo "$file\n";
                        }
                    }
                    closedir($handle);
                }
            	echo "install update $value<br />";
            }
        
        }
    
    }
	
    function register(){
        $employees = array('private' => 'Will not disclose',
                        'very small(1)' => 'Only me',
                        'small (+10)' => '10+ Employees',
                        'medium (+50)' => '50+ Employees',
                        'large (+100)' => '100+ Employees',
                        'very large (+500)' => '500+ Employees',
                        'global (+1000)' => '1000+ Employees');
                        
        $areas = array('private' => 'Will not disclose',
                        'IT development' => 'IT development',
                        'Telecommunication' => 'Telecommunication',
                        'Software QA' => 'Software QA',
                        'other' => 'other');
        

        
        $sizes = array('private' => 'Will not disclose',
                        '< €10.000' => '< €10.000 in turnover',
                        '< €10.000+' => '< €10.000 in turnover',
                        '< €50.000+' => '< €50.000 in turnover',
                        '< €100.000+' => '< €100.000 in turnover',
                        '< €500.000+' => '< €500.000 in turnover',
                        '< €1.000.000+' => '< €1.000.000 in turnover',
                        '> €1.000.000' => '> €1.000.000 in turnover');
                        
        $users = array('private' => 'Will not disclose',
                        '1' => 'Just me',
                        '< 5' => '< 5 Bromine users',
                        '< 10' => '< 10 Bromine users',
                        '< 25' => '< 25 Bromine users',
                        '< 50' => '< 50 Bromine users',
                        '< 100' => '< 100 Bromine users',
                        '< 500' => '< 500 Bromine users',
                        '> 500' => '> 500 Bromine users');                
        
        $founds = array('private' => 'Will not disclose',
                        'search engine' => 'from a search engine (Google, Yahoo, eg.)',
                        'openqa.org' => 'http://openqa.org',
                        'recommendations' => 'recommendations from a friend/colleague',
                        'other' => 'other');
                        
                        
        $this->set('employees',$employees);
        $this->set('areas',$areas);
        $this->set('sizes',$sizes);
        $this->set('users',$users);
        $this->set('founds',$founds); 	
        
        $reg = $this->Config->findByName('registered');
        if ($reg['Config']['value'] == 1){
            $this->set('registrated','You have already registered this version of Bromine. Thanks');
        }
        
        $reg = $this->Config->findByName('email on error');
        $this->set('autoemail',$reg['Config']['value']);
        
	   if (empty($this->data)){
              
       } else{
            $error = false;
            if ($this->data['Config']['name'] == ""){
                $this->set('name_error' , 'You can\'t leave this field blank, please write you name');
                $error = true;
            }
            
            if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$", $this->data['Config']['email']) && $this->data['Config']['email'] != '' ){
                $this->set('email_error' , 'You email is not valid.');
                $error = true;
            }
            $respons = $this->do_post_request('http://bromine.test-lab.dk/register.php', http_build_query($this->data['Config'], '', '&amp;'));
            
            if(!empty($respons)){
                $error = true;
                $this->set('regError', array('respons' => $respons, 'content' => 'There was a problem with the registration, please try again later. Please report the above error on ', 'url' => 'http://clearspace.openqa.org/community/selenium/bromine'));
            }
            if (!$error){
                // Save this to a external db
                $this->Config->updateAll(
                    array('Config.value' => '1'),
                    array('Config.name' => 'registered')
                );

                $this->set('registrated','Thank you for your registration.');
            }    
       }  
    }
    
    function do_post_request($url, $data, $optional_headers = null)
    {
        $params = array('http' => array(
        		  'method' => 'POST',
        		  'content' => $data
        	   ));
        if ($optional_headers !== null) {
            $params['http']['header'] = $optional_headers;
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if (!$fp) {
            throw new Exception("Problem with $url, $php_errormsg");
        }
        $response = @stream_get_contents($fp);
        if ($response === false) {
            throw new Exception("Problem reading data from $url, $php_errormsg");
        }
        return $response;
    } 

    
    function help(){
        echo (file_get_contents('http://wiki.openqa.org/display/BR/Automatic+requirement+analysis'));
    }
    
    function sendUsMailWhenBromineFails($bool = ''){

            if ($bool == 'true'){
                $reg = $this->Config->findByName('email on error');
                if ($reg['Config']['value'] == 1){
                    $this->set('msg','You are already emailing us on error. Thanks!');
                } else{
                    $this->Config->updateAll(
                        array('Config.value' => '1'),
                        array('Config.name' => 'email on error')
                    );
                    //rename app_error file
                    $file = getcwd() . '\..\app_error.php_disabled';
                    $newfile = getcwd() . '\..\app_error.php2';
                    if (!is_file($file)){
                        $this->set('msg',"Bromine find this file: '$file', does it exist?");    
                    }else{
                        if (rename($file, $newfile)){
                            $this->set('msg','You will now send us a mail, when Bromine causes an error. Thanks!');
                        } else{
                            $this->set('msg',"Bromine could NOT rename this file: '$file', does it exist?");
                        }
                        
                    }
                }       
            }elseif ($bool == 'false'){
                 $reg = $this->Config->findByName('email on error');
                if ($reg['Config']['value'] == '0'){
                    $this->set('msg','You are already NOT emailing us on error.');
                } else{
                    $this->Config->updateAll(
                        array('Config.value' => '0'),
                        array('Config.name' => 'email on error')
                    );
                    //rename app_error file
                    $newfile = getcwd() . '\..\app_error.php_disabled';
                    $file = getcwd() . '\..\app_error.php2';
                    if (!is_file($file)){
                        $this->set('msg',"Bromine find this file: '$file', does it exist?");    
                    }else{
                        if (rename($file, $newfile)){
                            $this->set('msg','You will now NOT send us a mail, when Bromine causes an error.');
                        } else{
                            $this->set('msg',"Bromine could NOT rename this file: '$file', does it exist?");
                        }
                        
                    }
                } 
        }
    }
    
    function stateOfTheSystem(){
        $state = array();
        $output = array();
        $state['Permissions output'] = "";
        //pr($this->directoryToArray('testscripts/eniro/',true));
        
        // Test for Java
        exec('java -version', $java_output, $java_return);
        $state['Java'] = $java_return;
        $output['Java'] = implode(",", $java_output);
        
        // Test for Ruby
        exec('ruby -v', $ruby_output, $ruby_return);
        $state['Ruby'] = $ruby_return;
        $output['Ruby'] = implode(",", $ruby_output);
        
        // Test for PHP
        exec('php --version', $php_output, $php_return);
        $state['Php'] = $php_return;
        $output['Php'] = implode(",", $php_output);
        
        // Test for Magic Quotes
        $mq_return = get_magic_quotes_gpc();
        $state['Magic Quotes'] = $mq_return;
        
        // Test for Max execution time
        $max_exec_time = ini_get('max_execution_time');
        $state['Max execution time'] = $max_exec_time;

        // Send mail on error
        App::import('Model','Config');
        $config = new Config();
        $reg = $config->findByName('registered');
        $mail = $config->findByName('email on error');
        $state['Registrated Bromine'] = $reg['Config']['value'];
        $state['Email developers on error'] = $mail['Config']['value'];
        
        // Test for filepermissions
        //echo getcwd();
        $permission2 = is_writeable("testscripts/".$this->Session->read('project_name'));
        $permission3 = is_writeable("logs");
        $permission4 = is_writeable("img/temp");
        
        App::import('Model','Type');
        $this->Type = new Type();
        $extList = $this->Type->find('list', array('fields' => array('Type.extension')));
        
        $state['Permissions'] = true;
        foreach ($extList as $value) {
        	if(!is_writeable("testscripts/".$this->Session->read('project_name')."/".$value)){
                $state['Permissions'] = false;
                $state['Permissions output'] = $state['Permissions output'] . ", testscripts/".$this->Session->read('project_name')."/".$value;
            }
        }
        
        $state['Logs dir'] = $permission3;
        $state['Img/temp dir'] = $permission4;
        $this->set('current_project',$this->Session->read('project_name'));
        
        
        // Set the arrays for the viewer
        $this->set('state',$state);
        $this->set('output',$output);
        
        
    }

}
?>