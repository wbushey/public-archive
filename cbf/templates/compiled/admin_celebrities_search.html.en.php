<div id="search_options">
    <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>" method="get">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($t->name_query);?>" />
        <label for="has_fight">In A Fight?</label>
        <?php echo $t->has_fight_options;?>
        <label for="has_picture">Have A Picture?</label>
        <?php echo $t->has_picture_options;?>
        <label for="l">Results Per Page:</label>
        <input type="text" name="l" id="l" size="4" value="<?php echo htmlspecialchars($t->pg->limit);?>" />
        <input type="submit" value="Search" />
    </form>
</div>
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
Results: <?php echo htmlspecialchars($t->pg->total_results);?>
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