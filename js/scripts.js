AOS.init();

jQuery(function () {
	jQuery('main').on('scroll', function () {
		if (jQuery('main').scrollTop() > 50) {
			jQuery('#backTop').fadeIn();
		} else {
			jQuery('#backTop').fadeOut();
		}
	});
	// scroll body to 0px on click
	jQuery('#backTop').click(function () {
		jQuery('main').animate({
			scrollTop: 0
		}, 400);
		return false;
	});
});

jQuery(function () {
	jQuery('main').on('scroll', function () {
		var winScroll = jQuery('main').scrollTop();
		var height = jQuery('main').get(0).scrollHeight - jQuery('main').get(0).clientHeight;
		var scrolled = (winScroll / height) * 100;
		var bar = document.getElementById("myBar");
		if (bar) {
			bar.style.width = scrolled + "%";
		}
	});
});
