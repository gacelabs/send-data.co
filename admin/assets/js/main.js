$(document).ready(function() {

	var date = new Date();
		yearNow = date.getFullYear();
	$('.yearNow').text(yearNow);

	setTimeout(function() {
		$('.treeview').click();
	},5000);

	$('.treeview').on('click', function() {
		var targetDash = $(this).attr('target-dash');

				
	});

});