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
<ul>
Total Ads: <?php echo htmlspecialchars($t->pg->total_results);?>
<?php if ($this->options['strict'] || (is_array($t->search_results)  || is_object($t->search_results))) foreach($t->search_results as $result) {?>
    <li><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>?id=<?php if ($this->options['strict'] || (isset($result) && method_exists($result,'getId'))) echo htmlspecialchars($result->getId());?>"><?php if ($this->options['strict'] || (isset($result) && method_exists($result,'getName'))) echo htmlspecialchars($result->getName());?></a></li>
<?php }?>
</ul>
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