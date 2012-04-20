/* 
 * Functions used by the admin/ads/addAd view.
 *
 * Author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/08/2009
 */
 
 function get_xmlHttp(){
    var xmlHttp;
    try{
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
    } catch (e){
        try{
            // IE 6.0+
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                // IE 5.5+
                xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
                alert("Your browser does not support AJAX");
                return false;
            }
        }
    }
    return xmlHttp;
 }
 
 function display_percentage(){
    var xmlHttp = get_xmlHttp();
    
    // Actually write the recieved data to the page
    xmlHttp.onreadystatechange=function(){
        if (xmlHttp.readyState==4){
            document.getElementById('display_percentage').innerHTML = "Display Percentage: " + xmlHttp.responseText + "%";
        }
    }
    
    // Get entered values
    var position = document.getElementById('position').value;
    var priority = parseInt(document.getElementById('priority').value);
    
    // Verify entered values
    if (position < 0) return false;
    if (isNaN(priority) || priority < 0) return false;
    
    
    var url = location.href + "?action=get_display_percentage&position=" + position + "&priority=" + priority;
    try{
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
    } catch (e){
        document.getElementById('display_percentage').innerHTML = e;
    }
 }
 
 function run_once(){
    display_percentage();
 }
 
 window.onload = run_once;