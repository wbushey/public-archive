<?php use_helper('Date') ?>
<?php foreach ($policies as $policy) : ?>
<?php $initial = VersionPeer::getFirstVersion($policy->getPid()) ?>
<?php $latest = VersionPeer::getLatestVersion($policy->getPid()) ?>
<div class='org'>
  <?php echo link_to(image_tag('doc_large.png'), 'policy/show?pid=' . $policy->getPid()) ?>
  <div class='info'>
    <h3><?php echo link_to($policy->getName(), 'policy/show?pid=' . $policy->getPid()) ?></h3>

    First Version Recorded: <?php echo link_to(format_datetime($initial->getRetrievedat()), 'version/show?vid=' . $initial->getVid()) ?><br/>
    
    <?php if ($latest->isFirst()) : ?>
      (No changes to this policy have been recorded.)
    <?php else: ?>
      Most Recent Edit: 
      <?php echo link_to(format_datetime($latest->getRetrievedat()), "diff/show?vid=" . $latest->getVid()) ?>
    <?php endif; ?>
  
  </div><!--info-->

  <br class='clear'/>
</div><!-- org -->
<?php endforeach; ?>