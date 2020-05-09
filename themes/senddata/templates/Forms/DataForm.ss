<form $AttributesHTML>
	<div class="row">
		<% loop $selectedFields %>
			<% if $FormField.Type != Hidden %>
				<% if $FormField.TwoColumnedRow %>
				<div class="col-6 col-12-small">
				<% else %>
				<div class="col-12">
				<% end_if %>
					<% if $FormField.Type != ListBox && $FormField.Type != Textarea && $FormField.Type != Dropdown %>
						<% with $Top.Fields.dataFieldByName($FormField.Name) %>
							<input $getAttributesHTML(class)/>
						<% end_with %>
					<% else_if $FormField.Type == Textarea %>
						<% with $Top.Fields.dataFieldByName($FormField.Name) %>
							<textarea $getAttributesHTML(class)></textarea>
						<% end_with %>
					<% else %>
						$Top.Fields.dataFieldByName($FormField.Name)
					<% end_if %>
				</div>
			<% end_if %>
		<% end_loop %>
		<div class="col-12">
			<ul class="actions text-center">
				<div class="g-recaptcha" data-sitekey="$SiteConfig.reCaptchaAPiKey" data-size="invisible"></div>
				<% loop $Actions %>
					<li><input $getAttributesHTML(class)/></li>
				<% end_loop %>
			</ul>
		</div>
	</div>
	$HiddenFields
</form>