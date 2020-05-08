
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<%-- <a class="navbar-brand text-warning" href="/">$SiteConfig.Title</a> --%>
		<h3 class="display-5"><a class="text-warning" href="/">$SiteConfig.Title</a><span class="text-white">::</span></h3>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<% loop $Menu(1) %>
					<li class="nav-item $LinkingMode">
						<a href="$Link" class="nav-link" title="$Title.XML">$MenuTitle.XML</a>
					</li>
				<% end_loop %>
				<%-- <li class="nav-item active">
					<a class="nav-link" href="/">Home</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="?page=documentation">Docs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mailto:gacelabs.inc@gmail.com?subject=Enquiry&amp;body=Full%20name%3A%20%0D%0AEmail%3A%20%0D%0AMessage%3A%20%0D%0A%0D%0A%0D%0A%0D%0A">Contact us</a>
				</li>
				<li class="nav-item" title="Visit our facebook page">
					<a class="nav-link" href="https://www.facebook.com/datapushthru/" target="blank" onmouseenter="$(this).css('color', 'blue')" onmouseleave="$(this).removeAttr('style')"><i class="fa fa-facebook"></i>b</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="?page=login">Login</a>
				</li> --%>
			</ul>
		</div>
	</div>
</nav>