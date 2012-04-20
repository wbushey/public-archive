<h1>Add A Celebrity</h1>
<p>A Name is required, while the Reference URL and Picture are optional. If no Reference URL is provided then one will be generated that refers to Wikipedia.</p>
<form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post" enctype="multipart/form-data">
    <p><label for="name">Name: </label> <?php echo $this->elements['name']->toHtml();?></p>
    <p><label for="reference_url">Reference URL: </label> <?php echo $this->elements['reference_url']->toHtml();?></p>
    <p><label for="picture">Picture: </label> <?php echo $this->elements['picture']->toHtml();?></p>
    <p><?php echo $this->elements['add_celebrity']->toHtml();?></p>
</form>