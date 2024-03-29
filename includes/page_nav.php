<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand text-warning" href="/"><img alt="Logo" src="assets/images/icon.png" style="width: 50px; margin-right: 5px;">Send-Data</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<!-- <li class="nav-item <?php if ($activePage == 'home') {echo 'active';}; ?>">
					<a class="nav-link" href="/">Home</a>
				</li> -->
				<li class="nav-item">
					<a class="nav-link" href="/#register-panel">How to start?</a>
				</li>
				<li class="nav-item <?php if ($activePage == 'docs') {echo 'active';}; ?>">
					<a class="nav-link" href="?page=documentation">Documentation</a>
				</li>
				<!-- <li class="nav-item" title="Visit our facebook page">
					<a class="nav-link" href="https://www.facebook.com/send.data.co/" target="blank" onmouseenter="$(this).css('color', 'blue')" onmouseleave="$(this).removeAttr('style')">Facebook link</a>
				</li> -->
				<li class="nav-item">
					<a class="nav-link" href="?page=contact-us">Contact Us</a>
				</li>
				<li class="nav-item <?php if ($activePage == 'login') {echo 'active';}; ?>">
					<a class="nav-link" href="?page=login">Login</a>
				</li>
			</ul>
		</div>
	</div>
</nav>