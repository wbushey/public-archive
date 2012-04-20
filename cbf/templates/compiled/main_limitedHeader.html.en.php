        <div id="sharedBackground" class="sharedBacking"><!-- Dressing -->
        <div id="sidebarA">
          <div id="menu">
            <ul>
              <?php echo $t->menu;?>
            </ul>
          </div>
          <div id="roundedEnd"></div>
        </div><!--[if !IE]> Close Sidebar A <![endif]-->
        <div id="topInnerCorners" class="innerCorners"></div> <!-- Dressing -->
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