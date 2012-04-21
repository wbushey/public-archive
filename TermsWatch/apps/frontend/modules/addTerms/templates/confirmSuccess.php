<!-- DEBUGGING -->
<p>Command Executed:
<?php echo $cmd?></p>
<p>This is what we searched for:
<?php //echo $scrape_data?></p>
<!-- /DEBUGGING -->

<p><?php echo button_to('OK', 'addTerms/ok'); echo button_to('Cancel', 'addTerms/cancel');?><p>

<p>This is the data we got back:<p>
<?php echo $sf_data->getRaw('buffer');?>
