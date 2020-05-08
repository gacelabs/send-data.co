<div class="row justify-content-between my-4">
	<div class="col-md-6 col-sm-12 col-xs-12 px-0 product-container">
		<div class="mb-3 px-0">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title text-center"><b>$Name</b></h3>
					<div class="mx-3">
						<% if $MembershipItem.IsSlider %>
							<% with $MembershipItem %>
								<% include SliderBox %>
							<% end_with %>
						<% end_if %>
						$MembershipItem.Content
					</div>
				</div>
				<div class="card-footer">
					$FooterContent
				</div>
			</div>
		</div>
		<% if $Memberships.Count %>
		<div class="row">
			<% loop $Memberships %>
				<div class="col-md-4 col-sm-4 my-2">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-center mb-0"><b>$Title</b></h5>
						</div>
						<div class="card-footer text-center">
							<a href="$Page.Link" class="btn btn-primary">Select</a>
						</div>
					</div>
				</div>
			<% end_loop %>
		</div>
		<% end_if %>
	</div>

	<div class="col-md-6 col-sm-12 col-xs-12 form-container">
		<div class="form-header text-center">
			<h5 class="zero-gaps">REGISTRATION</h5>
		</div>
		$GetForm
	</div>
</div>