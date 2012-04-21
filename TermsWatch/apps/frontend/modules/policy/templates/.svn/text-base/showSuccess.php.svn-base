<?php use_helper('Date') ?>
<?php foreach($versions as $i => $version) : ?>
<div class='policy'>
  <?php echo link_to(image_tag('doc_small.png'), 'version/show?vid=' . $version->getVid()) ?>
  <div class='info'>
    <h3><?php echo link_to('Version ' . ($versionCount - $i), 'version/show?vid=' . $version->getVid()) ?></h3>

    <div>
      <?php if ($version->isWayback()){
          if ($versionCount - $i == 1){
            print "Recorded ";
          } else {
            print "Changed around ";
          }
      	} elseif($version->isFirst()){
          print "Recorded ";
        } else {
          print "Changed ";
      }
      print format_datetime($version->getRetrievedat())."." ?>
    </div>

    <div class='links'>
  	<?php echo link_to('View Text', 'version/show?vid=' . $version->getVid()) ?>
      <?php if ( ($versionCount - $i) > 1): ?>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <?php echo link_to('View Changes', 'diff/show?vid=' . $version->getVid()) ?>
      <?php endif; ?>
    </div>
    
    <div class='source'>
      <?php 
      if ($version->isWayback()){
        print "Source: Archive.org";
      }
      ?>
    </div><!--source-->
    
  
  </div><!--orgtext-->

  <br class='clear'/>

</div><!-- org -->
<?php endforeach; ?>