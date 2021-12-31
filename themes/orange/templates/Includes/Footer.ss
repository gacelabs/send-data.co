	<div class="page-load-overlay"><div class="page-loader"></div></div>
	<% if $CLassName != RegistrationPage %>
		<div class="container" id="register-panel">
			<hr>
			<% include RegisterCards %>
		</div>
	<% end_if %>
	<!-- Footer -->
	<footer class="page-footer font-small bg-dark">
		<!-- Footer Links -->
		<div class="container">
			<!-- Grid row-->
			<div class="row text-center d-flex justify-content-center pt-5 mb-3">
				<!-- Grid column -->
				<div class="col-md-2 mb-3">
					<h6 class="text-uppercase font-weight-bold">
						<a class="text-warning" href="/">Home</a>
					</h6>
				</div>
				<!-- Grid column -->
				<% loop $Menu(1) %>
					<!-- Grid column -->
					<div class="col-md-2 mb-3">
						<h6 class="text-uppercase font-weight-bold">
							<a class="text-warning" href="$Link">$MenuTitle</a>
						</h6>
					</div>
					<!-- Grid column -->
				<% end_loop %>
				<!-- Grid column -->
				<!-- <div class="col-md-2 mb-3">
					<h6 class="text-uppercase font-weight-bold">
						<a class="text-warning" target="_blank" href="//blog.send-data.co/help/">Help</a>
					</h6>
				</div> -->
				<!-- Grid column -->
			</div>
			<!-- Grid row-->
			<hr class="rgba-white-light" style="margin: 0 15%;">

			<!-- Grid row-->
			<div class="row d-flex text-center justify-content-center mb-md-0 mb-4">
				<!-- Grid column -->
				<div class="col-md-8 col-12 mt-5 text-white">
					<p style="line-height: 1.7rem">$SiteConfig.Tagline</p>
				</div>
				<!-- Grid column -->
			</div>
			<!-- Grid row-->
			<hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">

			<!-- Grid row-->
			<div class="row pb-3 text-center">
				<!-- Grid column -->
				<div class="col-md-12">
					<div class="mb-5 flex-center">
						<% if $SiteConfig.Facebook %>
							<!-- Facebook -->
							<a target="_blank" class="fb-ic" href="$SiteConfig.Facebook">
								<i class="fa fa-facebook fa-lg text-white mr-4"> </i>
							</a>
						<% end_if %>
						<% if $SiteConfig.Instagram %>
							<!--Instagram-->
							<a target="_blank" class="ins-ic" href="$SiteConfig.Instagram">
								<i class="fab fa-instagram fa-lg text-white mr-4"> </i>
							</a>
						<% end_if %>
						<% if $SiteConfig.Pinterest %>
							<!--Pinterest-->
							<a target="_blank" class="pin-ic" href="$SiteConfig.Pinterest">
								<i class="fab fa-pinterest fa-lg text-white mr-4"> </i>
							</a>
						<% end_if %>
						<% if $SiteConfig.Youtube %>
							<!--Youtube-->
							<a target="_blank" class="yt-ic" href="$SiteConfig.Youtube">
								<i class="fab fa-youtube-play fa-lg text-white"> </i>
							</a>
						<% end_if %>
					</div>
				</div>
				<!-- Grid column -->
			</div>
			<!-- Grid row-->
		</div>
		<!-- Footer Links -->

		<!-- Copyright -->
		<div class="footer-copyright text-center py-3 text-white">
			&copy; {$Now.Year}
			<a class="text-warning" href="/">Send-Data.co</a> 
		</div>
		<div class="footer-copyright text-center py-3 text-white">
			<a class="text-warning" href="$SiteConfig.Privacy.Link"> Privacy Policy </a> | 
			<a class="text-warning" href="$SiteConfig.Terms.Link"> Terms &amp; Conditions </a>
		</div>
		<!-- Copyright -->
	</footer>
	<!-- Footer -->
</body>
</html>