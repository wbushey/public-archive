<h1>Add An Advertisment</h1>
<form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post" enctype="multipart/form-data">
    <p><label for="name">Name: </label> <input type="text" name="name" id="name" / value="<?php echo htmlspecialchars($t->ad_name);?>"></p>
    <p><label for="position">Position: </label> 
        <?php echo $this->elements['position']->toHtml();?>
    </p>
    <p><label for="priority">Priority: </label> <input type="text" name="priority" id="priority" value="<?php echo htmlspecialchars($t->ad_priority);?>" onkeyup="display_percentage()" /><span id="display_percentage"></span></p>
    <p><label for="hosting_check">Hosting Image? </label> <?php echo $this->elements['hosting_check']->toHtml();?> <label for="hosting_file">File to upload: </label><?php echo $this->elements['hosting_file']->toHtml();?></p>
    <p>If uploading an image, use the token __CBF_AD__ as the image's address. The script will replace the token with the actual address of the image.</p>
    <p><label for="code">Ad Code: </label> <?php echo $this->elements['code']->toHtml();?></p>
    <p><?php echo $this->elements['add_ad_submit']->toHtml();?></p>
</form>