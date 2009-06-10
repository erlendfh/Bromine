<div id="results">
</div>
<script type="text/javascript">
<?php

    echo "new Ajax.PeriodicalUpdater('results', '/runrctests/status/$suite_id', {method: 'get', frequency: 0.5, decay: 2});";
    echo "new Ajax.Request('/runrctests/gridLauncher/$tests/$suite_id')";
?>
</script>
