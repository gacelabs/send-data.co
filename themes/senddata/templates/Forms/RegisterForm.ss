
<% if $Fields.Count > 1 %>
	<form $AttributesHTML>
		<div class="row">
			<div class="col-12">
				<% with $Fields.dataFieldByName(Accounts_company) %>
					<label for="$ID">Organization</label>
					<input $getAttributesHTML(class) data-type="text" />
				<% end_with %>
			</div>
			<div class="col-6 col-12-small">
				<% with $Fields.dataFieldByName(Accounts_email) %>
					<label for="$ID">Email</label>
					<input $getAttributesHTML(class) data-type="email" />
				<% end_with %>
			</div>
			<div class="col-6 col-12-small">
				<% with $Fields.dataFieldByName(Accounts_admin) %>
					<label for="$ID">Admin Name</label>
					<input $getAttributesHTML(class) data-type="text" />
				<% end_with %>
			</div>
			<div class="col-12">
				<label for="$Fields.dataFieldByName(WebsiteURL).id">Website URL / Domain name</label>
				<div class="input-group">
					$Fields.dataFieldByName(Protocol)
					$Fields.dataFieldByName(WebsiteURL).setAttribute('data-type', 'url')
				</div>
			</div>
			<div class="col-6 col-12-small">
				<% with $Fields.dataFieldByName(Accounts_password) %>
					<label for="$ID">Password</label>
					<input $getAttributesHTML(class) data-type="password" />
				<% end_with %>
			</div>
			<div class="col-6 col-12-small">
				<% with $Fields.dataFieldByName(RePassword) %>
					<label for="$ID">Retype Password</label>
					<input $getAttributesHTML(class) data-type="password" />
				<% end_with %>
			</div>
			<div class="col-12">
				<ul class="actions text-center">
					<div class="g-recaptcha" data-sitekey="$SiteConfig.reCaptchaAPiKey" data-size="invisible"></div>
					<% loop $Actions %>
						<li><input $getAttributesHTML(class) class="btn btn-lg btn-success" /></li>
					<% end_loop %>
				</ul>
			</div>
		</div>
		$HiddenFields
	</form>
<% end_if %>
