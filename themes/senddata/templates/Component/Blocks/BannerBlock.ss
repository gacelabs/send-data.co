
<!-- Banner -->
<section id="banner" style="background: url('$Banner.Link') center center no-repeat;">
	<header>
		<h2>$UpperRightText.Plain</h2>
		<p>$UpperRightSubText</p>
		<% if $IsRightButtonAnchor %>
			<br>
			<a class="button" href="$RightButtonAnchorText">$UpperRightButtonText</a>
		<% else %>
			<br>
			<a class="button" href="$UpperRightButton.Link">$UpperRightButtonText</a>
		<% end_if %>
	</header>
</section>