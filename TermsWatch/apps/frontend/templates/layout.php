<?php use_helper('TermsWatch') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
    <div id="page">
	  <div id="header">
	    <div id="innerheader">
	      <a href="<?php echo termswatch_base_url() ?>/">
	        <h1 id="logo">
	          TOSBack
	        </h1>
	        <div id="tagline">
	          The terms-of-service tracker.
	        </div><!--tagline-->
	      </a>
	      
	      <a href="http://www.eff.org/">
	        <?php echo image_tag('eff_project.png', array('alt' => 'A Project Of the EFF', 'id' => 'projectof'));?>
	      </a>
	
	    </div><!--innerheader-->
	  </div><!--header-->	
	  
	  <?php if (has_slot('crumbs')) :?>
	    <div id='crumbs' ?>
	    <?php $crumbs = get_slot('crumbs') ?>
	    <?php $crumb = array_shift($crumbs) ?>
	    <?php echo $crumb ?>
	    <?php foreach($crumbs as $crumb): ?>
	      &raquo; <?php echo $crumb ?>
	    <?php endforeach; ?>
	    </div>
	  <?php endif; ?>
	  
	  <?php include_slot('mission') ?>
	    
	  <div id="body">
	  	<?php if (has_slot('sidebar')) : ?>
	      <div id="sidebar">
	        <?php include_component('sidebar', 'hello') ?>
	        
	        <?php include_component('sidebar', 'highlightedPolicies') ?>
	
			<?php include_component('sidebar', 'organizations') ?>
	        
	      </div><!--sidebar-->

	      <div id="content" class="narrow">
	    <?php else: ?>
	      <div id="content" class="wide">
	    <?php endif; ?>
	      <?php echo $sf_content ?>            
	    </div>
	
	  </div><!-- body-->
	
	  <div id="footer">
	    
	    <div id="innerfooter">
	      <a href="http://www.eff.org/"><h5>A Project of the Electronic Frontier Foundation | eff.org</h5></a>
	    </div><!--innerfooter-->
	    
	  </div><!--footer-->
	
	</div><!-- page -->
    
  </body>
</html>