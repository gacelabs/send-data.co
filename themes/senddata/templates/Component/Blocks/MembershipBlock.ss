<div class="row"<% if $Anchor %> id="$Anchor"<% end_if %>>&nbsp;</div>
<div class="text-center">
	<h4 class="mt-1 mb-4 text-grey"><b>$Name</b></h4>
</div>
<div class="row">
	<% loop $MembershipItems %>
		<div class="col-lg col-md mt-3 mb-5">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title text-center"><b>$Title</b></h4>
					<% if $IsSlider %>
						<% include SliderBox %>
					<% end_if %>
					$Content
				</div>
				<div class="card-footer text-center">
					<a href="$Page.Link" class="btn btn-primary">$ButtonText</a>
				</div>
			</div>
		</div>
	<% end_loop %>
</div>