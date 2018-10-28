$(document).ready(function() {

	var date = new Date();
		yearNow = date.getFullYear();
	$('.yearNow').text(yearNow);

	function htmlEscape(str) {
		return str.replace(/</g,'&lt;').replace(/>/g,'&gt;');
	}

	$('.toggle-show-hide').on('click', function(e) {
		e.stopPropagation();
		var parent = $(this).parent().parent();
			targetId = $(this).attr('target-id');
		$(this).toggleClass('fa-caret-down fa-caret-up');
		parent.find('#'+targetId).toggleClass('toggle-hide');
	});

});