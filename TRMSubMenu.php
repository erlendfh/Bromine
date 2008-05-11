<table class='subMenu'>
<tr>
  
  <td>  
    <div style='background: #66CC00; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='main.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Raw data'); ?>
      </a>
    </div>
  </td>

  <?php if(!$lite){ ?>
  <td>  
    <div style='background: #66CC00; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='analysis.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Analysis'); ?>
      </a>
    </div>
  </td>
  <td>  
    <div style='background: #66CC00; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='showReqs.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Show requirements'); ?>
      </a>
    </div>
  </td>
  <td>  
    <div style='background: #66CC00; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='showDefects.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Show defects'); ?>
      </a>
    </div>
  </td>
  <?php } ?>
</tr>
</table>
