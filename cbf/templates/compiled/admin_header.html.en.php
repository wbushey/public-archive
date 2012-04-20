<?php echo "<"; ?>?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel='stylesheet' media="screen" type='text/css' href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getLayoutUrl'))) echo htmlspecialchars($t->getLayoutUrl());?>/css/screen/admin_master.css' />
    <?php if ($this->options['strict'] || (is_array($t->javascripts)  || is_object($t->javascripts))) foreach($t->javascripts as $js) {?>
    <script type="text/javascript" src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getJsUrl'))) echo htmlspecialchars($t->getJsUrl());?><?php echo htmlspecialchars($js);?>"></script>
    <?php }?>
    <title><?php echo htmlspecialchars($t->page_title);?></title>
</head>
<body>
    <div id="masterhead">
        <div id="logo">
            <p>CBF</p>
            <p>Admin</p>
        </div>
    </div>
    <div id="sidebar">
    	<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'isAuthorized'))) if ($t->isAuthorized()) { ?>
        <ul>
            <li><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>/admin/celebrities">Celebrities</a></li>
            <li><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>/admin/celebrities/addCelebrity">Add A Celebrity</a></li>
            <li><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>/admin/fights">Fights</a></li>
            <li><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>/admin/fights/addFight">Add A Fight</a></li>
            <li><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>/admin/users">Users</a></li>
            <li><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>/admin/bans/ipBans">IP Bans</a></li>
            <li><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>/admin/ads">Ads</a></li>
            <li><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'get_controller_url'))) echo htmlspecialchars($t->get_controller_url());?>/admin/ads/addAd">Add An Ad</a></li>
        </ul>
        <?php }?>
    </div>
    <div id="content">
    <?php if ($t->hasErrors)  {?>
        <div id="page_errors">
            <ul>
            <?php if ($this->options['strict'] || (is_array($t->errors)  || is_object($t->errors))) foreach($t->errors as $error) {?>
                <li><?php echo $error;?></li>
            <?php }?>
            </ul>
        </div>
    <?php }?>
    <?php if ($t->hasMessages)  {?>
        <div id="page_messages">
            <ul>
            <?php if ($this->options['strict'] || (is_array($t->messages)  || is_object($t->messages))) foreach($t->messages as $message) {?>
                <li><?php echo $message;?></li>
            <?php }?>
            </ul>
        </div>
    <?php }?>