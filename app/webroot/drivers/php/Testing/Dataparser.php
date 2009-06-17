<?php

    class Dataparser{
    
        var $uimap;
        var $datamap;
    
        function parseURL($url){
            // $url = 'http://www.eniro.dk';
            $url = strtolower($url);
            $one = 1;
            $url = str_replace('http://', '', $url, $one);
            $url = str_replace('www.', '', $url, $one);
            //str_replace(mixed search, mixed replace, mixed subject, [int &count])
            return $url;
        }
    
        function getDataFromExcel($filename){
            
            $uimap = new Spreadsheet_Excel_Reader();
            $uimap->read("data/UImap/".$filename.".xls");
            
            $s = 0;
            foreach ($uimap->boundsheets as $ar){
                $i = 2;
                while($i <= $uimap->sheets[$s]['numRows']) {
                    if(!empty($uimap->sheets[$s]['cells'][$i][2]) && !empty($uimap->sheets[$s]['cells'][$i][3]) && strtolower($ar['name']) != 'datamap'){
                        $this->sheets[strtolower($ar['name'])][strtolower($uimap->sheets[$s]['cells'][$i][2])] = $uimap->sheets[$s]['cells'][$i][3];
                    }elseif(!empty($uimap->sheets[$s]['cells'][$i][2]) && strtolower($ar['name']) == 'datamap'){
                        $datafile = new Spreadsheet_Excel_Reader();
                        $datafile->read($uimap->sheets[$s]['cells'][$i][3]);
                        $j = 2;
                        while($j <= $datafile->sheets[0]['numRows']) {
                            if(!empty($datafile->sheets[0]['cells'][$j][2])){
                                $this->datamap[strtolower($datafile->sheets[0]['cells'][$j][2])] = $datafile->sheets[0]['cells'][$j][3];
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
