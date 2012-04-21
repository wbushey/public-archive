<?php use_helper('TermsWatch') ?>
<?php use_helper('Date') ?>
<div id='explanation'>
TOSBack keeps an eye on <?php echo $numOfPolicies ?> website policies.<br/>
Every time one of them changes, you'll see an update here.
</div>
<?php foreach ($results as $version) :?>
<div class='timeline'>  

  <?php if (!empty($version['image_small'])): ?>
    <?php if (VersionPeer::isFirst($version['flags'])): ?>
      <?php echo link_to(termswatch_org_image_tag($version['image_small'], "width=70 height=70"), "policy/show?pid=" . $version['pid']) ?>
    <?php else: ?>
      <?php echo link_to(termswatch_org_image_tag($version['image_small'], "width=70 height=70"), "diff/show?vid=" . $version['vid']) ?>
    <?php endif; ?>
  <?php endif; ?>

  <div class='info'>
    <h3>
      <?php if (VersionPeer::isFirst($version['flags'])): ?>
        <?php echo link_to('TOSBack started tracking a new policy.', "policy/show?pid=" . $version['pid']) ?>
      <?php else: ?>
        <?php echo link_to($version['companyName'], "diff/show?vid=" . $version['vid']) ?>
      <?php endif; ?>
    </h3>

    <div class='changed'>
      <?php if (VersionPeer::isFirst($version['flags'])): ?>
        It's the <?php print $version['companyName'] ." ". $version['policyName'] ?>.
      <?php else: ?>
        changed its <?php print $version['policyName'] ?>
    <?php endif;?>
    </div><!--changed-->

    <div class='when'>
      <?php print format_datetime($version['retrievedAt']) ?>
    </div><!--when-->
  </div><!-- info-->

  <br class='clear'/>

</div><!--timeline-->
<?php endforeach; ?>