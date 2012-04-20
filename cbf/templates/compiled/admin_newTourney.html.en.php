<input type="submit" value="Select All" id="selectAll" onclick="selectAll(document.newTourney.celebs)" /> <input type="submit" value="Un-Select All" id="unselectall" onclick="unSelectAll(document.newTourney.celebs)" />
<form name="newTourney" action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>" method="post" onsubmit="return validate_form()">
<table>
<?php if ($this->options['strict'] || (is_array($t->celebs)  || is_object($t->celebs))) foreach($t->celebs as $x => $celeb) {?>
  <tr>
    <td>
      <input type="checkbox" name="celebs[]" id="celeb<?php echo htmlspecialchars($x);?>" value="<?php if ($this->options['strict'] || (isset($celeb) && method_exists($celeb,'getId'))) echo htmlspecialchars($celeb->getId());?>" onclick="printCount()" /><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getCelebLink'))) echo htmlspecialchars($t->getCelebLink($celeb));?>" target="_blank"><?php if ($this->options['strict'] || (isset($celeb) && method_exists($celeb,'getName'))) echo htmlspecialchars($celeb->getName());?></a>
    </td>
  </tr>
<?php }?>
</table>
<?php echo $this->elements['add_tourney']->toHtml();?>
</form>
<div id="checkCountHolder">
Checked Celebrities:
    <div id="checkCount">
    
    </div>
</div>