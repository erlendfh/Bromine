<table class='subMenu'>
<tr>
  <td>  
    <div style='background: rgb(176,196,222); font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='editProjects.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Projects'); ?>
      </a>
    </div>
  </td>
  <td>  
    <div style='background: rgb(176,196,222); font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='editHR.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('HR'); ?>
      </a>
    </div>
  </td>
  <?php if(!$lite){ ?>
  <td>  
    <div style='background: rgb(176,196,222); font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='editRequirements.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Requirements'); ?>
      </a>
    </div>
  </td>
  <?php } ?>
</tr>
</table>
