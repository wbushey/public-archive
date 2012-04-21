/*
 *
 */

(function($){

	$.fn.highlight = function(){
			// Apply CSS
			if ($(this).css("position") == "static"){
                        	$(this).addClass("masked-relative");
                	}
                	$(this).addClass("masked");
			var maskDiv = $('<div class="mask"></div>');

			// Insert masking div into the element
                	$(this).append(maskDiv);

			// Return the created mask so a bind can occur
			return maskDiv;
	}

	$.fn.unHighlight = function(){
			// Remove the mask
			var p = $(this).parent();
			p.removeClass("masked-relative");
			p.removeClass("mask");
			$(this).remove();
	}
})(jQuery);
