
<div class="row">
	<div class="col-4 col-12-medium">
		<!-- Sidebar -->
		<section class="box">
			<header>
				<h3>$Name</h3>
				<% if $MembershipItem.IsSlider %>
					<% with $MembershipItem %>
						<% include SliderBox %>
					<% end_with %>
				<% end_if %>
			</header>
			$MembershipItem.Content
			<footer>
				$FooterContent
			</footer>
		</section>
		<% if $Memberships.Count %>
		<section class="box">
			<header>
				<h3>Other Memberships</h3>
				<p>You may also try:</p>
			</header>
			<ul class="divided">
				<% loop $Memberships %>
					<% if $Title != $Top.Name %>
						<li>
							<a href="$Page.Link" class="button<% if not $First && not $Last %> alt<% else_if $Last %> alt2<% end_if %>">
								$Title 
								<i class="icon solid fa-<% if $First %>star<% else_if $Last %>tools<% else %>bolt<% end_if %>"></i>
							</a>
						</li>
					<% end_if %>
				<% end_loop %>
			</ul>
		</section>
		<% end_if %>
	</div>
	<div class="col-8 col-12-medium imp-medium">
		<!-- Content -->
		<article class="box post">
			<header>
				<h2>REGISTRATION</h2>
				<p>Please fill-out all fields.</p>
			</header>
			$GetForm
			<p class="mb-0">Add <b>$Name Product</b> to an existing account? <a href="/login">Login here</a></p>
		</article>
	</div>
</div>