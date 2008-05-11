<?php 
  include_once('DBHandler.class.php');
  class graph{
  
    var $numPassed;
    var $numFailed;
    var $numErrors;
    
    var $numPassedPro;
    var $numFailedPro;
    var $numErrorsPro;
    var $numManuallyPassed;
    
    var $dbh;
    var $vertical;
    var $width;
    
    function __construct($numPassed, $numFailed, $numErrors = 0, $numManuallyPassed = 0, $width = 101, $vertical=true)
      {
        $this->dbh = new DBHandler($_SESSION['lang']);
        $this->numManuallyPassed = $numManuallyPassed;
        $this->vertical = $vertical;
        $this->numPassed = $numPassed;
        $this->numFailed = $numFailed;
        $this->numErrors = $numErrors;
        $this->width = $width;
      }
      
    function getGraph()
      { // BEGIN function getGraph
      $this->doMath();
      
      
      if ($this->vertical == true){
      
        $output = "
          <td style='width: ".$this->width."px;'>
            <img src='img/green.jpg' alt='passed' style='width: ".$this->numPassedPro."px; height:20px; border:none; padding: 0px;' title='".$this->dbh->getText('Passed').": ".$this->numPassedPro."%'/><img src='img/darkGreen.jpg' alt='passed manually' style='width: ".$this->numManPassedPro."px; height:20px; border:none; padding: 0px;' title='".$this->dbh->getText('manPassed').": ".$this->numManPassedPro."%'/><img src='img/yellow.jpg' alt='not done' style='width: ".$this->numErrorsPro."px; height:20px; border:none; padding: 0px;' title='".$this->dbh->getText('Error').": ".$this->numErrorsPro."%'/><img src='img/red.jpg' alt='failed' style='width: ".$this->numFailedPro."px; height:20px; border:none; padding: 0px;' title='".$this->dbh->getText('Failed').": ".$this->numFailedPro."%'/>
          </td>
          ";
          return $output;
      }
      else{
      	$output = "
          <td style='height: ".$this->width."px;'>
            <img src='img/green.jpg' alt='passed' style='height: ".$this->numPassedPro."px; width:20px; border:none; padding: 0px;' title='".$this->numPassedPro."%'/><br /><img src='img/yellow.jpg' alt='not done' style='height: ".$this->numErrorsPro."px; width:20px; border:none; padding: 0px;' title='".$this->numErrorsPro."%'/><br /><img src='img/red.jpg' alt='failed' style='height: ".$this->numFailedPro."px; width:20px; border:none; padding: 0px;' title='".$this->numFailedPro."%'/>
          </td>
          ";
          return $output;
      } // END function getGraph
    }
    
    function doMath()
    { // BEGIN function doMath
      $totalNum = $this->numPassed + $this->numManuallyPassed+ ($this->numFailed) + $this->numErrors;
      $this->numPassedPro = round($this->numPassed / $totalNum * 100);
      $this->numFailedPro = round($this->numFailed / $totalNum * 100);
      $this->numErrorsPro = round($this->numErrors / $totalNum * 100);
      $this->numManPassedPro = round($this->numManuallyPassed / $totalNum * 100);
    } // END function doMath
  
  }
?>
