		<div id="contactUs" class="mainContent">
          <form id="emailForm" action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post" />
            <dl>
              <dt>Subject:</dt>
              <dd><input type="text" name="email_subject" value="<?php echo htmlspecialchars($t->email_subject);?>" /></dd>
              <dt>Reply To Email Address:</dt>
              <dd><input type="text" name="email_from_address" value="<?php echo htmlspecialchars($t->email_reply_address);?>" /></dd>
              <dt>Message:</dt>
              <dd><?php echo $this->elements['email_body']->toHtml();?></dd>
            </dl>
            <?php echo $this->elements['emailSubmit']->toHtml();?>
          </form>
          
         </div>