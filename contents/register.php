<div class="container">
	<div class="row justify-content-between my-4">
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
				$register_url = PRODSITE.'register'.$promo_code;
				$product = $products[$activePage];
			?>
			<form action="<?php echo $register_url;?>" method="get" class="pt-3 px-3 form-body" id="register-form">
				<input type="text" name="projects[package_type]" class="d-none" value="<?php echo $activePage;?>" data-type="text" />
				<input type="text" name="projects[price]" class="d-none<?php if ($activePage == 'Customed'): ?> clientPriceVal<?php endif ?>" value="<?php if ($activePage != 'Free'): ?><?php echo str_replace(',', '', $product['price']);?><?php else: ?>0.00<?php endif ?>" data-type="text" />
				<input type="text" name="projects[payload]" class="d-none<?php if ($activePage == 'Customed'): ?> payloadLimitVal<?php endif ?>" value="<?php echo $product['payload'];?>"/>
				<input type="text" name="projects[billed]" class="d-none" value="<?php echo $product['billed'];?>"/>
				<div class="form-group mb-0">
					<label for="org-name">Organization</label>
					<input type="text" name="accounts[company]" id="org-name" class="form-control" placeholder="Software Company Philippines" required="required" data-type="text" />
				</div>
				<div class="row mt-3">
					<div class="col-lg form-group mb-0">
						<label for="email-name">Email Address</label>
						<input type="email" name="accounts[email]" id="email-name" class="form-control" placeholder="juancruz@softwarecompanyph.com" required="required" data-type="email" />
					</div>
					<div class="col-lg form-group mb-0">
						<label for="admin-name">Admin Name</label>
						<input type="text" name="accounts[admin]" id="admin-name" class="form-control" placeholder="Juan Cruz" required="required" data-type="text" />
					</div>
				</div>
				<div class="form-group mt-3">
					<label for="url-name">Website URL / Domain name</label>
					<div class="input-group mb-3">
						<select class="custom-select col-4" id="url-protocol">
							<option value="https://">https://</option>
							<option value="http://">http://</option>
						</select>
						<input type="text" id="url-name" class="form-control" placeholder="Domain name must contain http or https" required="required" data-type="url" />
					</div>
					<input type="text" name="projects[origin]" id="url-origin" class="form-control d-none" />
					<input type="text" name="projects[domain]" id="url-domain" class="form-control d-none" />
				</div>
				<div class="row mt-3">
					<div class="col-lg form-group mb-0">
						<label for="pw-name">Password</label>
						<input type="password" name="accounts[password]" id="pw-name" class="form-control" placeholder="secured password" required="required" data-type="password" />
					</div>
					<div class="col-lg form-group mb-0">
						<label for="re-pw-name">Retype Password</label>
						<input type="password" id="re-pw-name" class="form-control" placeholder="check password" required="required" data-type="password" />
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

		<div class="col-md-5 col-sm-12 col-xs-12 px-0 product-container">
			<div class="mb-4 px-0">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title text-center"><b><?php echo $activePage; ?></b></h3>
						<?php if ($activePage == 'Customed'): ?>
							<div class="range-field">
								<input type="text" id="calculatorSlider" class="p-0" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-handle="custom" style="width: 100%;">
							</div>
							<!-- Grid row -->
							<div class="row mb-3">
								<!-- Grid column -->
								<div class="col-md-6 col-6 text-center">
									Messages
									<div class="col-lg">
										<strong class="payloadLimit">0</strong>
									</div>
								</div>
								<div class="col-md-6 col-6 text-center">
									Price
									<div class="col-lg">
										<b>USD </b><strong class="clientPrice">0</strong>
									</div>
								</div>
								<!-- Grid column -->
							</div>
							<!-- Grid row -->
						<?php endif ?>
						<div class="mx-3">
							<?php foreach($product['desc'] as $desc) { ?>
								<p class="card-text"><h1 class="fa fa-check icon-left text-warning"></h1><?php echo $desc; ?></p>
							<?php } ?>
						</div>
					</div>
					<div class="card-footer">
						<ul class="inline-list center">
							<li><p class="mb-0">Price (USD): <b<?php if ($activePage == 'Customed'): ?> class="clientPrice"<?php endif ?>><?php echo $product['price']; ?></b></p></li>
							<?php if ($activePage != 'Free'): ?>
								<li><p class="mb-0">Billed: <b><?php echo $product['billed']; ?></b></p></li>
							<?php endif ?>
						</ul>
					</div>
				</div>
			</div>
			<?php
				// echo "<pre>"; print_r($product);
			?>
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
	</div>
</div>
