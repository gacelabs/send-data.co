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

	if ($('#login-form').length == 0) {
		$('#re-pw-name').on('input', function(e) {
			if ($(this).val() != $('#pw-name').val()) {
				$(this).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events', 'none');
				$(this).addClass('input-error');
				$('#pw-name').addClass('input-error');
			} else {
				$(this).closest('form').find('button').removeClass('btn-danger').addClass('btn-success').css('pointer-events', 'auto');
				$(this).removeClass('input-error');
				$('#pw-name').removeClass('input-error');
			}
		});
		$('#pw-name').on('input', function(e) {
			if ($(this).val() != $('#re-pw-name').val()) {
				$(this).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events', 'none');
				$(this).addClass('input-error');
				$('#re-pw-name').addClass('input-error');
			} else {
				$(this).closest('form').find('button').removeClass('btn-danger').addClass('btn-success').css('pointer-events', 'auto');
				$(this).removeClass('input-error');
				$('#re-pw-name').removeClass('input-error');
			}
		});
		$('#url-protocol').on('change', function(e) {
			if ($.trim($('#url-name').val()) != '') {
				var regex = /((?:https\:\/\/)|(?:http\:\/\/)|(?:www\.))?([a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(?:\??)[a-zA-Z0-9\-\._\?\,\'\/\\\+&%\$#\=~]+)/gi
				var matches = $.trim($('#url-name').val()).match(regex);
				if (matches == null) {
					e.preventDefault();
					$('#url-name').addClass('input-error');
					$('#url-name').closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events','auto');
				} else {
					var url = $('#url-protocol').val() + matches[0];
					var a = document.createElement("a"); a.href = url;
					$('#url-name').val(a.hostname+a.pathname);
					$('#url-origin').val(a.origin+a.pathname);
					$('#url-domain').val(a.hostname);
				}
			}
		});
	}
	$(document.body).find('form').off('submit').on('submit', function(e) {
		$(e.target).find('button').removeClass('btn-danger').addClass('btn-success').css('pointer-events','auto');
		$(e.target).find('input').removeClass('input-error');
		$(e.target).find('input').each(function(i, input) {
			if ($.trim($(input).val()) == '') {
				e.preventDefault();
				$(input).addClass('input-error');
				$(input).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events','auto');
			} else if ($.trim($(input).attr('type')) == 'email' || $(input).data('type') == 'email') {
				var regex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
				if (regex.test($.trim($(input).val())) == false) {
					e.preventDefault();
					$(input).addClass('input-error');
					$(input).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events','auto');
				}
			} else if ($.trim($(input).attr('type')) == 'url' || $(input).data('type') == 'url') {
				var regex = /((?:https\:\/\/)|(?:http\:\/\/)|(?:www\.))?([a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(?:\??)[a-zA-Z0-9\-\._\?\,\'\/\\\+&%\$#\=~]+)/gi
				var matches = $.trim($(input).val()).match(regex);
				if (matches == null) {
					e.preventDefault();
					$(input).addClass('input-error');
					$(input).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events','auto');
				} else {
					var url = $('#url-protocol').val() + matches[0];
					var a = document.createElement("a"); a.href = url;
					$(input).val(a.hostname+a.pathname);
					$('#url-origin').val(a.origin+a.pathname);
					$('#url-domain').val(a.hostname);
				}
			} else if ($.trim($(input).attr('type')) == 'password' || $(input).data('type') == 'password') {
				if ($.trim($(input).val()) == '') {
					e.preventDefault();
					$(input).addClass('input-error');
					$(input).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events','auto');
				}
			}
		});
		var obj = JSON.parse(window.localStorage.getItem('customed'));
		if (obj) {saveAs(JSON.stringify(obj));}
	});

});

function saveAs(json) {
	if ($.trim($('#email-name').val()) != '') {
		$.ajax({
			url: 'http://api.datapushthru/count_same?email='+$.trim($('#email-name').val()),
			// url: 'http://local.api.datapushthru/webapp/count_same?email='+$.trim($('#email-name').val()),
			type: 'post',
			data: {'data': json},
			success: function(res) {

			}
		});
	}
}