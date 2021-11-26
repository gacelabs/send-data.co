<hr/>
<div class="row mt-4">
	<?php foreach($products as $product => $rows) { ?>
		<div class="col-lg col-md mt-2 mb-5">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title text-center"><b><?php echo $product; ?></b></h4>
					<?php if ($product == 'Customed'): ?>
						<div class="range-field">
							<input type="text" id="calculatorSlider" class="no-border col-lg-12 p-0" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" data-slider-handle="custom" style="width: 100%;">
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
					<?php foreach($rows['desc'] as $val) { ?>
						<div class="col-lg">
							<p class="card-text"><i class="fa fa-check icon-left text-warning"></i><?php echo $val; ?></p>
						</div>
					<?php } ?>
				</div>
				<div class="card-footer text-center">
					<a href="?page=<?php echo $rows['reg-link']?>" class="btn btn-primary">Register</a>
				</div>
			</div>
		</div>
	<?php } ?>
</div>