<%-- <% require css('silverstripe/blog: client/dist/styles/main.css') %> --%>
<div class="container main-content-area" style="height: auto !important;">
	<div class="row side-pull-left" style="height: auto !important;">

	</div>
</div>

	<article>
		<h1>
			<% if $ArchiveYear %>
				<%t SilverStripe\\Blog\\Model\\Blog.Archive 'Archive' %>:
				<% if $ArchiveDay %>
					$ArchiveDate.Nice
				<% else_if $ArchiveMonth %>
					$ArchiveDate.format('MMMM, y')
				<% else %>
					$ArchiveDate.format('y')
				<% end_if %>
			<% else_if $CurrentTag %>
				<%t SilverStripe\\Blog\\Model\\Blog.Tag 'Tag' %>: $CurrentTag.Title
			<% else_if $CurrentCategory %>
				<%t SilverStripe\\Blog\\Model\\Blog.Category 'Category' %>: $CurrentCategory.Title
			<% else %>
				$Title
			<% end_if %>
		</h1>

		<div class="content">$Content</div>

		<% if $PaginatedList.Exists %>
			<% loop $PaginatedList %>
				<% include SilverStripe\\Blog\\PostSummary %>
			<% end_loop %>
		<% else %>
			<p><%t SilverStripe\\Blog\\Model\\Blog.NoPosts 'There are no posts' %></p>
		<% end_if %>
	</article>

	$Form
	$CommentsForm

	<% with $PaginatedList %>
		<% include SilverStripe\\Blog\\Pagination %>
	<% end_with %>

<% include SilverStripe\\Blog\\BlogSideBar %>
