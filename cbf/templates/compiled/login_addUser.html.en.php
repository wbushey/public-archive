        <div id="register" class="mainContent">
          <form id="registerForm" action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post">
            <dl>
              <dt><label for="username">User Name: </label></dt> 
              <dd><input type="text" name="username" id="username" value="<?php echo htmlspecialchars($t->entered_username);?>" /></dd>
              <dt><label for="emailAddress">Email Address: </label></dt>
              <dd><input type="text" name="emailAddress" id="emailAddress" value="<?php echo htmlspecialchars($t->entered_address);?>" /></dd>
              <dt><label for="password">Password: </label></dt> 
              <dd><?php echo $this->elements['password']->toHtml();?></dd>
              <dt><label for="confirmPassword">Confirm Password: </label>
              <dd><?php echo $this->elements['confirmPassword']->toHtml();?></dd>
            </dl>
            <?php echo $this->elements['register_submit']->toHtml();?>
          </form>
        </div>