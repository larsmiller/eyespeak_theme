jQuery(document).ready(function($) {
	$('#menu-button').click(function (e) {
	  $('body').toggleClass('active');
	  e.preventDefault();
	});
});