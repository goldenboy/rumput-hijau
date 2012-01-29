$j = jQuery.noConflict();
$j(document).ready(function(){

	$j("ul.sf-menu").supersubs({ 
		minWidth:    15,   // minimum width of sub-menus in em units 
		maxWidth:    30,   // maximum width of sub-menus in em units 
		extraWidth:  1  
	}).superfish({ 
		delay:       100, 
		speed:       'slow', 
		autoArrows:  true,
		dropShadows: false,
		disableHI: 	 true
	});
	
});