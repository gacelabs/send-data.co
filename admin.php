<?php

	include('admin/includes/admin_head.php');

?>
<body class="hold-transition skin-black sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<a href="/admin.php" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>DPT</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>DataPushThru</b></span>
			</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
			</nav>
		</header>

		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel text-white text-center">
					<p class="zero-gaps">Admin Name</p>
				</div>
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">PROJECTS</li>
					<?php foreach($projects as $project => $rows) { ?>
					<li class="treeview" target-dash="<?php echo $project; ?>">
						<a href="#"><i class="fa fa-globe"></i> <span><?php echo $project; ?></span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<?php foreach($rows as $row => $val) { ?>
							<li><a href="#"><i class="<?php echo $val['icon'] ?>"></i> <span><?php echo $val['label']; ?></span></a></li>
							<?php } ?>
						</ul>
					</li>
					<?php } ?>
				</ul>
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">INFORMATION</li>
					<?php foreach($information as $info => $rows) { ?>
					<li><a href="?page=<?php echo $rows['link']; ?>"><i class="<?php echo $rows['icon']; ?>"></i> <span><?php echo $rows['label']; ?></span></a></li>
					<?php } ?>
				</ul>
			</section>
		</aside>

		<div class="content-wrapper">

			<div id="">
				<section class="content-header">
					<h1 id="dashDomain">domaingoeshere <small>Package Subscription</small></h1>
				</section>

				<section class="content container-fluid">
					<!------------------------
					| Your Page Content Here |
					-------------------------->
				</section>
			</div>
		</div>

		<footer class="main-footer">
			<strong><a href="#">DataPushThru</a>&copy; <span class="yearNow"></span>
		</footer>

	</div>

	<script src="admin/assets/js/jquery.min.js"></script>
	<script src="admin/assets/js/bootstrap.min.js"></script>
	<script src="admin/assets/js/adminlte.min.js"></script>
	<script src="admin/assets/js/main.js"></script>
</body>
</html>