/*
 * 
 */

/*
 * btw_Element: A class that represents a DOM element's position within the DOM tree.
 * Properties: 	selector 	-> The ancestory of the element
 */
function btw_Element(e){	
	// Find the CSS selector/DOM ancestry for the element
	this.selector = btw_getXPath(e);
}

// Indicates equality between two instances of btw_Element
btw_Element.prototype.equals = function(e){
	return this.selector == e.selector;
}

// Produces a string representation of the element
btw_Element.prototype.toString = function(){
	return this.selector;
}

// Returns an xPath string for the provided element
function btw_getXPath(el){
	var jEl = jQuery(el);
	var xpath = "";
	while (!( jEl.attr('id') || jEl.get(0).tagName.toLowerCase() == "html") ){
		if (jEl.get(0).tagName.toLowerCase() == "tbody"){
			xpath = "/" + xpath;
		} else {
			if (jEl.parent().children(jEl.get(0).tagName).length > 1){
				xpath = "/" + jEl.get(0).tagName.toLowerCase() + "[" 
					+ (jEl.parent().children(jEl.get(0).tagName).index(jEl.get(0)) + 1) + "]" + xpath;
			} else {
				xpath = "/" + jEl.get(0).tagName.toLowerCase() + xpath;
			}
		}
		jEl = jEl.parent();
	}

	if (jEl.attr('id')){
		xpath = "/" + jEl.get(0).tagName.toLowerCase() + "[@id=\\\"" + jEl.attr('id') + "\\\"]" + xpath;
	} else {
		xpath = "/html" + xpath;
	}

	return "/" + xpath;
}

/* 
 * /btw_Element 
 */

/*
 * If the provided btw_Element is in the provided array then the index is returned, otherwise -1 is returned 
 */
function btw_elementIndex(el, a){
	for (var i = 0; i < a.length; i++){
		if (a[i].equals(el)) return i;
	}
	return -1;
}


var btw_selected = new Array();
var btw_css_class = "btw_selected";

/*
 * Returns the DOM element that contains the text that the user has currently selected.
 */
function btw_getElementContainingUserSelection(){
	var userRange;
	var element;

	if (window.getSelection) {
		// Mozilla/W3C Way
		userRange = window.getSelection();
		if (userRange.getRangeAt){
			userRange = userRange.getRangeAt(0);
		} else { // Safari!
			var range = document.createRange();
			range.setStart(userRange.anchorNode, userRange.anchorOffset);
			range.setEnd(userRange.focusNode, userRange.focusOffset);
			userRange = range;
		}
		element = userRange.commonAncestorContainer;
	} else if (document.selection) {
		// Microsoft Way
		userRange = document.selection.createRange();
		element = userRange.parentElement();
	}

	return element;
}

// Register
$(document).ready(function(){

	jQuery("#selectTextButton").bind('click', function(){
		// get the element that contians the selection
		var el = btw_getElementContainingUserSelection();
		while (el.nodeType != 1){
			el = jQuery(el).parent().get(0);
		}
		var btw_el = new btw_Element(jQuery(el));
		btw_selected.push(btw_el);

		var mask = jQuery(el).highlight();
		mask.bind('click', function(e){
			var btw_el = new btw_Element(jQuery(this).parent());
			btw_selected.splice(btw_elementIndex(btw_el, btw_selected), 1);
			jQuery(this).unHighlight();
			e.stopPropagation();
		});
	});

	jQuery("#btw_form").bind("submit", function(e){
                jQuery("#selectedElements").val(btw_selected.toString());;
        });
});
