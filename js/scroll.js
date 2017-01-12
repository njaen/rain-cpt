var off = 1;
jQuery(document).ready(function() {
	var win = jQuery(window);
	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if (jQuery(document).height() - win.height() == win.scrollTop()) {
			if(jQuery('#no-more-products').length>0){
				return;
			}
			jQuery('#loading').show();

			jQuery.ajax({
                    type: "GET",
                    url: scrollToInfinte.ajax_dir,
                    dataType: 'html',
                    data: {action:'loadMoreProducts', offset: off++},
                    success: function(html) {
						jQuery('#products-list-container').append(html);
						jQuery('#loading').hide();
					}
                });
		}
	});
});