        <div id="login" class="mainContent">
          <form id="loginForm" action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post">
            <dl>
              <dt><label for="username">User Name: </label></dt> 
              <dd><input type="text" name="username" id="username" value="<?php if ($this->options['strict'] || (isset($t->user) && method_exists($t->user,'getUsername'))) echo htmlspecialchars($t->user->getUsername());?>" /></dd>
              <dt><label for="password">Password: </label></dt> 
              <dd><?php echo $this->elements['password']->toHtml();?></dd>
            </dl>
            <?php echo $this->elements['login_submit']->toHtml();?>
          </form>
          <p><a href="<?php echo $t->lost_password_url;?>">Forgot your password? Click here to recieve a new password.</a></p>
        </div>