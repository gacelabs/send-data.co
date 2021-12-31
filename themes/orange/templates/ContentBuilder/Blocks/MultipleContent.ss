<% if not $HideTitles %>
	<div class="skew-bg mb-5">
		<div class="skew-bg-child text-center">
			<div class="my-4">
				<h4 class="text-grey"><b>$Name</b></h4>
			</div>
			<div class="row">
				<% loop $StepItems %>
					<div class="col-lg col-md">
						$Description
					</div>
				<% end_loop %>
			</div>
		</div>
	</div>
<% else %>
	<div class="text-center my-5">
		<h4 class="mt-4 mb-4 text-grey"><b>$Name</b></h4>
		<div>
			<ul class="inline-list center">
				<% loop $StepItems %>
					<li><img alt="$Title" src="$Image.Link" width="130"></li>
				<% end_loop %>
			</ul>
		</div>
	</div>
<% end_if %>