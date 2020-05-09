
<!-- Footer -->
<section id="footer">
	<div class="container">
		<div class="row">
			<div class="col-8 col-12-medium">
				<section>
					<header>
						<h2>Most Recent Blogs</h2>
					</header>
					<ul class="dates">
						<% loop $BlogPosts %>
							<li>
								<span class="date">$PublishDate.Format(MMM) <strong>$PublishDate.Format(dd)</strong></span>
								<h3><a href="$Link"><% if $MenuTitle %>$MenuTitle<% else %>$Title<% end_if %></a></h3>
								<% if $Summary %>
									$Summary
								<% else %>
									<p>$Excerpt</p>
								<% end_if %>
							</li>
						<% end_loop %>
					</ul>
				</section>
			</div>
			<div class="col-4 col-12-medium">
				<section>
					<header>
						<h2>$SiteConfig.Title</h2>
						<p>$SiteConfig.Tagline</p>
					</header>
					$SiteConfig.FooterContactDetails
					<ul class="social">
						<% if $SiteConfig.FacebookLink %><li><a class="icon brands fa-facebook" target="_blank" href="$SiteConfig.FacebookLink"><span class="label">Facebook</span></a></li><% end_if %>
						<% if $SiteConfig.InstagramLink %><li><a class="icon brands fa-instagram" target="_blank" href="$SiteConfig.InstagramLink"><span class="label">Instagram</span></a></li><% end_if %>
						<% if $SiteConfig.TwittertLink %><li><a class="icon brands fa-twitter" target="_blank" href="$SiteConfig.TwittertLink"><span class="label">Twitter</span></a></li><% end_if %>
						<% if $SiteConfig.PinterestLink %><li><a class="icon brands fa-pinterest" target="_blank" href="$SiteConfig.PinterestLink"><span class="label">Pinterest</span></a></li><% end_if %>
						<% if $SiteConfig.YoutubeLink %><li><a class="icon brands fa-youtube" target="_blank" href="$SiteConfig.YoutubeLink"><span class="label">YouTube</span></a></li><% end_if %>
						<% if $SiteConfig.LinkedInLink %><li><a class="icon brands fa-linkedin-in" target="_blank" href="$SiteConfig.LinkedInLink"><span class="label">LinkedIn</span></a></li><% end_if %>
					</ul>
				</section>
			</div>
			<div class="col-12">
				<!-- Copyright -->
				<div id="copyright">
					<ul class="links">
						<% loop $Menu(1) %>
							<li><a href="$Link">$MenuTitle.XML</a></li>
						<% end_loop %>
						<li>&copy; {$SiteConfig.Title} · $Now.Year · All rights reserved</li><li>Design · <a href="https://html5up.net">HTML5 UP</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>