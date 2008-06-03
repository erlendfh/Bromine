<?php
/*
datatest howto:

laver en test der hedder dataTest+type
laver en datafil med type = type

f.eks. testen: dataTestbager.php har datafilen: bager.txt hvor første linje er type=bager

testresultaterne får navnet dataTest+type, så testcase navnet skal være lig dataTest+type
*/
require_once("fileManager.php");
require_once '../../../libs/DBHandler.php'; 
class suite{
  
  private $name;
  private $status = 'passed';
  private $environment;
  private $browser;
  private $platform;
  private $tests = array();
  private $passed = 0;
  private $failed = 0;
  private $cPassed = 0;
  private $cFailed = 0;
  private $cDone = 0;
  private $p_id = '1';
  private $b_id;
  private $fm;
  

  function __construct($name = "AUTONAME: Test Suite") //, $environment, $browser, $platform, $p_id, $logFile){
  {
    $this->name = $name;
    $this->environment = $_GET['sitetotest'];
    $this->browser = $_GET['browser'];
    $this->b_id = $_GET['b_id'];
    $this->platform = $_GET['o_id'];
    $this->p_id = $_GET['p_id'];
    /*
    $this->fm = new FileManager($_GET['logFile']);
    $this->fm->makefile();
    */
    $this->time=time();
    

  }
  
  function get($var){
    return $this->$var;
  }
  
  function checkStatus($test){
    return $test->get('status');
  }
  
  function changeStatus($status){
    $this->status = $status;
  }
  
  function addTest($newTest){
    //echo "Test: ".$newTest->get('name')." added!<br />";
    $this->tests[] = $newTest;
    if ($this->checkStatus($newTest) == 'failed'){
      $this->status = 'failed';
    }
    if($newTest->get("status") == 'failed'){
      $this->failed++;
    }
    else{
      $this->passed++;
    }
    $this->cPassed += $newTest->get('passed');
    $this->cFailed += $newTest->get('failed');
    $this->cDone += $newTest->get('done');
  }
    
  function showAll(){
    for($i = 0; $i<count($this->tests); $i++){
      $commands = $this->tests[$i]->get('commands');
      for($x = 0; $x<count($commands);$x++){
        $commands[$x]->view();
      }
    }
  }
  
  function do_post_request($url, $data, $optional_headers = null)
  {
    echo "Posting started!<br />";
    $params = array('http' => array(
                'method' => 'POST',
                'content' => $data
             ));
    if ($optional_headers !== null) {
      $params['http']['header'] = $optional_headers;
    }
    $ctx = stream_context_create($params);
    $fp2 = @fopen($url, 'rb', false, $ctx);
    if (!$fp2) {
      echo "Problem with $url, $php_errormsg<br />";
    }
    $response = stream_get_contents($fp2);
    if ($response === false) {
      echo "Problem reading data from $url, $php_errormsg<br />";
    }
    echo "Response from RCparser.php: $response<br />Posting done!";
    return $response;
  }
  
  function sendResult(){
    echo "Posting started!<br />";
    $testsArr = $this->getAsArray();
    $parser = new RCparser($this->name, $this->status, $this->environment, $this->b_id, $this->platform, $this->passed, $this->failed, $this->cPassed, $this->cFailed, $this->cDone, $this->p_id, $this->getTime(), $testsArr);
    echo "Posting done<br />";
  }
  
  function getAsArray(){
    for($i = 0; $i<count($this->tests); $i++){
      $testsArr[] = $this->tests[$i]->getAsArray();
    }
    
    $suiteArr = array('suiteName' => $this->name, 'suiteStatus' => $this->status, 'environment' => $this->environment , 'browser' => $this->b_id, 'OS' =>  $this->platform,
    'noOfPassedTest' => $this->passed,  'noOfFailedTest' => $this->failed, 'noOfCommandsPassed' => $this->cPassed, 'noOfCommandsFailed' =>$this->cFailed, 'noOfCommandsDone' => $this->cDone, 'p_id' => $this->p_id , 
    'timeTaken' => $this->getTime(),'arrayOfTests' => $testsArr);   
    
    return $suiteArr; 
  }

  function parseURL($url)
  {
    $url = strtolower($url);
  	
  	$s = split('/', $url);
  	$url = $s[0]."//".$s[2];
  	return $url;
  }
  
  function getTime(){
    $sec = time() - $this->time;
    return $sec;
  }
  
  function createSuite(){
    $o_id = $_GET['OS'];
    $this->dbh = new DBHandler();
    $this->s_id=$this->dbh->insert('TRM_suite',
    "
    NULL,  
    '$this->name',
    '$this->environment',
    '',
    '".date('Y-m-d H:i:s')."',
    '',
    '$this->b_id',
    '$o_id',
    'RC',
    '',
    '',
    '',
    '',
    '',
    '0',
    '$this->p_id'"
    ,
    "
    ID,
    suitename,
    environment,
    status,
    timeDate,
    timeTaken,
    browser,
    platform,
    selenium_version,
    selenium_revision,
    numTestPassed,
    numTestFailed,
    numCommandsPassed,
    numCommandsFailed,
    numCommandsErrors,
    p_id
    "
    );
    $this->dbh->disconnect();
    return $this->s_id;
  }
  
  function finalizeSuite($countTests, $countCommands){
    $lang = $_GET['lang'];
    $this->dbh = new DBHandler($lang);
    $time = $this->getTime();
    $this->dbh->update('TRM_suite',"timeTaken = '$time', status = '$this->status', numTestPassed = '$this->passed',
      numTestFailed = '$this->failed',
      numCommandsPassed = '$this->cPassed',
      numCommandsFailed = '$this->cFailed',
      numCommandsErrors = '$this->cErrors'", "id = '$this->s_id'");
      //echo "Suite $name Created!<br />";
    echo "Suite ".$this->name." ".$this->dbh->getText('Created')."!<br />";
    echo $this->dbh->getText('Succesfully inserted').": ".$countTests." ".$this->dbh->getText('out of')." ".$countTests." ".$this->dbh->getText('tests')." & ".$countCommands." ".$this->dbh->getText('out of')." ".$countCommands." ".$this->dbh->getText('commands')."!";
    $this->dbh->disconnect();
  }

}
?>
