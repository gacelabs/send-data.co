
<% if $Fields.Count > 1 %>
	<form $AttributesHTML class="pt-3 px-3 form-body">
		<%-- <input type="text" name="projects[package_type]" class="d-none" value="Business" value="test" data-type="text">
		<input type="text" name="projects[price]" class="d-none clientPriceVal" value="145" value="test" data-type="text">
		<input type="text" name="projects[billed]" class="d-none" value="Monthly">
		<input type="text" name="projects[payload]" class="d-none payloadLimitVal" value="50000"> --%>
		<div class="form-group mb-0">
			<label for="$Fields.dataFieldByName(Organization).id">Organization</label>
			$Fields.dataFieldByName(Organization).setAttribute('data-type', 'text')
		</div>
		<div class="row mt-3">
			<div class="col-lg form-group mb-0">
				<label for="$Fields.dataFieldByName(Email).id">Email</label>
				$Fields.dataFieldByName(Email).setAttribute('data-type', 'email')
			</div>
			<div class="col-lg form-group mb-0">
				<label for="$Fields.dataFieldByName(AdminName).id">Admin Name</label>
				$Fields.dataFieldByName(AdminName).setAttribute('data-type', 'text')
			</div>
		</div>
		<div class="form-group mt-3">
			<label for="$Fields.dataFieldByName(WebsiteURL).id">Website URL / Domain name</label>
			<div class="input-group mb-3">
				$Fields.dataFieldByName(Protocol)
				$Fields.dataFieldByName(WebsiteURL).setAttribute('data-type', 'url')
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg form-group mb-0">
				<label for="$Fields.dataFieldByName(Password).id">Password</label>
				$Fields.dataFieldByName(Password).setAttribute('data-type', 'password')
			</div>
			<div class="col-lg form-group mb-0">
				<label for="$Fields.dataFieldByName(RePassword).id">Retype Password</label>
				$Fields.dataFieldByName(RePassword).setAttribute('data-type', 'password')
			</div>
		</div>
		<div class="row mt-3 mb-3">
			<div class="col-lg-4">
				<% loop $Actions %>
					<input $getAttributesHTML(class) class="btn btn-lg btn-success">
				<% end_loop %>
			</div>
			<div class="col-lg">
				<p class="mb-0">Add <b>Business Product</b> to an existing account? <a href="/?page=login">Login here</a></p>
			</div>
		</div>
		$HiddenFields
	</form>
<% end_if %>