<div class="container">
	<div class="form-container controlled center">
		<?php
			$login_url = PRODSITE.'login/';
		?>
		<form action="<?php echo $login_url;?>" method="post" id="login-form" class="form-body pb-3">
			<div class="form-header text-center mb-3">
				<h5 class="zero-gaps">LOGIN</h5>
			</div>
			<div class="form-group mb-0 mx-3">
				<label for="email-name">Email address</label>
				<input type="email" name="email" id="email-name" class="form-control" placeholder="juancruz@softwarcompanyph.com" required="required"/>
			</div>
			<div class="form-group my-3 mx-3">
				<label for="pw-name">Password</label>
				<input type="password" name="password" id="pw-name" class="form-control" required="required"/>
			</div>
			<div class="mx-3">
				<button class="btn btn-block btn-lg btn-success">Login</button>
			</div>
		</form>
		<!-- <div class="row mt-3 mx-3"> 
			<a href="#">Reset Password</a>
		</div> -->
	</div>
</div>