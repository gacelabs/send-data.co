<% include Header %>
<div class="container">
	<div class="row justify-content-between my-4">
		<div class="col-lg-6 form-container">
			<div class="form-header text-center">
				<h5 class="zero-gaps">REGISTRATION</h5>
			</div>
			<form action="$AppSiteUrl(register)" method="get" class="pt-3 px-3 form-body form-validate" id="register-form">
				<input type="text" name="projects[package_type]" class="d-none" value="$PackageType.Name" data-type="text" />
				<input type="text" name="projects[price]" class="d-none<% if $PackageType.HasPriceTrack %> clientPriceVal<% end_if %>" value="$PackageType.Price" data-type="text" />
				<input type="text" name="projects[payload]" class="d-none<% if $PackageType.HasPriceTrack %> payloadLimitVal<% end_if %>" value="$PackageType.Payload"/>
				<input type="text" name="projects[billed]" class="d-none" value="$PackageType.Billed.Name"/>
				<div class="form-group mb-0">
					<label for="org-name">Organization</label>
					<input type="text" name="accounts[company]" id="org-name" class="form-control" placeholder="Software Company Philippines" required="required" data-type="text" />
				</div>
				<div class="row mt-3">
					<div class="col-lg form-group mb-0">
						<label for="email-name">Email Address</label>
						<input type="email" name="accounts[email]" id="email-name" class="form-control" placeholder="juandelacruz@softcompany.com" required="required" data-type="email" />
					</div>
					<div class="col-lg form-group mb-0">
						<label for="admin-name">Admin Name</label>
						<input type="text" name="accounts[admin]" id="admin-name" class="form-control" placeholder="Juan Dela Cruz" required="required" data-type="text" />
					</div>
				</div>
				<div class="form-group mt-3">
					<label for="url-name">Website URL / Domain name</label>
					<div class="input-group mb-3">
						<select class="custom-select col-4" id="url-protocol">
							<option value="https://">https://</option>
							<option value="http://">http://</option>
						</select>
						<input type="text" id="url-name" class="form-control" placeholder="Enter your domain name here" required="required" data-type="url" />
					</div>
					<input type="text" name="projects[origin]" id="url-origin" class="form-control d-none" />
					<input type="text" name="projects[domain]" id="url-domain" class="form-control d-none" />
				</div>
				<div class="row mt-3">
					<div class="col-lg form-group mb-0">
						<label for="pw-name">Password</label>
						<input type="password" name="accounts[password]" id="pw-name" class="form-control" placeholder="Secured password" required="required" data-type="password" />
					</div>
					<div class="col-lg form-group mb-0">
						<label for="re-pw-name">Retype Password</label>
						<input type="password" id="re-pw-name" class="form-control" placeholder="Check password" required="required" data-type="password" />
					</div>
				</div>
				<div class="row mt-3 mb-3">
					<div class="col-lg-4">
						<button type="submit" class="btn btn-lg btn-success">Register</button>
					</div>
					<div class="col-lg">
						<p class="mb-0">Add <b>{$PackageType.Name} Package</b> to an existing account? <a href="$LoginPage.Link">Login here</a></p>
					</div>
				</div>
			</form>
		</div>

		<div class="col-lg-6 form-container">
			<div class="mb-4 px-0">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title text-center"><b>$PackageType.Name</b></h3>
							<% if $PackageType.HasPriceTrack %>
								<div class="text-center">
									<span class="fa fa-info-circle text-primary"> Drag and slide to the right/left for flexible price</span>
								</div>
								<div class="range-field reg-page">
									<input type="text" class="p-0 calculatorSlider" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-handle="custom" style="width: 100%;">
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
							<% end_if %>
						<div class="mx-3">$PackageType.Description</div>
					</div>
					<div class="card-footer">
						<ul class="inline-list center">
							<li><p class="mb-0">Price (USD): <b class="clientPrice">$PackageType.Price</b></p></li>
							<li><p class="mb-0">Billed: <b>$PackageType.Billed.Name</b></p></li>
						</ul>
					</div>
				</div>
			</div>

			<% if $PackageTypes.Count %>
				<div class="row">
					<% loop $PackageTypes %>
						<div class="col-md-4 col-sm-4 my-2">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title text-center mb-0"><b>$Name</b></h5>
								</div>
								<div class="card-footer text-center">
									<a href="{$RegistrationPage.Link.removeString('?stage=Stage')}view/$ID/{$Name.NiceURL}" class="btn btn-primary">Select</a>
								</div>
							</div>
						</div>
					<% end_loop %>
				</div>
			<% end_if %>
		</div>
	</div>

	$HTMLBlocks
</div>
<% include Footer %>