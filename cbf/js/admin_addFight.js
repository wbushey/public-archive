/*
 * Functions used in the admin/fights/addFight view.
 * Most of these functions are copied or based on functions from 
 * http://www.webscriptexpert.com/Javascript/Javascript%20QuickSelect%20(Coordinated%20Textbox%20And%20ListBox)/
 *
 * Author Bill Bushey <wbushey@acm.org>
 * Last Updated 9/05/2008
 */
 
function run_once(){
        // in your onload event handler you need this

        // hookup event handlers and control references
        var objElement = document.getElementById('celeb1');
        if ( objElement ){
        	objElement.textbox = document.getElementById('celeb1Search');
	       	if ( objElement.textbox ){
	        	objElement.textbox.onkeyup = QuickSelect_KeyUp;
	            objElement.textbox.listbox = objElement;
	        }
		}  
            
        var objElement = document.getElementById('celeb2');
        if ( objElement ){
        	objElement.textbox = document.getElementById('celeb2Search');
           	if ( objElement.textbox ){
            	objElement.textbox.onkeyup = QuickSelect_KeyUp;
            	objElement.textbox.listbox = objElement;
            }
        }     
}
 
window.onload = run_once;

	// ----------------------------------------------------------------------------
    // QuickSelect_TextChange
    //
    // Description : event handler for quick select textbox's change & onblur events
    //    makes sure item in textbox is a value from list
    //
    // Arguments : none
    //
    // Dependencies : none
    //
    // History :
    // 2006.08.09 - WSR : created
    //
    function QuickSelect_KeyUp(e){
    	var numCharCode;
       	var strEntry = this.value;
       	var select = this.listbox;
       	var allOptions = document.getElementById('allOptionsSelect');
       	var numOptions = allOptions.options.length;
       	var matchingOptions = new Array();
       
       	// First figure out if a printable key was pressed
       	// If not then stop working
    	if (e.keyCode) numCharCode = e.keyCode;
    	if (!((numCharCode >= 32 && numCharCode <= 126) || numCharCode == 8) ) return;

        
        // cycle through options
        var x = 0;
        for (var i = 0; i < numOptions; i++){
            var option = allOptions[i].cloneNode(true);
            if ((option) && (option.text.toLowerCase().indexOf(strEntry.toLowerCase()) == 0)){
                matchingOptions[x] = option;
                x++;
            }
        }
        
        // Set the display
        select.options.length = x;
        for (var i = 0; i < x; i++){
            select.options[i] = matchingOptions[i];
        }
    }
    //
    // QuickSelect_TextChange
    // ----------------------------------------------------------------------------