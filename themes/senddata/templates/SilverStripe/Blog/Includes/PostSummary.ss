
<div class="col-6 col-12-small">
	<section class="box">
		<a href="$Link" class="image featured">$FeaturedImage.ScaleWidth(795)</a>
		<header>
			<h3>
				<% if $MenuTitle %>
					$MenuTitle
				<% else %>
					$Title
				<% end_if %>
			</h3>
			<p>Posted $PublishDate.ago</p>
		</header>
		<% if $Summary %>
			$Summary
		<% else %>
			<p>$Excerpt</p>
		<% end_if %>
		<footer>
			<ul class="actions">
				<li><a href="$Link" class="button icon solid fa-file-alt">Continue Reading</a></li>
				<%-- <li><a href="#" class="button alt icon solid fa-comment">33 comments</a></li> --%>
			</ul>
		</footer>
	</section>
</div>
