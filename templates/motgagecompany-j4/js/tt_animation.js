; (function ($) {
	let aobj = null, prefix = "ttr_";
	jQuery.fn.TTAnimation = function (settings) {
	prefix = settings.cssPrefix;
	
	jQuery("."+prefix+"animation[data-animation = InvertGrayscale]").css({filter:"grayscale(1)"});
	// Mouse Enter action
	jQuery("."+prefix+"animation").mouseenter(function () {
		// Checking and execute if Selector has data-animation.
		if(jQuery(this).attr("data-animation")){
			// Checking Animation object is null or not if not function call to terminate running animation.
			if(aobj != null){
				AnimationReturn();
			}
			
			aobj = this ; // Assigning object
			let animation = jQuery(aobj).attr("data-animation");
			let ato = jQuery(aobj).attr("data-animation-to");
			let adur = jQuery(aobj).attr("data-animation-dur");
			
			if(animation == "Magnify"){
				Magnify(ato , adur , aobj); // Function call for Magnify Animation.
			}
				
			else if(animation == "MagnifyX"){
				MagnifyX(ato , adur , aobj); // Function call for MagnifyX Animation.
			}
			
			else if(animation == "MagnifyOpacity"){
				jQuery(aobj).css({transition: "", opacity: "0"});
				setTimeout(function(){
					MagnifyOpacity(ato , adur , aobj);  // Function call for MagnifyOpacity Animation.
				});
			}
	
			else if(animation == "Fade"){
				Fade(ato , adur , aobj); // Function call for Fade Animation.
			}
				
			else if(animation == "Rotate"){
				Rotate(ato , adur , aobj); // Function call for Rotate Animation.
			}
			
			else if(animation == "Bloom"){
				Bloom(ato , adur , aobj); // Function call for Bloom Animation.
			}
	
			else if(animation == "Grayscale"){
				Grayscale(ato , adur , aobj); // Function call for Grayscale Animation.
			}

			else if(animation == "InvertGrayscale"){
				InvertGrayscale(ato , adur , aobj); // Function call for Invert Grayscale Animation.
			}
		}
	});
	
	// Mouse leave action.
	jQuery("."+prefix+"animation").mouseleave(function () {
		AnimationReturn(); // Function call to terminate Animation.
	});
	
	// Magnify Animation.
	function Magnify(ato , adur , aobj) {        
		jQuery(aobj).css({
			transform : "scale("+ato+")",
			transition : "transform " + adur + "s linear"
		});
	}
	
	// MagnifyX Animation.
	function MagnifyX(ato , adur , aobj) {
		jQuery(aobj).css({
			transform : "scale("+ato+",1)",
			transition : "transform " + adur + "s linear"
		});
	}

	// MagnifyOpacity Animation.
	function MagnifyOpacity(ato , adur , aobj) {
		jQuery(aobj).css({
			opacity: "1",
			transform : "scale("+ato+")",
			transition : "opacity " + adur + "s linear, transform " + adur + "s linear",
		});
	}
	
	// Rotate Animation.
	function Rotate(ato , adur , aobj) {
		jQuery(aobj).css({
			transform : "rotate("+ato+"deg)",
			transition : "transform " + adur + "s linear"
		});
	}
	
	// Fade Animation.
	function Fade(ato , adur , aobj) {
		jQuery(aobj).css({
			opacity : ato,
			transition : "opacity " + adur + "s linear"
		});
	}

	// Grayscale Animation.
	function Grayscale(ato , adur , aobj) {
		jQuery(aobj).css({
			filter : "grayscale("+(1-ato)+")",
			transition : "filter " + adur + "s linear"
		});
	}	

	// Invert Grayscale Animation.
	function InvertGrayscale(ato , adur , aobj) {
		jQuery(aobj).css({
			filter: "grayscale("+(1-ato)+")",
			transition : "filter " + adur + "s linear",
		});
	}
	
	// Bloom Animation.
	function Bloom(ato , adur , aobj) {
		jQuery(aobj).css({
			filter : "saturate("+ato+") brightness("+1.1+")",
			transition : "filter " + adur + "s linear"
		});
	}
	
	// Function to stop running Animation.
	function AnimationReturn(){
		jQuery(aobj).stop();
		var animationName = jQuery(aobj).attr("data-animation");
		if (animationName == "Magnify" || animationName == "MagnifyX" || animationName == "MagnifyOpacity" || animationName == "Rotate"){
			jQuery(aobj).css({transform : ""}); 
		}
		if(animationName == "MagnifyOpacity" || animationName == "Fade"){
			jQuery(aobj).css({opacity : ""});	
		}
		if (animationName == "Bloom" || animationName == "Grayscale" || animationName == "InvertGrayscale"){
			jQuery(aobj).css({filter : ""});	
			if (animationName == "InvertGrayscale"){
				jQuery(aobj).css({filter:"grayscale(1)"});
			}
		}
		aobj = null;
	}
};
})(jQuery);
