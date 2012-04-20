/*
 * Functions used in the admin/ads view.
 *
 * Author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/08/2009
 */

/*
 * Display the Edit Name popup to the user.
 */
function show_edit_name(){
    display = document.getElementById('display_name');
    setSize('edit_name_div', '400', '30');
    setVisible('edit_name_div');
}

/*
 * Display the Edit Position popup to the user.
 */
function show_edit_position(){
    setSize('edit_position_div', '400', '30');
    setVisible('edit_position_div');
}

/*
 * Display the Edit Priority popup to the user.
 */
function show_edit_priority(){
    setSize('edit_priority_div', '450', '60');
    setVisible('edit_priority_div');
}

/*
 * Display the Edit Code popup to the user.
 */
function show_edit_code(){
    setSize('edit_code_div', '600', '200');
    setVisible('edit_code_div');
}

/*
 * Close the dialog that allows a user to edit code.
 */
function close_edit_code(){
    setVisible('edit_code_div', false);
}

/*
 * Display a warning/question about the removal of the current ad.
 */
function show_remove_ad(){
    setSize('remove_ad_div', '400', '200');
    setVisible('remove_ad_div');
}

/*
 * Close the warning/question about the removal of the current ad.
 */
function close_remove_ad(){
    setVisible('remove_ad_div', false);
}

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
    var position = document.getElementById('edit_position_select').value;
    var priority = parseInt(document.getElementById('edit_priority_field').value);
    
    // Verify entered values
    if (position < 0) return false;
    if (isNaN(priority) || priority < 0) return false;
    
    
    var url = location.href + "&action=get_display_percentage&position=" + position + "&priority=" + priority;
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