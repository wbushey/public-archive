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
        <div id="skyAd">
            <!-- Beginning of Project Wonderful ad code: -->
            <!-- Ad box ID: 24623 -->
            <script type="text/javascript">
            <!--
            var d=document;
            d.projectwonderful_adbox_id = "24623";
            d.projectwonderful_adbox_type = "3";
            d.projectwonderful_foreground_color = "";
            d.projectwonderful_background_color = "";
            //-->
            </script>
            <script type="text/javascript" src="http://www.projectwonderful.com/ad_display.js"></script>
            <!-- End of Project Wonderful ad code. -->
        </div>
      </div>
      <div id="masterhead">
        <h1><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>"><img id="logo" src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getLayoutUrl'))) echo htmlspecialchars($t->getLayoutUrl());?>/img/cbf_logo.$ext" /></a></h1>
        <div id="bannerAd">
          <a href="http://www.startreknewvoyages.com/"><img src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getLayoutUrl'))) echo htmlspecialchars($t->getLayoutUrl());?>/img/trek.jpg" /></a>
        </div>
      </div>