<?php

    class Dataparser{
    
        var $uimap;
        var $datamap;
    
    
        function Dataparser($path){
            $this->path = str_replace("\\php", '',$path);
        }
        
        function parseURL($url){
            // $url = 'http://www.eniro.dk';
            $url = strtolower($url);
            $one = 1;
            $url = str_replace('http://', '', $url, $one);
            $url = str_replace('www.', '', $url, $one);
            //str_replace(mixed search, mixed replace, mixed subject, [int &count])
            return $url;
        }
        
        /*
         * Function getDataFromExcel parses data from an excel sheet, but the excel sheet must be setuped correct
         * Comments: It can't handle blank or empty inputs, unless it's the 1st locator en the datamap.         
         */         
    
        function getDataFromExcel($filename){
            
            $uimap = new Spreadsheet_Excel_Reader();
            $uimap->read($this->path."\\data\\uimap\\".$filename.".xls");
            
            $s = 0;
            foreach ($uimap->boundsheets as $ar){
                $i = 2;
                while($i <= $uimap->sheets[$s]['numRows']) {
                    if(!empty($uimap->sheets[$s]['cells'][$i][2]) && !empty($uimap->sheets[$s]['cells'][$i][3]) && strtolower($ar['name']) != 'datamap'){
                        $this->sheets[strtolower($ar['name'])][strtolower($uimap->sheets[$s]['cells'][$i][2])] = $uimap->sheets[$s]['cells'][$i][3];
                    }elseif(!empty($uimap->sheets[$s]['cells'][$i][2]) && strtolower($ar['name']) == 'datamap'){
                        $datafile = new Spreadsheet_Excel_Reader();
                        $datafile->read($this->path."\\".$uimap->sheets[$s]['cells'][$i][3]);
                        $j = 2;
                        while($j <= $datafile->sheets[0]['numRows']) {
                            if(!empty($datafile->sheets[0]['cells'][$j][2])){
                                if (empty($datafile->sheets[0]['cells'][$j][4])){
                                    $this->datamap[strtolower($datafile->sheets[0]['cells'][$j][2])] = $datafile->sheets[0]['cells'][$j][3];
                                }else{
                                    $y = 3;
                                    while (!empty($datafile->sheets[0]['cells'][$j][$y])) {
                                    	$this->datamap[strtolower($datafile->sheets[0]['cells'][$j][2])][] = $datafile->sheets[0]['cells'][$j][$y];
                                    	$y++;
                                    }
                                    
                                    
                                }
                            }
                            $j++;
                        }
                    }
                    $i++;
                }
                $s++;        
            }
        
            
            $this->uimap = $this->sheets;
            
        }
        
        function getDataFromXml(){
        
        }
    
    
    
    
    }
    /*
$dp = new Dataparser();
echo $dp->parseURL('http://www.eniro.dk');
*/
?>
