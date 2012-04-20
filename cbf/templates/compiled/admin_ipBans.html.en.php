<div id="add_ip_ban">
    <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>" method="post">
        <p>
            <label for="ip_address">Address/Mask:</label>
            <?php echo $this->elements['ip_address']->toHtml();?>
            <label for="days">Number of Days:</label>
            <?php echo $this->elements['days']->toHtml();?>
            <?php echo $this->elements['ban_button']->toHtml();?>
        </p>
        <p>
            If 'Number of Days' is left blank or has the value '0' then the ban will be permanent.
        </p>
        <p>
            The following syntaxes are accepted by Address/Mask:
            <ul>
                <li>xxx.xxx.xxx.xxx</li>
                <li>xxx.xxx.xxx.xxx/[&lt;=32]</li>
                <li>xxx</li>
                <li>xxx/[&lt;=8]</li>
                <li>xxx.xxx</li>
                <li>xxx.xxx/[&lt;=16]</li>
                <li>xxx.xxx.xxx</li>
                <li>xxx.xxx.xxx/[&lt;=24]</li>
            </ul>
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
Total Bans: <?php echo htmlspecialchars($t->pg->total_results);?>
<table width="100%" border="1">
    <tr>
        <td>IP Address/Mask</td>
        <td>Expires On</td>
        <td>Remove Ban</td>
    </tr>
<?php if ($this->options['strict'] || (is_array($t->results)  || is_object($t->results))) foreach($t->results as $result) {?>
    <tr>
        <td>
            <?php if ($this->options['strict'] || (isset($result) && method_exists($result,'getIpAndMaskString'))) echo htmlspecialchars($result->getIpAndMaskString());?></a>
        </td>
        <td>
            <?php if ($this->options['strict'] || (isset($result) && method_exists($result,'is_perm_ban'))) if ($result->is_perm_ban()) { ?>
                Permanent Ban
            <?php } else {?>
                <?php if ($this->options['strict'] || (isset($result) && method_exists($result,'getTtd'))) echo htmlspecialchars($result->getTtd());?>
            <?php }?>
        </td>
        <td>
            <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>?del=<?php if ($this->options['strict'] || (isset($result) && method_exists($result,'getIpAndMaskString'))) echo htmlspecialchars($result->getIpAndMaskString());?>">Remove</a>
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