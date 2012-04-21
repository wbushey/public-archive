<?php use_helper('TermsWatch') ?>
<?php $rawVersion = $sf_data->getRaw('version') ?>
<?php echo termswatch_filter($rawVersion->getContent()) ?>
