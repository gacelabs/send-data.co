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

	$('#re-pw-name').on('input', function(e) {
		if ($(this).val() != $('#pw-name').val()) {
			$(this).closest('form').find('button').css('pointer-events', 'none');
			$(this).addClass('input-error');
			$('#pw-name').addClass('input-error');
		} else {
			$(this).closest('form').find('button').css('pointer-events', 'auto');
			$(this).removeClass('input-error');
			$('#pw-name').removeClass('input-error');
		}
	});
	$('#pw-name').on('input', function(e) {
		if ($(this).val() != $('#re-pw-name').val()) {
			$(this).closest('form').find('button').css('pointer-events', 'none');
			$(this).addClass('input-error');
			$('#re-pw-name').addClass('input-error');
		} else {
			$(this).closest('form').find('button').css('pointer-events', 'auto');
			$(this).removeClass('input-error');
			$('#re-pw-name').removeClass('input-error');
		}
	});

});