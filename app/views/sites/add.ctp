<?php
$id = uniqid('site');
echo "<div class='input text' id='$id'>";
echo "<input name='data[Newsites][]' type='text' value='http://www.' />"; 
echo $html->link( 
                'Remove', 
                '#',
                array('onclick' => "
                    if(confirm('Are you sure you want to remove this site?')){ 
                        $('$id').remove();
                    }"
                )
            );
echo "</div>";

 ?>