(function($) {
	$(document).ready(function() {
    $(".gallery").lightGallery({
        selector: '.gallery-icon a'
    });
		$('.col-sm-1 .post-share').affix({
          offset: {
            top: function () {
              return (this.top = $('.header').outerHeight(true) + $('.pre-header').outerHeight(true))
            },
            bottom: function () {
              return (this.bottom = $('.footer').outerHeight(true))
            }
          }
        });
	});
	$(window).load(function() {
		//JS
	});
})(jQuery);
