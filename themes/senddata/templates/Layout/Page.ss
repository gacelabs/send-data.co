
<%-- $Content
$Form
$CommentsForm --%>
<% if $URLSegment.LowerCase != home %>
	$GetComponentBlocks
<% else %>
	$GetHomeComponentBlock('Component\Blocks\ProjectBuildsBlock')
<% end_if %>