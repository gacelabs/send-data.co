<div class="text-center my-5">
	<h4 class="mt-4 mb-4 text-grey"><b>$Name</b></h4>
	<div>
		<ul class="inline-list center">
			<% loop $ImageItems %>
				<li><img src="$Image.Link" width="130"></li>
			<% end_loop %>
		</ul>
	</div>
</div>