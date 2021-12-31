$(document).ready(function() {
	jQuery.validator.addMethod("emailExt", function(value, element, param) {
		return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
	},'Your E-mail is wrong');

	jQuery.validator.addMethod("phoneExt", function(value, element, param) {
		return /^((0|\+?61)((2 ?[3-9]|3 ?[4-9]|7 ?[3-9])(\d{7}|\d{3} ?\d{4})|[8,4](\d{8}|\d{2} ?\d{3} ?\d{3}))|0500[\d]{6}|0550[\d]{6}|059[\d]{7}|13[\d]{4}|1300\d{6}|1800\d{6}|0198\d{2}|0198\d{6}|190\d{7})$/.test(value);
	},'Please enter a valid phone number');

	var forms = $('.form-validate');

	forms.each(function(i, elem) {
		var form = $(elem);

		form.validate({
			ignore: '.ignore',
			errorPlacement: function(error, element) {
				//Add error message
				if (element.prop("tagName") === 'SELECT' && element.hasClass('chosen-select')) {
					element.parent('div').find('.chosen-container-single').addClass('error');
				} else {
					element.parent('div').addClass('error');
				}
				$('body').removeClass('page-loading');
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass('error');
				$(element).parent('div').addClass('error');
				$('body').removeClass('page-loading');
			},
			unhighlight: function (element, errorClass, validClass) {
				// console.log(element);
				if (element.id != 'url-name') {
					$(element).removeClass('error');
					$(element).parent('div').removeClass('error');
				}
			},
			rules: {
				'Email': {
					required:  true,
					emailExt: true
				},
				'Phone': {
					required: true,
					phoneExt: true
				}
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});
});