<table id='diffheader'><tr><td class='left side'>
  <div class='befaft'>
    Before:
  </div>
  <h3>
    <?php echo link_to($cur_ver->getPolicy()->getCompany()->getName() . " " . $cur_ver->getPolicy()->getName(), "version/show?vid=" . $pre_ver->getVid()) ?>
  </h3>
  <div class='when'>
    <?php if ($pre_ver->isWayback()): ?>
      Recorded by Archive.org on 
    <?php else: ?>
      Recorded by TOSBack on 
    <?php endif; ?>
    <?php echo format_date($pre_ver->getRetrievedat()) ?>.
  </div><!--when-->
  <div class='key'>
    Text highlighted in <span class='diffchange'>blue</span> has been deleted.
  </div><!--key-->

</td>
<td class='spacer'>&nbsp;</td>
<td class='right side'>
  <div class='befaft'>
    After:
  </div>
  <h3>
    <?php echo link_to($cur_ver->getPolicy()->getCompany()->getName() . " " . $cur_ver->getPolicy()->getName(), "version/show?vid=" . $cur_ver->getVid()) ?>
  </h3>
  <div class='when'>
    <?php if ($cur_ver->isWayback()): ?>
      Recorded by Archive.org on 
    <?php else: ?>
      Recorded by TOSBack on
    <?php endif; ?>    <?php print format_date($cur_ver->getRetrievedat()) ?>.
  </div><!--when-->
  <div class='key'>
    Text highlighted in <span class='diffchange'>yellow</span> has been added.
  </div><!--key-->

</td></tr></table>
<?php echo $sf_data->getRaw('diffhtml') ?>