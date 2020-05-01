<div class="container">
	<header class="business-header">
		<!-- <div class="px-5 pt-5">
			<h2 class="text-white">Push data across your app</h2>
			<h3 class="text-white">Fast. Secured. Affordable.</h3>
			<div class="mt-4">
				<p class="text-white">We made the API simple and easy to implement, <br/>you're good to go before you know it.</p>
				<a href="?page=documentation" class="btn btn-warning">Documentation</a>
			</div>
			<div class="mt-4">
				<p class="text-white"><strong>LET'S GET STARTED!</strong>
					<a href="#register-panel" class="btn btn-lg btn-success" style="vertical-align: baseline;">REGISTER HERE</a>
				</p>
			</div>
		</div> -->
		<div class="px-5 pt-5 pull-right">
			<h2 class="text-white">Push data across your app</h2>
			<h3 class="text-white">Fast. Secured. Affordable.</h3>
			<div class="mt-4">
				<p class="text-white">We made the API simple and easy to implement, <br/>you're good to go before you know it.</p>
				<a href="?page=documentation" class="btn btn-warning">Documentation</a>
			</div>
		</div>
		<div class="px-5 pt-5" style="top: 80px;">
			<a href="#register-panel" class="btn btn-lg btn-success" style="vertical-align: baseline;">LET'S GET STARTED!</a>
		</div>
	</header>

	<div class="skew-bg mb-5">
		<div class="skew-bg-child text-center">
			<div class="my-4">
				<h4 class="text-grey"><b>Projects that our customers built with Send-Data</b></h4>
			</div>
			<div class="row">
				<?php foreach ($projects as $project => $rows) { ?>
					<div class="col-lg col-md">
						<h1><span class="<?php echo $rows['icon']; ?>"></span></h1>
						<p class="text-all-caps text-warning"><b><?php echo $project; ?></b></p>
						<p class="text-grey"><?php echo $rows['desc']; ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row" id="register-panel">&nbsp;</div>
	</div>

	<div class="row">
		<?php foreach($products as $product => $rows) { ?>
			<div class="col-lg col-md mt-2 mb-5">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title text-center"><b><?php echo $product; ?></b></h4>
						<?php if ($product == 'Customed'): ?>
							<div class="range-field">
								<input type="text" id="calculatorSlider" class="no-border col-lg-12 p-0" data-slider-min="1" data-slider-max="15" data-slider-step="1" data-slider-value="1" data-slider-handle="custom" style="width: 100%;">
							</div>
							<!-- Grid row -->
							<div class="row mb-3">
								<!-- Grid column -->
								<div class="col-md-6 col-6 text-center">
									Payload
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

	<div class="text-center my-5">
		<h4 class="mt-4 mb-4 text-grey"><b>Technology like Send-Data is being used in</b></h4>
		<div>
			<ul class="inline-list center">
				<?php foreach($sampleSystems as $system) { ?>
				<li><img src="./assets/images/<?php echo $system; ?>" width="130"></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>