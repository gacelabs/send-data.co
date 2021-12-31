(function ($) {
	$.entwine('ss', function ($) {
		$('[data-listboxlimit]').entwine({
			'onchange': function () {
				var limit = $(this).data('listboxlimit');
				var arrSelected = $(this).val();
				if (arrSelected != null) {
					if (limit == arrSelected.length) {
						$(this).find('option:not(:selected)').attr('disabled', 'disabled');
						$(this).trigger('chosen:updated');
						$(this).find('option:not(:selected)').removeAttr('disabled');
					} else {
						$(this).find('option[disabled]').removeAttr('disabled');
						$(this).trigger('chosen:updated');
					}
				}
			}
		});

		loadListLimit();
	});

	function loadListLimit() {
		$('[data-listboxlimit]').each(function(i, elem) {
			var limit = $(elem).data('listboxlimit');
			var arrSelected = $(elem).val();
			if (arrSelected != null) {
				if (limit == arrSelected.length) {
					$(elem).find('option:not(:selected)').attr('disabled', 'disabled');
				}
				$(elem).trigger('chosen:updated');
				// $(elem).find('option').removeAttr('disabled');
			}
		});
	}

	$(document).ajaxComplete(function() {
		loadListLimit();
	});

})(jQuery);