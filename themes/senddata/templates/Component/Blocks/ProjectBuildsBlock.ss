
<div class="row">
	<div class="col-12">
		<!-- Portfolio -->
		<section>
			<header class="major">
				<h2>$Name</h2>
			</header>
			<div class="row">
				<% loop $ProjectBuilds %>
					<div class="col-4 col-6-medium col-12-small">
						<section class="box">
							<a href="#" class="image featured">$TopImage.Fill(340, 236)</a>
							<header>
								<h3>$Title</h3>
							</header>
							<p><strong>$Description</strong></p>
						</section>
					</div>
				<% end_loop %>
			</div>
		</section>
	</div>
</div>