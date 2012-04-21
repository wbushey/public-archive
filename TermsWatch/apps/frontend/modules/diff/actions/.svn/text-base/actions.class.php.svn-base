<?php

/**
 * diff actions.
 *
 * @package    TermsWatch
 * @subpackage diff
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class diffActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('diff', 'show');
  }
  
  public function executeShow(sfWebRequest $request){
  	$this->redirectUnless($request->hasParameter('vid'), 'timeline/timeline');
  	
  	// Make the DiffEngine notices shut up
  	define('USE_ASSERTS', 1);
  	
  	// Get the requested version
  	$c = new Criteria();
  	$c->add(VersionPeer::VID, $request->getParameter('vid'));
  	$c->addDescendingOrderByColumn(VersionPeer::RETRIEVEDAT);
  	$c->addJoin(VersionPeer::PID, PolicyPeer::PID);
  	$this->cur_ver = VersionPeer::doSelectOne($c);
  	
  	// Redirect if needed
  	$this->redirectUnless($this->cur_ver, 'timeline/timeline');
  	
  	// Get the previous version
  	$c = new Criteria();
  	$c->add(VersionPeer::PID, $this->cur_ver->getPid());
  	$c->addDescendingOrderByColumn(VersionPeer::RETRIEVEDAT);
  	$c->setLimit(2);
  	$results = VersionPeer::doSelect($c);
  	
  	$this->redirectUnless($results && $results[1], 'version/show?vid=' . $this->cur_ver->getVid());
  	$this->pre_ver = $results[1];
  	
  	
  	// compensate for an error in earlier scrapes by re-adding line-breaks
	if ($this->cur_ver->getVid() < 132){
  		$this->cur_ver->setContent(
  				str_replace("</p>","</p>\n\n",$this->cur_ver->getContent()));
  		$this->pre_ver->setContent(
  				str_replace("</p>","</p>\n\n",$this->pre_ver->getContent()));
	}
	
	if ($this->cur_ver->getPolicy()->getPre()){
	  // this policy is formatted for the <PRE> tag, so linebreaks must be handled differently
	  $this->cur_ver->setContent(
	  			str_replace("\n\n","<br/><br/>",$this->cur_ver->getContent()));
	  $this->pre_ver->setContent(
	  			str_replace("\n\n","<br/><br/>",$this->pre_ver->getContent()));
	}
	
	// build diff output
	include_once('DiffEngine.php');
	sfLoader::loadHelpers(array('TermsWatch'));
	
	$a = preg_split("{</p>|<br/>|<br>|</h1>|</h2>|</h3>|</h4>|</h5>|</ul>|</ol>}si",
			termswatch_filter($this->cur_ver->getContent()));
	$b = preg_split("{</p>|<br/>|<br>|</h1>|</h2>|</h3>|</h4>|</h5>|</ul>|</ol>}si",
			termswatch_filter($this->pre_ver->getContent()));
	
	$diff = new Diff($b,$a);
	$this->diffhtml = $this->format_diff($diff->edits);
	
	// Set the crumbs for this action
  	sfLoader::loadHelpers(array('Url', 'Tag'));
  	$crumbs = array(	link_to('Home', '/'), 
  						link_to($this->cur_ver->getPolicy()->getCompany()->getName(), 'organization/show?cid=' . $this->cur_ver->getPolicy()->getCompany()->getCid()),
  						link_to($this->cur_ver->getPolicy()->getName(), 'policy/show?pid=' . $this->cur_ver->getPolicy()->getPid()));
  	$this->getResponse()->setSlot('crumbs', $crumbs);
	
	// Set the mission
  	sfLoader::loadHelpers(array('TermsWatch', 'Date'));
  	$mission = array();
  	$mission['image'] = $this->cur_ver->getPolicy()->getCompany()->getImageLarge();
  	$mission['title'] = $this->cur_ver->getPolicy()->getCompany()->getName();
  	$mission['body'] = "Changes recorded on " . format_date($this->cur_ver->getRetrievedat());
  	$this->getResponse()->setSlot('mission', termswatch_generate_mission($mission));
	
  }
  
  private function format_diff($edits){
	  foreach ($edits as $d){
	    if ($d->type == "copy"){
	      $rowcount = count($d->orig);
	      $i = 0;
	      while ($i < $rowcount){
	        unset($row);
	        $row[] = termswatch_convert_smart_quotes($d->orig[$i]);
	        $row[] = termswatch_convert_smart_quotes($d->closing[$i]);
	        $rows[] = array(
	          'data' => $row,
	          'class' => 'copy'
	        );
	        $i++;
	      }
	    } else {
	      if (empty($d->orig)){
	        foreach ($d->closing as $cell){
	          unset($row);
	          $row[] = "&nbsp;";
	          $row[] = "<div class='diffchange'>".convert_smart_quotes($cell)."</div>";
	          $rows[] = array(
	            'data' => $row,
	            'class' => 'change'
	          );
	        }
	      } elseif(empty($d->closing)){
	        foreach ($d->orig as $cell){
	          unset($row);
	          $row[] = "<div class='diffchange'>".convert_smart_quotes($cell)."</div>";
	          $row[] = "&nbsp;";
	          $rows[] = array(
	            'data' => $row,
	            'class' => 'change'
	          );
	        }
	      } else {
	        $diff = new WordLevelDiff($d->orig, $d->closing);
	        $del = $diff->orig();
	        $add = $diff->closing();
	
	        $rowcount = max(count($del),count($add));
	        $i = 0;
	        while ($i < $rowcount){
	          unset($row);
	
	          if (empty($del[$i])){
	            $row[] = "&nbsp;";
	          } else {
	            $row[] = termswatch_convert_smart_quotes($del[$i]);
	          }
	
	          if (empty($add[$i])){
	            $row[] = "&nbsp;";
	          } else {        
	            $row[] = termswatch_convert_smart_quotes($add[$i]);
	          }
	
	          $rows[] = array(
	            'data' => $row,
	            'class' => 'change'
	          );
	          $i++;
	        }
	      }
	    }
	  }
	  
	  $out = "<table id='diff'>";
	  if ($rows){
	    foreach ($rows as $row){
	//      $out .= "<tr>";
	      $out .= "<tr class='".$row['class']."'>";
	        $out .= "<td class='left side'>";
	//          $out .= "<div class='".$row['class']."'>";
	            $out .= $row['data'][0];
	//          $out .= "</div>";
	        $out .= "</td><td class='spacer'>&nbsp;</td><td class='right side'>";
	//          $out .= "<div class='".$row['class']."'>";
	            $out .= $row['data'][1];
	//          $out .= "</div>";
	        $out .= "</td>";
	      $out .= "</tr>";
	    }
	  }
	  $out .= "</table>";
	  
	  return $out;
	}
}
