<div class="business-header" style="background: url('$Banner.Link') center center no-repeat scroll;">
	<div class="px-5 pt-5 pull-right d-none d-sm-block">
		<% if $UpperLeftText %>$UpperLeftText<% end_if %>
		<div style="margin-top: 20px;">
			<% if $IsLeftButtonAnchor %>
				<a class="btn btn-lg btn-success ss-broken" style="vertical-align: baseline;" href="$LeftButtonAnchorText">$UpperLeftButtonText</a>
			<% else %>
				<a class="btn btn-lg btn-success ss-broken" style="vertical-align: baseline;" href="$UpperLeftButton.Link">$UpperLeftButtonText</a>
			<% end_if %>
		</div>
		<% if $UpperLeftSubText %>
			<div class="mt-4">
				<p class="text-white">$UpperLeftSubText</p>
			</div>
		<% end_if %>
	</div>
	<div class="px-5 pt-3 pull-left d-sm-none d-md-block">
		$UpperRightText
		<div class="mt-4">
			<p class="text-white">$UpperRightSubText</p>
			<% if $IsRightButtonAnchor %>
				<a class="btn btn-warning" href="$RightButtonAnchorText">$UpperRightButtonText</a>
			<% else %>
				<a class="btn btn-warning" href="$UpperRightButton.Link">$UpperRightButtonText</a>
			<% end_if %>
		</div>
	</div>
</div>