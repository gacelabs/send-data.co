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
			<?php
				$promo_code = '';
				if (date('Y-m-d') != '2018-12-31') {
					if (isset($_GET['code']) AND $_GET['code'] == 'CustomedOFF') {
						$promo_code = '?promo_code=1';
					}
				}
				$register_url = 'http://local.api.datapushthru/register'.$promo_code;
				if (PROD == 1) {
					$register_url = 'http://api.datapushthru.com/register'.$promo_code;
				}
			?>
			<form action="<?php echo $register_url;?>" method="get" class="pt-3 px-3 form-body">
				<input type="text" name="projects[package_type]" class="d-none" value="<?php echo $activePage;?>" data-type="text" />
				<input type="text" name="projects[price]" class="d-none" value="<?php echo str_replace(',', '', $products[$activePage]['price']);?>" data-type="text" />
				<input type="text" name="projects[billed]" class="d-none" value="<?php echo $products[$activePage]['billed'];?>"/>
				<div class="form-group mb-0">
					<label for="org-name">Organization</label>
					<input type="text" name="accounts[company]" id="org-name" class="form-control" placeholder="Software Company Philippines" data-type="text" />
				</div>
				<div class="row mt-3">
					<div class="col-lg form-group mb-0">
						<label for="email-name">Email Address</label>
						<input type="email" name="accounts[email]" id="email-name" class="form-control" placeholder="juancruz@softwarecompanyph.com" data-type="email" />
					</div>
					<div class="col-lg form-group mb-0">
						<label for="admin-name">Admin Name</label>
						<input type="text" name="accounts[admin]" id="admin-name" class="form-control" placeholder="Juan Cruz" data-type="text" />
					</div>
				</div>
				<div class="form-group mt-3">
					<label for="url-name">Website URL / Domain name</label>
					<div class="input-group mb-3">
						<select class="custom-select col-lg-3 col-sm-3" id="url-protocol">
							<option value="https://">https://</option>
							<option value="http://">http://</option>
						</select>
						<input type="text" id="url-name" class="form-control" placeholder="Domain name must contain http or https" data-type="url" />
					</div>
					<input type="text" name="projects[origin]" id="url-origin" class="form-control d-none" />
					<input type="text" name="projects[domain]" id="url-domain" class="form-control d-none" />
				</div>
				<div class="row mt-3">
					<div class="col-lg form-group mb-0">
						<label for="pw-name">Password</label>
						<input type="password" name="accounts[password]" id="pw-name" class="form-control" placeholder="secured password" data-type="password" />
					</div>
					<div class="col-lg form-group mb-0">
						<label for="re-pw-name">Retype Password</label>
						<input type="password" id="re-pw-name" class="form-control" placeholder="check password" data-type="password" />
					</div>
				</div>
				<div class="row mt-3 mb-3">
					<div class="col-lg-4">
						<button type="submit" class="btn btn-lg btn-success">Register</button>
					</div>
					<div class="col-lg">
						<p class="mb-0">Add <b><?php echo $activePage; ?> Product</b> to an existing account? <a href="/?page=login">Login here</a></p>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
