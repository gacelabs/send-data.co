<% if $PackageTypes.Count %>
	<div class="my-4 text-center">
		<h4 class="text-grey"><b>Get Started with these Packages</b></h4>
	</div>
	<div class="row">
		<% loop $PackageTypes %>
			<div class="col-lg col-md mt-2 mb-5">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title text-center"><b>$Name</b></h4>
						<% if $HasPriceTrack %>
							<div class="text-center">
								<span class="fa fa-info-circle text-primary"> Drag and slide to the right/left for flexible price</span>
							</div>
							<div class="range-field">
								<input type="text" class="no-border col-lg-12 p-0 calculatorSlider" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" data-slider-handle="custom" style="width: 100%;">
							</div>
							<!-- Grid row -->
							<div class="row mb-3">
								<!-- Grid column -->
								<div class="col-md-6 col-6 text-center">
									Messages
									<div class="col-lg">
										<strong class="payloadLimit">$Payload</strong>
									</div>
								</div>
								<div class="col-md-6 col-6 text-center">
									Price
									<div class="col-lg">
										<b>USD </b><strong class="clientPrice">$Price</strong>
									</div>
								</div>
								<!-- Grid column -->
							</div>
						<% end_if %>
						$Description
					</div>
					<div class="card-footer text-center">
						<a href="{$RegistrationPage.Link.removeString('?stage=Stage')}view/$ID/{$Name.NiceURL}" class="btn btn-primary">Register</a>
					</div>
				</div>
			</div>
		<% end_loop %>
	</div>
<% end_if %>