<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>$Greetings</title>
	</head>
	<body>
		<div style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; line-height: 25px; width: 900px; margin: auto;">
			<% if $NoRecipients %>
			<p style="color: red;">DEV INFO: $NoRecipients</p>
			<% end_if %>
			<p>$Greetings</p>
			<% loop $Submission.RecipientEmailFields %>
			<div><strong>$label:</strong> $value</div>
			<% end_loop %>
		</div>
	</body>
</html>