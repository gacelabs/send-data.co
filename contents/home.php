<header class="business-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mt-4">
				<div class="col-lg-12">
					<h2 class="text-white mt-4">Push data across your app</h2>
					<h3 class="text-white">Fast. Secured. Affordable.</h3>
					<div class="mt-4">
						<p class="text-white">We made the API simple and easy to implement, <br/>you're good to go before you know it.</p>
						<a href="?page=documentation" class="btn btn-warning">Documentation</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="row text-center">
	<div class="col-lg-12 my-4">
		<h4 class="mt-4 text-grey"><b>Projects that our customers built<br/>with DataPushThru</b></h4>
	</div>
	<?php foreach ($projects as $project => $rows) { ?>
	<div class="col-3">
		<h1><span class="<?php echo $rows['icon']; ?>"></span></h1>
		<p class="text-all-caps text-warning"><b><?php echo $project; ?></b></p>
	</div>
	<?php } ?>
</div>

<div class="row mt-4">
	<?php foreach($products as $product => $rows) { ?>
	<div class="col-sm-12 col-lg-4 my-4">
		<div class="card">
			<div class="card-body">
				<div>
					<h4 class="card-title text-center"><b><?php echo $product; ?></b></h4>
					<?php foreach($rows['desc'] as $val) { ?>
						<div class="col-lg-12">
							<p class="card-text"><h1 class="fa fa-check icon-left text-warning"></h1><?php echo $val; ?></p>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="card-footer text-center">
				<a href="?page=<?php echo $rows['reg-link'] ?>" class="btn btn-primary">Register</a>
			</div>
		</div>
	</div>
	<?php } ?>
</div>