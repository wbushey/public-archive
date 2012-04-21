<?php use_helper('Date'); ?>
<?php foreach($rsses as $rssItem) : ?>
<item>
 <title><?php if (VersionPeer::isFirst($rssItem['flags'])){ 
    print "Tracking a new policy: ".$rssItem['companyName'] . " " . $rssItem['policyName'];
  } else {
    print "Policy change: " . $rssItem['companyName'] . " " . $rssItem['policyName'];
  } ?></title>
 <pubDate><?php echo format_date($rssItem['retrievedAt']) ?></pubDate>
 <link><?php if(VersionPeer::isFirst($rssItem['flags'])): ?>
   <?php echo url_for('policy/show?pid=' . $rssItem['pid'], true)?>
 <?php else: ?>
   <?php echo url_for('diff/show?vid=' . $rssItem['vid'], true)?>
 <?php endif; ?></link>
 <guid><?php if(VersionPeer::isFirst($rssItem['flags'])): ?>
   <?php echo url_for('policy/show?pid=' . $rssItem['pid'], true)?>
 <?php else: ?>
   <?php echo url_for('diff/show?vid=' . $rssItem['vid'], true)?>
 <?php endif; ?></guid>
</item>
<?php endforeach; ?>