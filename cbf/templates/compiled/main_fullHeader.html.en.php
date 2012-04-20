        <div id="sharedFauxBackground" class="sharedBacking"><!-- Dressing -->
        <div id="sidebarA">
          <div id="menu">
            <ul>
              <?php echo $t->menu;?>
            </ul>
          </div>
          <div id="overlap"></div>
          <div id="aftermath">
            <div id="winner" class="result">
              <p>The Winner</p>
              <div class="tinyImgWrapper"><img src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getPicsUrl'))) echo htmlspecialchars($t->getPicsUrl());?><?php if ($this->options['strict'] || (isset($t->winner) && method_exists($t->winner,'getThumbnail'))) echo htmlspecialchars($t->winner->getThumbnail());?>" /></div>
              <p><?php echo htmlspecialchars($t->winner_percentage);?>% of people agree with you</p>
            </div>
            <div id="loser" class="result">
              <p>The Loser</p>
              <div class="tinyImgWrapper"><img src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getPicsUrl'))) echo htmlspecialchars($t->getPicsUrl());?><?php if ($this->options['strict'] || (isset($t->loser) && method_exists($t->loser,'getThumbnail'))) echo htmlspecialchars($t->loser->getThumbnail());?>" /></div>
              <p><?php echo htmlspecialchars($t->loser_percentage);?>% of people think you are totally wrong</p>
            </div>
          </div>
        </div><!--[if !IE]> Close Sidebar A <![endif]-->
        <div id="topInnerCorners" class="innerCorners"></div> <!-- Dressing -->
        <div id="full_feedback_container">
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
        </div>