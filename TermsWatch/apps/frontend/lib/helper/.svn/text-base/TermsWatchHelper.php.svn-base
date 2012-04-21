<?php
/**
 * A set of helper functions to be used by the TermsWatch/TOSBack templates.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Created on Jun 16, 2009
 */
 
 /**
  * Calculates and returns the 'base' variables as an array.
  * 
  * Mostly copied from TOSBack/shared.inc.php
  */
 function termswatch_bases(){
 	$bases = array();
 	
 	$bases['base_root'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
	// As $_SERVER['HTTP_HOST'] is user input, ensure it only contains
	// characters allowed in hostnames.
	$bases['base_url'] = $bases['base_root'] .= '://'. preg_replace('/[^a-z0-9-:._]/i', '', $_SERVER['HTTP_HOST']);
	// $_SERVER['SCRIPT_NAME'] can, in contrast to $_SERVER['PHP_SELF'], not
	// be modified by a visitor.
	if ($dir = trim(dirname($_SERVER['SCRIPT_NAME']), '\,/')) {
	  $bases['base_path'] = "/$dir";
	  $bases['base_url'] .= $bases['base_path'];
	  $bases['base_path'] .= '/';
	}
	else {
	  $bases['base_path'] = '/';
	}
	
	return $bases;
 }
 
 /**
  * Returns the base_url variable.
  */
 function termswatch_base_url(){
 	$bases = termswatch_bases();
 	return $bases['base_url'];
 }
 
 /**
  * Returns the base_path variable.
  */
 function termswatch_base_path(){
 	$bases = termswatch_bases();
 	return $bases['base_path'];
 }
 
 /**
  * Creates an <img> tag for the organization image file name provided.
  */
 function termswatch_org_image_tag($filename, $options = array()){
 	sfLoader::loadHelpers(array('Asset', 'Tag'));
 	return image_tag('orgs/' . $filename, $options);
 }
 
 /**
  * Creates the mission slot for the template.
  */
 function termswatch_generate_mission(array $params){
 	$mission = "<div id=\"mission\" class=\"block\">\n";
 	if (array_key_exists('image', $params)){
 		$mission .= termswatch_org_image_tag($params['image'], 'height=60px width=164px') . "\n";
 	}
 	$mission .= "<div id=\"missiontext\">\n";
 	if (array_key_exists('title', $params)){
 		$mission .= "<h2>" . $params['title'] . "</h2>\n";
 	}
 	if (array_key_exists('subtitle', $params)){
 		$mission .= "<div id=\"missionsub\">" . $params['subtitle'] . "</div>\n";	
 	}
 	$mission .= "<p>" . $params['body'] . "</p>\n";
 	$mission .= "</div><!--missiontext-->\n";
 	$mission .= "<br class='clear'/>\n";
 	$mission .= "</div><!--mission-->\n";
 	
 	return $mission;
 }
 
  function termswatch_convert_smart_quotes($string) { 
    $search = array(chr(145), 
                  chr(146), 
                  chr(147), 
                  chr(148), 
                  chr(151)); 

    $replace = array("'", 
                   "'", 
                   '"', 
                   '"', 
                   '-'); 

    return str_replace($search, $replace, $string); 
  } 
 
 /**
  * these HTML tags provide light formatting
  */ 
  function termswatch_allowed_tags(){
    return "<p><ul><ol><li><h1><h2><h3><h4><h5><b><i><strong><em><br><br/>";
  }


  function termswatch_filter($in){
    $out = preg_replace("{<script(.*?)</script>}si","",$in);  
    $out = termswatch_convert_smart_quotes(strip_tags($out, termswatch_allowed_tags()));
    return $out;
  }
?>
