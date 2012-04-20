        <div id="recover" class="mainContent">
          <form id="recoverForm" action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post">
          	<p>Please enter your username below. A new password will be emailed to you.</p>
            <dl>
              <dt><label for="username">User Name: </label></dt> 
              <dd><input type="text" name="username" id="username" value="<?php if ($this->options['strict'] || (isset($t->user) && method_exists($t->user,'getUsername'))) echo htmlspecialchars($t->user->getUsername());?>" /></dd>
            </dl>
            <?php echo $this->elements['recover_submit']->toHtml();?>
          </form>
        </div>