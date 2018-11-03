$(document).ready(function() {

	var date = new Date();
		yearNow = date.getFullYear();
	$('.yearNow').text(yearNow);

	$('.treeview').on('click', function(e) {
		console.log(e.isDefaultPrevented);
	});

	$('ul').tree({
		'followLink': true
	});

	$(function() {
		$('.treeview').on('click', function() {
			$('.domain-project-content').removeClass('active');
			var targetContent = $(this).attr('target-content');
				contentBody = $(this).parents().eq(2).next().find('#admin-content-body');

			contentBody.find('#'+targetContent).addClass('active');
		});
	})

});