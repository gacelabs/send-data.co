<div class="container">
	<header class="business-header" style="background: url('<% if $BackgroundImage %>$BackgroundImage.Link<% else %>assets/images/header-bg3.jpg<% end_if %>') center center no-repeat scroll; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover;">
		<div class="px-5 pt-5 d-lg-none">
			$Introduction
			<div class="mt-4">
				<p class="text-white"><strong>LET'S GET STARTED!</strong>
					<a href="#register-panel" class="btn btn-lg btn-success" style="vertical-align: baseline;">REGISTER HERE</a>
				</p>
			</div>
		</div>
		<div class="d-none d-lg-block">
			<div class="px-5 pt-5 pull-right">
				$Introduction
			</div>
			<div class="px-5 pt-5 pull-left" style="top: 80px;">
				<a href="#register-panel" class="btn btn-lg btn-success" style="vertical-align: baseline;">LET'S GET STARTED!</a>
			</div>
		</div>
	</header>

	$HTMLBlocks
</div>