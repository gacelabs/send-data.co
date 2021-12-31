/*FOR Product and Product Category ONLY*/
var isReqAjax = false;

function doProductAjax(urlPath, noPushState) {
	if (noPushState == undefined) noPushState = false;
	var oOptions = {
		url: urlPath,
		type: 'post',
		dataType: 'json',
		cache: false,
		success: function(data) {
			processProductAjaxData(data, urlPath, function(res, pagination) {
				bindProductAjax(pagination);
			}, noPushState);
		},
		complete: function() {
			bindProductAjax($('.pagination'));
		}
	};
	if (isReqAjax != false) isReqAjax.abort();
	isReqAjax = $.ajax(oOptions);
}

function processProductAjaxData(response, urlPath, callBack, noPushState){
	if (noPushState == false) {
		document.title = response.pageTitle;
		var state = {href: urlPath, pageTitle: response.pageTitle};
		window.history.pushState(state, response.pageTitle, urlPath);
		window.localStorage.setItem('popState', JSON.stringify(state));
	} else {
		var arSegments = urlPath.split('/search/');
		if (arSegments.length > 1) {
			$('.filter-list').find('input').removeAttr('checked');
			$('.filter-list').find('input[value=all]').prop('checked', true);
			$('[checkbox-label]').text('ALL');
			var arColumns = arSegments[1].split('/');
			if (arColumns.length) {
				for (var x in arColumns) {
					var arField = arColumns[x].split(':');
					if (arField.length && typeof arField[1] != 'undefined') {
						var field = arField[0],
							arValues = [arField[1]];
						if (arField[1].indexOf(',')) {
							arValues = arField[1].split(',');
						}
						for (var y in arValues) {
							var value = decodeURIComponent(arValues[y]);
							var ui = $('[data-name="'+field+'"][value="'+value+'"]');
							if ($.inArray(ui.attr('type'), ['radio','checkbox']) >= 0) {
								ui.parents('.filter-option-checkboxes').find('#'+field+'-all').removeAttr('checked');
								ui.prop('checked', true);
								var sItemWord = ' ITEM';
								if (arValues.length > 1) sItemWord = ' ITEMS';
								ui.parents('.slide-filter-holder').find('[checkbox-label]').text(arValues.length + sItemWord);
							}
						}
					}
				}
			}
		}
	}

	console.log('fetching ...');
	var i = setTimeout(function() {
		$('#filtered-products').html(response.html);
		$('.psh').matchHeight('remove');
		$('.psh').matchHeight({ byRow: false });
		$('.nsh').matchHeight({ byRow: false });
		console.log('done!');
		var pagination = $(document.body).find('.pagination');
		if (typeof callBack == 'function') callBack(response, pagination);
	}, 900);
	if (typeof callBack == 'function') callBack(response);
	// window.location.href = urlPath;
}

function bindProductAjax(ui) {
	var pageItem = '.pagination li a[href!="javascript:;"]';
	$(document).off('click', pageItem).on('click', pageItem, function(e) {
		e.preventDefault();
		
		if($('.page-filter').length && $(document).scrollTop() > $(".page-filter").offset().top) {
			$([document.documentElement, document.body]).animate({
				scrollTop: $(".page-filter").offset().top
			}, 1250);
		}

		var urlPath = $(e.target).attr('href');
		if ($(e.target).prop('tagName') != 'a') {
			urlPath = $(e.target).closest('a').attr('href');
		}
		doProductAjax(urlPath);
	});
}

function getProductFilterURI(uiForm, uri) {
	if (uri == undefined) uri = '';
	uiForm.find('input').each(function(i, elem) {
		if ($(elem).is(':checked') && elem.value != 'all') {
			$('#'+$(elem).data('name')+'-all').removeAttr('checked');
			if ($(elem).attr('type') != 'radio') {
				if (uri.indexOf($(elem).data('name')) >= 0) {
					uri += ','+elem.value+'/';
				} else {
					uri += $(elem).data('name')+':'+elem.value+'/';
				}
			} else {
				uri += elem.name+':'+elem.value+'/';
			}
			uri = uri.replace('/,', ',');
		}
		var sText = 'ALL';
		if ($(elem).attr('type') != 'radio') {
			var name = $(elem).data('name');
			var iCheckedCnt = $('[data-name='+name+']:checked:not([value=all])').length;
			if (iCheckedCnt > 0) sText = iCheckedCnt + ' Item' + (iCheckedCnt > 1 ? 's' : ''); 
		} else {
			var name = $(elem).attr('name');
			sText = $('[name='+name+']:checked').val();
		}
		$('[checkbox-label='+name+']').text(sText);
	});
	return uri;
}

window.onpopstate = history.onpushstate = function(e) {
	// console.log(e);
	if (e.state != null) {
		doProductAjax(e.state.href, true);
	} else if (e.state == null) {
		window.location.reload(true);
	}
};
/*FOR Product and Product Category ONLY*/