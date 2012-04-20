<div class="field"><b>Name:</b> <div id="display_name" class="field_value"><?php if ($this->options['strict'] || (isset($t->celebrity) && method_exists($t->celebrity,'getName'))) echo htmlspecialchars($t->celebrity->getName());?></div>  <?php echo $this->elements['edit_name_button']->toHtml();?></div>
<div class="field"><b>Reference URL:</b> <a id="display_reference" href="<?php if ($this->options['strict'] || (isset($t->celebrity) && method_exists($t->celebrity,'getReference'))) echo htmlspecialchars($t->celebrity->getReference());?>" target="_blank"><?php if ($this->options['strict'] || (isset($t->celebrity) && method_exists($t->celebrity,'getReference'))) echo htmlspecialchars($t->celebrity->getReference());?></a> <?php echo $this->elements['edit_reference_button']->toHtml();?></div>
<p><b>Pictures</b>  <?php echo $this->elements['add_picture_button']->toHtml();?></p>
<div id="celebrity_pictures" class="bordered">
    <table>
        <?php if ($this->options['strict'] || (is_array($t->pics_rows)  || is_object($t->pics_rows))) foreach($t->pics_rows as $pics_row) {?>
            <tr>
                <?php if ($this->options['strict'] || (is_array($pics_row)  || is_object($pics_row))) foreach($pics_row as $pic) {?>
                    <td>
                        <img src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getPicsUrl'))) echo htmlspecialchars($t->getPicsUrl());?><?php if ($this->options['strict'] || (isset($pic) && method_exists($pic,'getThumbnail'))) echo htmlspecialchars($pic->getThumbnail());?>" onclick="show_full_picture('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getPicsUrl'))) echo htmlspecialchars($t->getPicsUrl());?><?php if ($this->options['strict'] || (isset($pic) && method_exists($pic,'getPic'))) echo htmlspecialchars($pic->getPic());?>', '<?php if ($this->options['strict'] || (isset($pic) && method_exists($pic,'getPic'))) echo htmlspecialchars($pic->getPic());?>')" />
                    </td>
                <?php }?>
            </tr>
        <?php }?>
    </table>
</div>

<p><b>Fights</b> <input type="submit" value="Add <?php if ($this->options['strict'] || (isset($t->celebrity) && method_exists($t->celebrity,'getName'))) echo htmlspecialchars($t->celebrity->getName());?> to a Fight" name="add_to_fight_button" id="add_to_fight_button" / onclick="redirect('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAddFightLink'))) echo htmlspecialchars($t->getAddFightLink($t->celebrity));?>')"></p>
<div id="related_fights" class="bordered fight_listing">
    <?php if ($this->options['strict'] || (is_array($t->all_fights)  || is_object($t->all_fights))) foreach($t->all_fights as $fight) {?>
        <p><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getFightLink'))) echo htmlspecialchars($t->getFightLink($fight));?>"><?php if ($this->options['strict'] || (isset($fight) && method_exists($fight,'toString'))) echo htmlspecialchars($fight->toString());?></a></p>
    <?php }?>
</div>

<p><input type="submit" value="Remove <?php if ($this->options['strict'] || (isset($t->celebrity) && method_exists($t->celebrity,'getName'))) echo htmlspecialchars($t->celebrity->getName());?>" name="remove_celebrity_button" id="remove_celebrity_button" onclick="show_remove_celeb()" /></p>

<!-- Begin Popup Divs -->
<div id="edit_name_div" class="popup_div">
    <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post"><input type="text" name="edit_name_field" id="edit_name_field" value="<?php if ($this->options['strict'] || (isset($t->celebrity) && method_exists($t->celebrity,'getName'))) echo htmlspecialchars($t->celebrity->getName());?>" /><?php echo $this->elements['edit_name_submit']->toHtml();?></form>
</div>
<div id="edit_reference_div" class="popup_div">
    <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post"><input type="text" name="edit_reference_field" id="edit_reference_field" value="<?php if ($this->options['strict'] || (isset($t->celebrity) && method_exists($t->celebrity,'getReference'))) echo htmlspecialchars($t->celebrity->getReference());?>" /><?php echo $this->elements['edit_reference_submit']->toHtml();?></form>
</div>
<div id="add_picture_div" class="popup_div">
    <?php echo $this->elements['new_picture_file']->toHtml();?><input type="submit" value="Add Picture" name="add_picture_submit" id="add_picture_submit" onclick="sendFile('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('add_picture_submit', 'new_picture_file'))" /><?php echo $this->elements['cancel_add_picture_button']->toHtml();?>
</div>
<div id="edit_picture_div" class="popup_div">
    <div><img id="full_picture" src="" /></div>
    <span><?php echo $this->elements['close_picture_button']->toHtml();?><?php echo $this->elements['picture_to_remove']->toHtml();?><input type="submit" name="remove_picture_button" id="remove_picture_button" value="Remove Picture" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('remove_picture_button', 'picture_to_remove'))" /></span>
</div>
<div id="remove_celeb_div" class="popup_div">
    <p>Are you sure you want to remove <?php if ($this->options['strict'] || (isset($t->celebrity) && method_exists($t->celebrity,'getName'))) echo htmlspecialchars($t->celebrity->getName());?> from Celebrity Bar Fight?</p>
    <p>If removed, any pictures, fights and comments related to <?php if ($this->options['strict'] || (isset($t->celebrity) && method_exists($t->celebrity,'getName'))) echo htmlspecialchars($t->celebrity->getName());?> will also be removed from the site.</p>
    <span><input type="submit" name="yes_remove_celeb_button" id="yes_remove_celeb_button" value="Yes" onclick="sendPost('<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>', new Array('yes_remove_celeb_button'))" /><?php echo $this->elements['no_remove_celeb_button']->toHtml();?></span>
</div>