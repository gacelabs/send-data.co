
<div class="col-12">
	<!-- Blog -->
	<section>
		<%-- <header class="major">
			<h2>$MenuTitle</h2>
		</header> --%>
		<div class="row">
			<% if $PaginatedList.Exists %>
				<% loop $PaginatedList %>
					<% include SilverStripe\\Blog\\PostSummary %>
				<% end_loop %>
			<% else %>
				<p><%t SilverStripe\\Blog\\Model\\Blog.NoPosts 'There are no posts' %></p>
			<% end_if %>
		</div>
	</section>
</div>
