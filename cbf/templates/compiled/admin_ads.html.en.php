<div class="field"><b>Name:</b> <div id="display_name" class="field_value"><?php if ($this->options['strict'] || (isset($t->ad) && method_exists($t->ad,'getName'))) echo htmlspecialchars($t->ad->getName());?></div>  <?php echo $this->elements['edit_name_button']->toHtml();?></div>
<div class="field"><b>Date Added:</b> <?php if ($this->options['strict'] || (isset($t->ad) && method_exists($t->ad,'getDateAdded'))) echo htmlspecialchars($t->ad->getDateAdded());?></div>
<div class="field"><b>Position:</b> <?php echo htmlspecialchars($t->ad_position_string);?> <?php echo $this->elements['edit_position_button']->toHtml();?></div>
<div class="field"><b>Priority:</b> <?php if ($this->options['strict'] || (isset($t->ad) && method_exists($t->ad,'getAdPriority'))) echo htmlspecialchars($t->ad->getAdPriority());?> <?php echo $this->elements['edit_priority_button']->toHtml();?></div>
<div class="field"><b>Edit Code:</b> <?php echo $this->elements['edit_code_button']->toHtml();?></div>
<div class="field"><b>Remove Ad:</b> <input type="submit" value="Remove <?php if ($this->options['strict'] || (isset($t->ad) && method_exists($t->ad,'getName'))) echo htmlspecialchars($t->ad->getName());?>" name="remove_ad_button" id="remove_ad_button" onclick="show_remove_ad()" /></div>
<h2>Ad Sample</h2>
<div id="ad_display">
  <?php if ($this->options['strict'] || (isset($t->ad) && method_exists($t->ad,'getCode'))) echo $t->ad->getCode();?>
</div>
<!-- Begin Popup Divs -->
<div id="edit_name_div" class="popup_div">
    <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post"><input type="text" name="edit_name_field" id="edit_name_field" value="<?php if ($this->options['strict'] || (isset($t->ad) && method_exists($t->ad,'getName'))) echo htmlspecialchars($t->ad->getName());?>" /><?php echo $this->elements['edit_name_submit']->toHtml();?></form>
</div>
<div id="edit_position_div" class="popup_div">
    <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post"><?php echo $this->elements['edit_position_select']->toHtml();?><?php echo $this->elements['edit_position_submit']->toHtml();?></form>
</div>
<div id="edit_priority_div" class="popup_div">
    <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post"><input type="text" name="edit_priority_field" id="edit_priority_field" onkeyup="display_percentage()" value="<?php if ($this->options['strict'] || (isset($t->ad) && method_exists($t->ad,'getAdPriority'))) echo htmlspecialchars($t->ad->getAdPriority());?>" /><?php echo $this->elements['edit_priority_submit']->toHtml();?></form>
    <div id="display_percentage"></div>
</div>
<div id="edit_code_div" class="popup_div">
    <?php echo $this->elements['edit_code_text']->toHtml();?>
    <span><?php echo $this->elements['close_code_button']->toHtml();?><input type="submit" name="edit_code_submit" id="edit_code_submit" value="Update Code" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('edit_code_submit', 'edit_code_text'))" /></span>
</div>
<div id="remove_ad_div" class="popup_div">
    <p>Are you sure you want to remove <?php if ($this->options['strict'] || (isset($t->ad) && method_exists($t->ad,'getName'))) echo htmlspecialchars($t->ad->getName());?>?</p>
    <p>Removing <?php if ($this->options['strict'] || (isset($t->ad) && method_exists($t->ad,'getName'))) echo htmlspecialchars($t->ad->getName());?> will also remove any images associated with it.</p>
    <span><input type="submit" name="yes_remove_ad_button" id="yes_remove_ad_button" value="Yes" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('yes_remove_ad_button'))" /><?php echo $this->elements['no_remove_ad_button']->toHtml();?></span>
</div>