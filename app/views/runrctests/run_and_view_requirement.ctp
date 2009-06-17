<h2>Your tests are being executed. You can close this window if you like.</h2>
<p>You can track the status of your tests below</p> 
<div id="results">
</div>
<script type="text/javascript">
<?php
    echo "new Ajax.PeriodicalUpdater('results', '/runrctests/status/$suite_id', {method: 'get', frequency: 0.5, decay: 2});";
    echo "new Ajax.Request('/runrctests/runRequirement/$requirement_id/$suite_id')";
?>
</script>
