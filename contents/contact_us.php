<div class="container">
	<div class="row">
		<div class="form-container controlled center" style="width: auto;">
			<div class="form-header text-center">
				<h5 class="zero-gaps">CONTACT US</h5>
			</div>
			<?php
				$contact_us_url = PRODSITE.'contact-us';
			?>
			<form action="<?php echo $contact_us_url;?>" method="get" class="pt-3 px-3 form-body">
				<div class="form-group mb-0">
					<label for="org-name">Message</label>
					<textarea name="email_body_message" required="required" class="form-control" placeholder="Can you tell us something what you need or want?"></textarea>
				</div>
				<div class="row mt-3">
					<div class="col-lg form-group mb-0">
						<label for="email-name">Email Address</label>
						<input type="email" name="email_from" id="email-name" class="form-control" placeholder="juancruz@softwarecompanyph.com" required="required" data-type="email" />
					</div>
					<div class="col-lg form-group mb-0">
						<label for="admin-name">Name</label>
						<input type="text" name="email_from_name" id="name" class="form-control" placeholder="Juan Cruz" required="required" data-type="text" />
					</div>
				</div>
				<div class="row mt-3 mb-3">
					<div class="col-lg-12 text-center">
						<button type="submit" class="btn btn-lg btn-success">Send message</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
