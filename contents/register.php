<div class="container">
	<div class="row justify-content-between my-4">
		<div class="col-md-5 col-sm-12 col-xs-12 px-0 product-container">
			<div class="mb-4 px-0">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title text-center"><b><?php echo $activePage; ?></b></h3>
						<div class="mx-3">
							<?php foreach($products[$activePage]['desc'] as $desc) { ?>
							<p class="card-text"><h1 class="fa fa-check icon-left text-warning"></h1><?php echo $desc; ?></p>
							<?php } ?>
						</div>
					</div>
					<div class="card-footer">
						<ul class="inline-list center">
							<li><p class="mb-0">Price (Php): <b><?php echo $products[$activePage]['price']; ?></b></p></li>
							<li><p class="mb-0">Billed: <b><?php echo $products[$activePage]['billed']; ?></b></p></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<?php foreach($products as $product => $rows) { ?>
				<div class="col-md-4 col-sm-4 my-2">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-center mb-0"><b><?php echo $product; ?></b></h5>
						</div>
						<div class="card-footer text-center">
							<a href="?page=<?php echo $rows['reg-link'] ?>" class="btn btn-primary">Select</a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>

		<div class="col-md-5 col-sm-12 col-xs-12 form-container">
			<div class="form-header text-center">
				<h5 class="zero-gaps">REGISTRATION</h5>
			</div>
			<form action="" method="" class="pt-3 px-3 form-body">
				<input type="text" name="prod-name" class="d-none" value="<?php echo $activePage?>"/>
				<input type="text" name="price-name" class="d-none" value="<?php echo $products[$activePage]['price']?>"/>
				<input type="text" name="price-name" class="d-none" value="<?php echo $products[$activePage]['billed']?>"/>
				<div class="form-group mb-0">
					<label for="org-name">Organization</label>
					<input type="text" name="org-name" id="org-name" class="form-control" placeholder="Software Company Philippines" required/>
				</div>
				<div class="row mt-3">
					<div class="col-lg form-group mb-0">
						<label for="email-name">Email Address</label>
						<input type="email" name="email-name" id="email-name" class="form-control" placeholder="juancruz@softwarecompanyph.com" required/>
					</div>
					<div class="col-lg form-group mb-0">
						<label for="admin-name">Admin Name</label>
						<input type="text" name="admin-name" id="admin-name" class="form-control" placeholder="Juan Cruz" required/>
					</div>
				</div>
				<div class="form-group mt-3">
					<label for="url-name">Website Domain</label>
					<input type="url" name="url-name" id="url-name" class="form-control" placeholder="www.website.com" required/>
				</div>
				<div class="row mt-3">
					<div class="col-lg form-group mb-0">
						<label for="pw-name">Password</label>
						<input type="password" name="pw-name" id="pw-name" class="form-control" required/>
					</div>
					<div class="col-lg form-group mb-0">
						<label for="re-pw-name">Retype Password</label>
						<input type="password" name="re-pw-name" id="re-pw-name" class="form-control" required/>
					</div>
				</div>
				<div class="row mt-3 mb-3">
					<div class="col-lg-4">
						<button type="submit" class="btn btn-lg btn-success">Register</button>
					</div>
					<div class="col-lg">
						<p class="mb-0">Add <b><?php echo $activePage; ?> Product</b> to an existing account? <a href="#">Login here</a></p>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
