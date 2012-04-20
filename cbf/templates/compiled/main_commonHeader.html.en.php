<?php echo "<"; ?>?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta name="description" content="Two drunk celebrities, one back-alley brawl. Who wins? You Decide." />
    <!-- Wow I hate Internet Explorer -->
    <link rel='stylesheet' media="screen" type='text/css' href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getLayoutUrl'))) echo htmlspecialchars($t->getLayoutUrl());?>/css/screen/master.css' />
    <![if lt IE 7]>
    <link rel='stylesheet' media="screen" type='text/css' href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getLayoutUrl'))) echo htmlspecialchars($t->getLayoutUrl());?>/css/screen/ie-lt7.css' />
    <![endif]>
    <![if gte IE 7]>
    <link rel='stylesheet' media="screen" type='text/css' href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getLayoutUrl'))) echo htmlspecialchars($t->getLayoutUrl());?>/css/screen/ie-gte7.css' />
    <![endif]>
    <![if !IE]>
    <link rel='stylesheet' media="screen" type='text/css' href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getLayoutUrl'))) echo htmlspecialchars($t->getLayoutUrl());?>/css/screen/standard.css' />
    <![endif]>
    <?php if ($this->options['strict'] || (is_array($t->javascripts)  || is_object($t->javascripts))) foreach($t->javascripts as $js) {?>
    <script type="text/javascript" src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getJsUrl'))) echo htmlspecialchars($t->getJsUrl());?><?php echo htmlspecialchars($js);?>"></script>
    <?php }?>
    <title><?php echo htmlspecialchars($t->page_title);?></title>
  </head>
  <body>
    <div id="span">
      <div id="sidebarB">
             <div id="skyAd_top"></div>
             <div id="skyAd_body">
                <?php echo $t->right_1;?>
             </div>
             <div id="skyAd_bottom"></div>
      </div>
      <div id="masterhead">
        <h1><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>"><img id="logo" src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getLayoutUrl'))) echo htmlspecialchars($t->getLayoutUrl());?>/img/cbf_logo.png" /></a></h1>
        <div id="bannerAd">
          <?php echo $t->top;?>
        </div>
      </div>