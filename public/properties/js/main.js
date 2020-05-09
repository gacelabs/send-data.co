/*
	Dopetrope by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

	var	$window = $(window),
		$body = $('body');

	// Breakpoints.
		breakpoints({
			xlarge:  [ '1281px',  '1680px' ],
			large:   [ '981px',   '1280px' ],
			medium:  [ '737px',   '980px'  ],
			small:   [ null,      '736px'  ]
		});

	// Play initial animations on page load.
		$window.on('load', function() {
			window.setTimeout(function() {
				$body.removeClass('is-preload');
			}, 100);
		});

	// Dropdowns.
		$('#nav > ul').dropotron({
			mode: 'fade',
			noOpenerFade: true,
			alignment: 'center'
		});

	// Nav.

		// Title Bar.
			$(
				'<div id="titleBar">' +
					'<a href="#navPanel" class="toggle"></a>' +
				'</div>'
			)
				.appendTo($body);

		// Panel.
			$(
				'<div id="navPanel">' +
					'<nav>' +
						$('#nav').navList() +
					'</nav>' +
				'</div>'
			)
				.appendTo($body)
				.panel({
					delay: 500,
					hideOnClick: true,
					hideOnSwipe: true,
					resetScroll: true,
					resetForms: true,
					side: 'left',
					target: $body,
					visibleClass: 'navPanel-visible'
				});

})(jQuery);

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

    if ($('#FormHandler_FormHandler').length) {
    	var recaptchas = $('.g-recaptcha');
		window.reCaptchaLoad = function () {
			$.each(recaptchas, function(i, elem) {
				var id = grecaptcha.render(elem, {'sitekey': $(elem).data('sitekey')});
				$(elem).attr('data-id', id);
			});
		}

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
                            $('[name="Projects_origin"]').val(a.origin+a.pathname);
                            $('[name="Projects_domain"]').val(a.hostname);
                        }
                    } else if ($.trim($(input).attr('type')) == 'password' || $(input).data('type') == 'password') {
                        if ($.trim($(input).val()) == '') {
                            e.preventDefault();
                            $(input).addClass('input-error');
                            $(input).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events','auto');
                        } else {
                            if ($('[name="RePassword"]').val() != $('[name="Accounts_password"]').val()) {
                                e.preventDefault();
                                $('[name="RePassword"]').trigger('blur');
                                $('[name="Accounts_password"]').trigger('blur');
                            }
                        }
                    }
                }
            });
			var id = $(e.target).find('.g-recaptcha').data('id');
			console.log(id)
			grecaptcha.execute(window.parseInt(id));
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
        // Title Bar.
            $(
                '<div id="titleBar">' +
                    '<a href="#navPanel" class="toggle"></a>' +
                '</div>'
            )
                .appendTo($body);

            }
        });
    }
}

function runPasswordValidation() {
    $('[name="RePassword"]').on('input blur', function(e) {
        if ($(this).val() != $('[name="Accounts_password"]').val()) {
            $(this).closest('form').find('button').removeClass('btn-success').addClass('btn-danger').css('pointer-events', 'none');
            $(this).addClass('input-error');
            $('[name="Accounts_password"]').addClass('input-error');
        } else {
            $(this).closest('form').find('button').removeClass('btn-danger').addClass('btn-success').css('pointer-events', 'auto');
            $(this).removeClass('input-error');
            $('[name="Accounts_password"]').removeClass('input-error');
        }
    });
    $('[name="Accounts_password"]').on('input blur', function(e) {
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
                $('[name="Projects_origin"]').val(a.origin+a.pathname);
                $('[name="Projects_domain"]').val(a.hostname);
            }
        }
    });
    $('[name="WebsiteURL"]').on('blur input', function(e) {
        if ($.trim($(this).val()) != '') {
            $('[name="Protocol"]').trigger('change');
        }
    });
}