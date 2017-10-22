$(function() {

	$('.list-group-item').on('click', function() {
		$('.fa', this)
			.toggleClass('fa-chevron-right')
			.toggleClass('fa-chevron-down');
	});

});

/*function showLogin() {
	if ($("#login-nav").css('display') == 'none') {
		$("#login-nav").show();
	} else {
		$("#login-nav").hide();
	}
}*/