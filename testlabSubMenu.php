<table class='subMenu'>

<tr>
  <?php if(!$lite){ ?>
  <td>  
    <div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='editTestCase.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Testcases'); ?>
      </a>
    </div>
  </td>
  <?php } ?>
  <?php if(!$lite){ ?>
  <td>  
    <div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='editTestPlan.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Test Plan'); ?>
      </a>
    </div>
  </td>
  <?php } ?>
  <?php if(!$lite){ ?>
  <td>  
    <div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='simpleFTP.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Edit node tests'); ?>
      </a>
    </div>
  </td>
  <?php } ?>
  <td>  
    <div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='editCoreSuites.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Edit core suites'); ?>
      </a>
    </div>
  </td>
</tr>
<tr>
  <td>  
    <div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='corerunner.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Testrunner core'); ?>
      </a>
    </div>
  </td>
  <td>  
    <div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='genericRunner.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Testrunner nodes'); ?>
      </a>
    </div>
  </td>
  <?php if(!$lite){ ?>
  <td>  
    <div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='manualRunner.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Manual runner'); ?>
      </a>
    </div>
  </td>
  <?php } ?>
  <?php if(!$lite){ ?>
  <!--td>  
    <div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='editCron.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Schedule tests'); ?>
      </a>
    </div>
  </td-->
  <?php } ?>
</tr>
</table>
