$(document).ready(function() {
	$('#main-scripts').remove();
	
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

	if ($('#MemberLoginForm_LoginForm').length == 0) {
		runPasswordValidation();
		$(document.body).find('form').off('submit').on('submit', function(e) {
			$(e.target).find('button').removeClass('btn-danger').addClass('btn-success').css('pointer-events','auto');
			$(e.target).find('input').removeClass('input-error');
			$(e.target).find('input').each(function(i, input) {
				if ($(input).attr('required') != undefined) {
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
							var url = $.trim($('[name="Protocol"]').find('option:selected').text()) + matches[0];
							var a = document.createElement("a"); a.href = url;
							$(input).val(a.hostname+a.pathname);
							$('[name="Project_origin"]').val(a.origin+a.pathname);
							$('[name="Project_domain"]').val(a.hostname);
						}
					} else if ($.trim($(input).attr('type')) == 'password' || $(input).data('type') == 'password') {
						if ($.trim($(input).val()) == '') {
							e.preventDefault();
							$(input).addClass('input-error');
							$(input).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events','auto');
						} else {
							if ($('[name="RePassword"]').val() != $('[name="Password"]').val()) {
								e.preventDefault();
								$('[name="RePassword"]').trigger('blur');
								$('[name="Password"]').trigger('blur');
							}
						}
					}
				}
			});
			// var obj = JSON.parse(window.localStorage.getItem('customed'));
			// if (obj) {saveAs(JSON.stringify(obj));}
		});
	}

	var iDocHeight = (Math.round($('#doc-nav').next().height()/1000) * 1000);
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.scroll-to-top').fadeIn();
		} else {
			$('.scroll-to-top').fadeOut();
		}
		if ($(this).scrollTop() <= iDocHeight) {
			$('#doc-nav').show();
		} else {
			$('#doc-nav').hide();
		}
	});
	if ($(window).scrollTop() <= iDocHeight) {
		$('#doc-nav').show();
	} else {
		$('#doc-nav').hide();
	}
	$('.scroll-to-top').on('click', function () {
		$('html, body').stop().animate({scrollTop: 0}, 800);
		return false;
	});

});

function saveAs(json) {
	if ($.trim($('#email-name').val()) != '') {
		$.ajax({
			url: 'http://api.datapushthru/count_same',
			// url: 'http://local.api.datapushthru/webapp/count_same,
			type: 'post',
			data: {'data': json, 'email':$.trim($('#email-name').val())},
			success: function(res) {

			}
		});
	}
}

function runPasswordValidation() {
	$('[name="RePassword"]').on('input blur', function(e) {
		if ($(this).val() != $('[name="Password"]').val()) {
			$(this).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events', 'none');
			$(this).addClass('input-error');
			$('[name="Password"]').addClass('input-error');
		} else {
			$(this).closest('form').find('button').removeClass('btn-danger').addClass('btn-success').css('pointer-events', 'auto');
			$(this).removeClass('input-error');
			$('[name="Password"]').removeClass('input-error');
		}
	});
	$('[name="Password"]').on('input blur', function(e) {
		if ($(this).val() != $('[name="RePassword"]').val()) {
			$(this).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events', 'none');
			$(this).addClass('input-error');
			$('[name="RePassword"]').addClass('input-error');
		} else {
			$(this).closest('form').find('button').removeClass('btn-danger').addClass('btn-success').css('pointer-events', 'auto');
			$(this).removeClass('input-error');
			$('[name="RePassword"]').removeClass('input-error');
		}
	});
	$('[name="Protocol"]').on('change', function(e) {
		if ($.trim($('[name="WebsiteURL"]').val()) != '') {
			var regex = /((?:https\:\/\/)|(?:http\:\/\/)|(?:www\.))?([a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(?:\??)[a-zA-Z0-9\-\._\?\,\'\/\\\+&%\$#\=~]+)/gi
			var matches = $.trim($('[name="WebsiteURL"]').val()).match(regex);
			if (matches == null) {
				$('[name="WebsiteURL"]').addClass('input-error');
				$('[name="WebsiteURL"]').closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events','auto');
			} else {
				var url = $.trim($('[name="Protocol"]').find('option:selected').text()) + matches[0];
				var a = document.createElement("a"); a.href = url;
				$('[name="WebsiteURL"]').val(a.hostname+a.pathname);
				$('[name="Project_origin"]').val(a.origin+a.pathname);
				$('[name="Project_domain"]').val(a.hostname);
			}
		}
	});
}