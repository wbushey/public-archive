/* 
 * Functions used by the admin/tourney/newTourney view.
 *
 * Author Bill Bushey <wbushey@acm.org>
 * Last Updated 05/12/2009
 */
 
function selectAll(chk){
	for(i=0; i < chk.length; i++){
		chk[i].checked = true;
	}
	printCount();
}

function unSelectAll(chk){
	for(i=0; i < chk.length; i++){
		chk[i].checked = false;
	}
	printCount();
}

function countChecked(chk){
	var checked = 0;
	for(i=0; i < chk.length; i++){
		if (chk[i].checked == true) checked++;
	}
	return checked;
}

function is_int(value){
	  if((parseFloat(value) == parseInt(value)) && !isNaN(parseInt(value))){
	      return true;
	 } else {
	      return false;
	 }
	}

function log2(x){
	return Math.log(x)/Math.log(2);
}

function printCount(){
	var div = document.getElementById('checkCount');
	var count = countChecked(document.getElementsByName('celebs[]'));
	if (is_int(log2(count))){
		div.innerHTML = "<font color='green' size='4'>" + count + "</font>";
	} else {
		div.innerHTML = "<font color='red' size='4'>" + count + "</font>";
	}
}

function validate_form(){
	var count = countChecked(document.getElementsByName('celebs[]'));
	if (is_int(log2(count))){
		return true;
	} else {
		alert('The number of selected celebrities must be a power of 2.');
		return false;
	}
	
}

function run_once(){
    printCount();
 }
 
 window.onload = run_once;