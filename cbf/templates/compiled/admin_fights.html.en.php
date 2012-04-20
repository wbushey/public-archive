<div class="field"><h1><a href="<?php echo htmlspecialchars($t->fighter_one_url);?>"><?php if ($this->options['strict'] || (isset($t->fighter_one) && method_exists($t->fighter_one,'getName'))) echo htmlspecialchars($t->fighter_one->getName());?></a> vs <a href="<?php echo htmlspecialchars($t->fighter_two_url);?>"><?php if ($this->options['strict'] || (isset($t->fighter_two) && method_exists($t->fighter_two,'getName'))) echo htmlspecialchars($t->fighter_two->getName());?></a></h1></div>
<div class="field"><b>Url: <?php echo $t->fight_url;?></b></div>
<div class="field"><span class="fight_count"><b>Times Fought:</b> <?php if ($this->options['strict'] || (isset($t->fight) && method_exists($t->fight,'getTotalFights'))) echo htmlspecialchars($t->fight->getTotalFights());?></span><span class="fight_count"><b><?php if ($this->options['strict'] || (isset($t->fighter_one) && method_exists($t->fighter_one,'getName'))) echo htmlspecialchars($t->fighter_one->getName());?> Victories:</b> <?php if ($this->options['strict'] || (isset($t->fight) && method_exists($t->fight,'getOnewins'))) echo htmlspecialchars($t->fight->getOnewins());?></span><span class="fight_count"><b><?php if ($this->options['strict'] || (isset($t->fighter_two) && method_exists($t->fighter_two,'getName'))) echo htmlspecialchars($t->fighter_two->getName());?> Victories:</b> <?php if ($this->options['strict'] || (isset($t->fight) && method_exists($t->fight,'getTwowins'))) echo htmlspecialchars($t->fight->getTwowins());?></span></div>
<div class="field">
    <?php if ($this->options['strict'] || (isset($t->fight) && method_exists($t->fight,'getActive'))) if ($t->fight->getActive()) { ?>
    <b>Fight Currently Active</b><input type="submit" value="Deactivate Fight" name="deactivate_fight_button" id="deactivate_fight_button" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('deactivate_fight_button'))" />
    <?php } else {?>
    <b>Fight Currently Not Active</b><input type="submit" value="Activate Fight" name="activate_fight_button" id="activate_fight_button" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('activate_fight_button'))" />
    <?php }?>    
<?php echo $this->elements['remove_fight_button']->toHtml();?></div>
<div class="bordered" id="admin_fight_smack">
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
    <?php if ($this->options['strict'] || (is_array($t->all_smack)  || is_object($t->all_smack))) foreach($t->all_smack as $smack) {?>
    <div id="smack_<?php echo htmlspecialchars($smack->smack_id);?>" class="smack">
        <span class="smack_left_wrapper"><?php echo $smack->username;?></span>           
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
<div id="remove_fight_div" class="popup_div">
    <p>Are you sure you want to remove the fight between <?php if ($this->options['strict'] || (isset($t->fighter_one) && method_exists($t->fighter_one,'getName'))) echo htmlspecialchars($t->fighter_one->getName());?> and <?php if ($this->options['strict'] || (isset($t->fighter_two) && method_exists($t->fighter_two,'getName'))) echo htmlspecialchars($t->fighter_two->getName());?>?</p>
    <span><input type="submit" value="Yes" name="yes_remove_fight_button" id="yes_remove_fight_button" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('yes_remove_fight_button'))" /><?php echo $this->elements['no_remove_fight_button']->toHtml();?></span>
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