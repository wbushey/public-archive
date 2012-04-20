<h1><?php if ($this->options['strict'] || (isset($t->working_user) && method_exists($t->working_user,'getUsername'))) echo htmlspecialchars($t->working_user->getUsername());?></h1>
<p>Email Address: <?php if ($this->options['strict'] || (isset($t->working_user) && method_exists($t->working_user,'getEmailaddress'))) echo htmlspecialchars($t->working_user->getEmailaddress());?></p>
<p>Last IP Address: <?php if ($this->options['strict'] || (isset($t->working_user) && method_exists($t->working_user,'getIp'))) echo htmlspecialchars($t->working_user->getIp());?></p>
<dl>
	<dt><h2>Ban Status:</h2></dt>
	<dd>
		<?php if ($t->is_banned)  {?>
			<?php if ($t->is_email_banned)  {?>
                <?php if ($this->options['strict'] || (isset($t->email_ban) && method_exists($t->email_ban,'is_perm_ban'))) if ($t->email_ban->is_perm_ban()) { ?>
                    <p style="color: red">Email Address has been banned permanently</p>
                <?php } else {?>
				    <p style="color: red">Email Address has been banned until <?php if ($this->options['strict'] || (isset($t->email_ban) && method_exists($t->email_ban,'getTtd'))) echo htmlspecialchars($t->email_ban->getTtd());?></p>
                <?php }?>
			<?php }?>
			<?php if ($t->is_username_banned)  {?>
                <?php if ($this->options['strict'] || (isset($t->username_ban) && method_exists($t->username_ban,'is_perm_ban'))) if ($t->username_ban->is_perm_ban()) { ?>
                    <p style="color: red">User name has been banned permanently</p>
                <?php } else {?>
				    <p style="color: red">User name has been banned until <?php if ($this->options['strict'] || (isset($t->username_ban) && method_exists($t->username_ban,'getTtd'))) echo htmlspecialchars($t->username_ban->getTtd());?></p>
                <?php }?>
			<?php }?>
			<?php if ($t->is_ip_banned)  {?>
                <?php if ($this->options['strict'] || (is_array($t->ip_bans)  || is_object($t->ip_bans))) foreach($t->ip_bans as $ip_ban) {?>
                    <p style="color: red">
                    <?php if ($this->options['strict'] || (isset($ip_ban) && method_exists($ip_ban,'is_perm_ban'))) if ($ip_ban->is_perm_ban()) { ?>
                        IP Address has been banned permanently by <?php if ($this->options['strict'] || (isset($ip_ban) && method_exists($ip_ban,'getIpAndMaskString'))) echo htmlspecialchars($ip_ban->getIpAndMaskString());?>
                    <?php } else {?>
    				    IP Address has been banned until <?php if ($this->options['strict'] || (isset($ip_ban) && method_exists($ip_ban,'getTtd'))) echo htmlspecialchars($ip_ban->getTtd());?> by <?php if ($this->options['strict'] || (isset($ip_ban) && method_exists($ip_ban,'getIpAndMaskString'))) echo htmlspecialchars($ip_ban->getIpAndMaskString());?>
                    <?php }?>
                    <input type="submit" id="unban_ip" name="unban_ip" value="Unban IP Address" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>&ip_m=<?php if ($this->options['strict'] || (isset($ip_ban) && method_exists($ip_ban,'getIpAndMaskString'))) echo htmlspecialchars($ip_ban->getIpAndMaskString());?>', new Array('unban_ip'))" /></p>
                <?php }?>
			<?php }?>
		<?php } else {?>
			<p style="color: green">User is not banned</p>
		<?php }?>
	</dd>
	<dd>
		<?php if ($t->is_email_banned)  {?>
			<input type="submit" id="unban_email" name="unban_email" value="Unban Email Address" / onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('unban_email'))">
		<?php } else {?>
			<?php echo $this->elements['ban_email_dialog']->toHtml();?>
		<?php }?>
		<?php if ($t->is_username_banned)  {?>
			<input type="submit" id="unban_username" name="unban_username" value="Unban User Name" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('unban_username'))" />
		<?php } else {?>
			<?php echo $this->elements['ban_username_dialog']->toHtml();?>
		<?php }?>
		<?php if ($t->is_ip_banned)  {?>
		<?php } else {?>
			<?php echo $this->elements['ban_ip_dialog']->toHtml();?>
		<?php }?>
	</dd>
</dl>

<div class="bordered" id="admin_user_smack">
    <h2>Smack</h2>
    <div class="pagination">
        <div class="left">
            <?php echo $t->pg->prv_page;?>
        </div>
        <div class="right">
            <?php echo $t->pg->next_page;?>
        </div>
        <div class="center">
            <?php if ($this->options['strict'] || (is_array($t->pg->pg_listings)  || is_object($t->pg->pg_listings))) foreach($t->pg->pg_listings as $listing) {?>
                <?php echo $listing;?>
            <?php }?>
        </div>
    </div>
    <?php if ($this->options['strict'] || (is_array($t->results)  || is_object($t->results))) foreach($t->results as $smack) {?>
    <div id="smack_<?php echo htmlspecialchars($smack->smack_id);?>" class="smack">
        <span class="smack_left_wrapper"><?php echo $smack->fight;?></span>           
        <span class="smack_right_wrapper"><input type="submit" value="Edit Post" / onclick="show_edit_post('<?php echo htmlspecialchars($smack->smack_id);?>')"></span>
        <span class="smack_left_wrapper">Date: <?php echo htmlspecialchars($smack->date);?></span>
        <span class="smack_right_wrapper"><input type="submit" value="Delete Post" onclick="show_remove_post('<?php echo htmlspecialchars($smack->smack_id);?>')" /></span>
        <div id="smack_body_<?php echo htmlspecialchars($smack->smack_id);?>" class="smack_body bordered">
            <?php echo $smack->body;?>
        </div>
        <div id="smack_body_for_input_<?php echo htmlspecialchars($smack->smack_id);?>" style="display:none"><?php echo $smack->body_for_input;?></div>
    </div>
    <?php }?>
    <div class="pagination">
        <div class="left">
            <?php echo $t->pg->prv_page;?>
        </div>
        <div class="right">
            <?php echo $t->pg->next_page;?>
        </div>
        <div class="center">
            <?php if ($this->options['strict'] || (is_array($t->pg->pg_listings)  || is_object($t->pg->pg_listings))) foreach($t->pg->pg_listings as $listing) {?>
                <?php echo $listing;?>
            <?php }?>
        </div>
    </div>
</div>

<!-- Begin Popup Divs -->
<div id="ban_email_div" class="popup_div">
    	<h3>Ban Email Address for how long?</h3>
    	<p><?php $element = $this->elements['email_length_radio_temp'];
                $element = $this->mergeElement($element,$this->elements['email_length_radio']);
                echo  $element->toHtml();?>Ban for <?php echo $this->elements['email_length_text']->toHtml();?> days</p>
    	<p><?php $element = $this->elements['email_length_radio_perm'];
                $element = $this->mergeElement($element,$this->elements['email_length_radio']);
                echo  $element->toHtml();?>Ban Permanently</p>
    	<p><input type="submit" value="Ban Email Address" name="ban_email_submit" id="ban_email_submit" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('ban_email_submit', 'email_length_radio_temp', 'email_length_radio_perm', 'email_length_text'))" /><?php echo $this->elements['cancel_email_ban']->toHtml();?></p>
</div>
<div id="ban_username_div" class="popup_div">
        <h3>Ban User Name for how long?</h3>
        <p><?php $element = $this->elements['username_length_radio_temp'];
                $element = $this->mergeElement($element,$this->elements['username_length_radio']);
                echo  $element->toHtml();?>Ban for <?php echo $this->elements['username_length_text']->toHtml();?> days</p>
        <p><?php $element = $this->elements['username_length_radio_perm'];
                $element = $this->mergeElement($element,$this->elements['username_length_radio']);
                echo  $element->toHtml();?>Ban Permanently</p>
        <p><input type="submit" value="Ban User Name" name="ban_username_submit" id="ban_username_submit" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('ban_username_submit', 'username_length_radio_temp', 'username_length_radio_perm', 'username_length_text'))" /><?php echo $this->elements['cancel_username_ban']->toHtml();?></p>
</div>
<div id="ban_ip_div" class="popup_div">
        <h3>Ban IP Address for how long?</h3>
        <p><?php $element = $this->elements['ip_length_radio_temp'];
                $element = $this->mergeElement($element,$this->elements['ip_length_radio']);
                echo  $element->toHtml();?>Ban for <?php echo $this->elements['ip_length_text']->toHtml();?> days</p>
        <p><?php $element = $this->elements['ip_length_radio_perm'];
                $element = $this->mergeElement($element,$this->elements['ip_length_radio']);
                echo  $element->toHtml();?>Ban Permanently</p>
        <p><input type="submit" value="Ban IP Address" name="ban_ip_submit" id="ban_ip_submit" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('ban_ip_submit', 'ip_length_radio_temp', 'ip_length_radio_perm', 'ip_length_text'))" /><?php echo $this->elements['cancel_ip_ban']->toHtml();?></p>
</div>
<div id="remove_post_div" class="popup_div">
    <p>Are you sure you want to remove this post?</p>
    <span><?php echo $this->elements['post_to_remove']->toHtml();?><input type="submit" name="yes_remove_post_button" id="yes_remove_post_button" value="Yes" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('yes_remove_post_button', 'post_to_remove'))" /><?php echo $this->elements['no_remove_post_button']->toHtml();?></span>
</div>
<div id="edit_post_div" class="popup_div">
    <?php echo $this->elements['edit_post_text']->toHtml();?>
    <?php echo $this->elements['post_to_edit']->toHtml();?>
    <div><input type="submit" value="Save Post" name="save_post_button" id="save_post_button" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('save_post_button', 'post_to_edit', 'edit_post_text'))"><?php echo $this->elements['cancel_post_button']->toHtml();?></div>
</div>