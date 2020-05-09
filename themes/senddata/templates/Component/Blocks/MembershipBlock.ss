
<!-- Intro -->
<section id="intro" class="container">
	<div class="row">
		<% loop $MembershipItems %>
			<div class="col-4 col-12-medium">
				<section class="<% if $First %>first<% else_if $Last %>last<% else %><% if $Top.getController.Link == '/home/' %>middle<% end_if %><% end_if %>">
					<i class="icon solid featured 
						fa-<% if $First %>star<% else_if $Last %>tools<% else %>bolt<% end_if %>
						<% if not $First && not $Last %> alt<% else_if $Last %> alt2<% end_if %>"></i>
					<header>
						<h2>$Title</h2>
					</header>
					<p>$Content</p>
					<br>
					<footer>
						<ul class="actions">
							<li><a href="$Page.Link" class="button<% if not $First && not $Last %> alt<% else_if $Last %> alt2<% end_if %>">$ButtonText</a></li>
						</ul>
					</footer>
				</section>
			</div>
		<% end_loop %>
	</div>
</section>