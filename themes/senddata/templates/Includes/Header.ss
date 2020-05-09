
<!-- Logo -->
<h1><a href="/">$SiteConfig.Title</a></h1>
<!-- Nav -->
<nav id="nav">
	<ul>
		<% loop $Menu(1) %>
			<li class="$LinkingMode">
				<a href="$Link">$MenuTitle.XML</a>
			</li>
		<% end_loop %>
		<%-- <li class="current"><a href="/">Home</a></li>
		<li>
			<a href="#">Dropdown</a>
			<ul>
				<li><a href="#">Lorem ipsum dolor</a></li>
				<li><a href="#">Magna phasellus</a></li>
				<li><a href="#">Etiam dolore nisl</a></li>
				<li>
					<a href="#">Phasellus consequat</a>
					<ul>
						<li><a href="#">Magna phasellus</a></li>
						<li><a href="#">Etiam dolore nisl</a></li>
						<li><a href="#">Veroeros feugiat</a></li>
						<li><a href="#">Nisl sed aliquam</a></li>
						<li><a href="#">Dolore adipiscing</a></li>
					</ul>
				</li>
				<li><a href="#">Veroeros feugiat</a></li>
			</ul>
		</li>
		<li><a href="left-sidebar.html">Left Sidebar</a></li>
		<li><a href="right-sidebar.html">Right Sidebar</a></li>
		<li><a href="no-sidebar.html">No Sidebar</a></li> --%>
	</ul>
</nav>

<% if $URLSegment.LowerCase == home %>
	$GetHomeComponentBlock('Component\Blocks\BannerBlock')
	$GetHomeComponentBlock('Component\Blocks\MembershipBlock')
<% end_if %>