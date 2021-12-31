
<form class="form-body pb-3 form-validate" $AttributesHTML>
	<div class="form-header text-center mb-3">
		<h5 class="zero-gaps">SIGN IN</h5>
	</div>
	<div class="form-group mb-2 mx-3">
		<label for="email-name">Email address</label>
		$Fields.dataFieldByName(Email).addExtraClass(form-control)
	</div>
	<div class="form-group my-0 mx-3">
		<label for="pw-name">Password</label>
		$Fields.dataFieldByName(Password).addExtraClass(form-control)
	</div>
	<%-- <div class="row mt-0 mb-3 mx-3"> 
		<a href="#">Reset Password</a>
	</div> --%>
	<div class="mt-3 mx-3">
		<button class="btn btn-block btn-lg btn-success">Login</button>
	</div>
	$HiddenFields
</form>