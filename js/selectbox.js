jQuery(document).ready(function() {
	jQuery("<select />").appendTo("#main-nav");
		jQuery("<option />", {
		   "selected": "selected",
		   "value"   : "",
		   "text"    : "Go to..."
		}).appendTo("#main-nav select");
		jQuery("#menu-menu li a").each(function() {
		 var el = jQuery(this);
		 jQuery("<option />", {
			 "value"   : el.attr("href"),
			 "text"    : el.text()
		 }).appendTo("#main-nav select");
		});
		//remove options with # symbol for value
		jQuery("#main-nav option").each(function() {
			var navOption = jQuery(this);
			
			if( navOption.val() == '#' ) {
				navOption.remove();
			}
		});
		
		jQuery("#main-nav select").change(function() {
		  window.location = jQuery(this).find("option:selected").val();
		});
});