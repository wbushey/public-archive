<?php
/**
 * Class which provides the common static methods required by the
 * various parts of the main site's layout.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 12/29/08
 * TODO: Generate links using appropriate view's getClassViewUrl() function
 */

class cbf_MainLayout{
    
    /**
     * Returns the code string that will display the top ad
     */
    public static function get_top_ad(){
        /*$db_adapter = Propel::getDB();
        $db_adapter->random();*/
    }
    
    /**
     * Generates the HTML needed to display the menu. The generated menu
     * will vary depending on whether the user is logged in or not.
     *
     * @param bool $is_logged_in
     * @return string containing HTML for a menu
     */
    public static function generate_menu($is_logged_in){
        if ($is_logged_in){
        	$logout_link = cbf_LogoutView::getClassViewUrl();
            $text = <<< END_OF_LOGGEDIN
              <li><a href="$logout_link">Log Out</a></li>
END_OF_LOGGEDIN;
        } else {
        	
        	$login_link = cbf_LoginView::getClassViewUrl();
        	$register_link = cbf_AddUserView::getClassViewUrl();
            $text = <<< END_OF_NOTLOGGEDIN
              <li><a href="$login_link">Login</a></li>
              <li><a href="$register_link">Register</a></li>
END_OF_NOTLOGGEDIN;
        }
        
        /*
         * Common Menu Items
         */
        $aboutUs_link = cbf_AboutUsView::getClassViewUrl();
        $text .= <<< END_OF_STANDARD_MENU
              <li><a href="$aboutUs_link">About Us</a></li>
END_OF_STANDARD_MENU;
        
        return $text;
    }
    
    /**
     * Generates the HTML needed to display the copyright notice
     * in the footer, as well as any other text that is common to
     * the footer of the main site. The provided $year argument
     * will be placed in the generated HTML as the current year.
     *
     * @param integer $year - The year to use as the current year in the copyright notice
     * @return string containing the HTML needed to display the footer text
     */
    public static function generate_footer_text($year){
        $text = <<< END_OF_FOOTER
    <div id="footerText">
          <p>&copy 2007-$year David Neuburger & Bill Bushey</p>
          <p>Site Design and Development by Bill Bushey</p>
        </div>
END_OF_FOOTER;

        return $text;
    }
}

/**
 * Extreme tracker code
 */
/*
 <div id="eXTReMe"><a href="http://extremetracking.com/open?login=virlkflk">
<img src="http://t1.extreme-dm.com/i.gif" style="border: 0;"
height="38" width="41" id="EXim" alt="eXTReMe Tracker" /></a>
<script type="text/javascript"><!--
var EXlogin='virlkflk' // Login
var EXvsrv='s11' // VServer
EXs=screen;EXw=EXs.width;navigator.appName!="Netscape"?
EXb=EXs.colorDepth:EXb=EXs.pixelDepth;
navigator.javaEnabled()==1?EXjv="y":EXjv="n";
EXd=document;EXw?"":EXw="na";EXb?"":EXb="na";
EXd.write("<img src=http://e2.extreme-dm.com",
"/"+EXvsrv+".g?login="+EXlogin+"&amp;",
"jv="+EXjv+"&amp;j=y&amp;srw="+EXw+"&amp;srb="+EXb+"&amp;",
"l="+escape(EXd.referrer)+" height=1 width=1>");//-->
</script><noscript><div id="neXTReMe"><img height="1" width="1" alt=""
src="http://e2.extreme-dm.com/s11.g?login=virlkflk&amp;j=n&amp;jv=n"
 />
</div></noscript></div>
 */
?>