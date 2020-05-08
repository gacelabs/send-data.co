<div class="skew-bg mb-5">
	<div class="skew-bg-child text-center">
		<div class="my-4">
			<h4 class="text-grey"><b>$Name</b></h4>
		</div>
		<div class="row">
			<% loop $ProjectBuilds %>
				<div class="col-lg col-md">
					$TopImage
					<p class="text-all-caps text-warning"><b>$Title</b></p>
					<p class="text-grey">$Description</p>
				</div>
			<% end_loop %>
		</div>
	</div>
</div>