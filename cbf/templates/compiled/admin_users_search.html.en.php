<div id="search_options">
    <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>" method="get">
        <p>
        	<label for="search_by">Search By:</label>
        	<?php echo $t->search_by_options;?>
        	<input type="text" name="query" id="query" value="<?php echo htmlspecialchars($t->query);?>" />
        </p>
        <p>
        	<label for="banned_by_username">Banned By User name?</label>
        	<?php echo $t->banned_by_username_options;?>
        	<label for="banned_by_email">Banned By Email Address?</label>
        	<?php echo $t->banned_by_email_options;?>
        	<label for="banned_by_ip">Banned By IP Address?</label>
        	<?php echo $t->banned_by_ip_options;?>
        </p>
        <p>
        	<label for="l">Results Per Page:</label>
	        <input type="text" name="l" id="l" size="4" value="<?php echo htmlspecialchars($t->pg->limit);?>" />
	        <input type="submit" value="Search" />
        </p>
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
Results: <?php echo htmlspecialchars($t->pg->total_results);?>
<table width="100%" border="1">
    <tr>
        <td>User Name</td>
        <td>Email Address</td>
        <td>Last IP Address</td>
    </tr>
<?php if ($this->options['strict'] || (is_array($t->results)  || is_object($t->results))) foreach($t->results as $result) {?>
    <tr>
        <td>
            <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>?id=<?php if ($this->options['strict'] || (isset($result) && method_exists($result,'getId'))) echo htmlspecialchars($result->getId());?>"><?php if ($this->options['strict'] || (isset($result) && method_exists($result,'getUsername'))) echo htmlspecialchars($result->getUsername());?></a>
        </td>
        <td>
            <?php if ($this->options['strict'] || (isset($result) && method_exists($result,'getEmailaddress'))) echo htmlspecialchars($result->getEmailaddress());?>
        </td>
        <td>
            <?php if ($this->options['strict'] || (isset($result) && method_exists($result,'getIp'))) echo htmlspecialchars($result->getIp());?>
        </td>
     </tr>
<?php }?>
</table>
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