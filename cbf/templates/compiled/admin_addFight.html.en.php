<h1>Add A Fight</h1>
<p>The celebrities selected in the list boxes will be paired in a fight. The text box above each list can be used to narrow down the celebrities who are available in each list box.</p>
<p>Any new fights will automatically be activated.</p>
<form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getAugViewUrl'))) echo htmlspecialchars($t->getAugViewUrl());?>" method="post">
    <div id="addFightDiv">
        <div id="celeb1Div" class="celebListDiv">
            <h2>Celebrity One</h2>
            <p><?php echo $this->elements['celeb1Search']->toHtml();?></p>
            <?php echo $t->celeb1Options;?>
        </div>
        <div id="celeb2Div" class="celebListDiv">
            <h2>Celebrity Two</h2>
            <p><?php echo $this->elements['celeb2Search']->toHtml();?></p>
            <?php echo $t->celeb2Options;?>
        </div>
        <div class="clearBoth"> </div>
        <?php echo $this->elements['add_fight']->toHtml();?>
    </div>
</form>
<div id="allOptionsDiv" style="display:none">
		<?php echo $t->allCelebOptions;?>
</div>