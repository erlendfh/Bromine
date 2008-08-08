<?php
/*http://testserver/testRunnerRC.php
?test=genericSuite.php
&type=rc-php
&n_id=23
&b_id=1
&user=rbp
&pass=d24aee31d8c429f566bfdd8fdc6b9108
&p_id=120
&p_name=Thunderball%20auto
&sitetotest=http://www.krak.dk
&suitename=zcfdg
&lang=en
&tests[]=company_advanced_error_validation_short
&tests[]=company_on_map_short
&tests[]=company_profile_page
&tests[]=map_starting_point
*/
foreach($tests as $key=>$test){
    $command = $type[$key];
    exec("$command $test")
}



?>
