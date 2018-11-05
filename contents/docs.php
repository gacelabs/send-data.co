<div class="container">
	<div class="row">
		<div class="col-md-2 col-sm-12">
			<p class="mt-4 mb-0 bold-caps">JavaScript</p>
			<ul class="no-style-ul">
				<li>Declare</li>
				<li>Initialize</li>
				<li>Subscribe</li>
				<li>Binding</li>
				<li>Transmitting</li>
			</ul>
			<p class="mt-4 mb-0 bold-caps">PHP</p>
			<ul class="no-style-ul">
				<li>Initialize</li>
				<li>Transmitting</li>
			</ul>
		</div>
		<div class="col-md-10 col-sm-12">
			<div class="mt-3">
				<h3>JavaScript Documentation <span class="fa fa-caret-down toggle-show-hide" target-id="js-docs"></span></h3>
				<div class="mt-4" id="js-docs">
					<div>
						<p class="mb-0"><b>1. Declaring the JavaScript and getting your backend php file library for your website.</b></p>
						<ul class="no-style-ul">
							<li>Login to <b><a href="/?page=login" target="_blank">http://www.datapushthru.com/?page=login</a></b></li>
							<li>Navigate to <b><a href="http://api.datapushthru.com/admin/profile" target="_blank">http://api.datapushthru.com/admin/profile</a></b> and click the<img src="/assets/images/appfilestab.png">tab. Then click the generate button for the desired project.</li>
							<li>Your php file library (for backend transmitting) and javascript tag will be generated.</li>
							<li class="my-3"></li>
							<li>a. In the script panel, copy the script tag and patse it at the bottom before the <kbd>&lt;/body&gt;</kbd> tag.</li>
							<li>b. Once your page has been loaded, the DataPushthru object class and dependencies will then be loaded.</li>
							<li>c. It is essential that you save these files in your project in order to call the class anywhere.</li>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>2. Initializing the Pushthru object class.</b></p>
						<ul class="no-style-ul">
							<li>Place before the <kbd>&lt;/body&gt;</kbd> tag to call the Pushthru object class</li>
							<li class="my-2">
								<p class="mb-2">Example:</p>
								<pre><code>	&lt;script type="text/javascript" src="/your/other/js/files.js">&lt;/script&gt;<br/>	<b>&lt;script type="text/javascript" id="push-thru-scripts" src="http://api.datapushthru.com/get/jsfile/YOUR_APP_KEY">&lt;/script&gt;</b><br>&lt;/body&gt;<br>&lt;/html&gt;</code></pre>
							</li>
							<li>
								<p class="mb-2">Then initialize the object class and pass your <kbd>API key</kbd> as a parameter, just like so:</p>
								<pre><code><b>var pushthru = new Pushthru(<i class="text-warning">YOUR_APP_KEY</i>);</b></code></pre>
							</li>
							<li class="alert alert-success" role="alert"><span class="small"><b>NOTE:</b> <strong><pre><code>pushthru.stashes.options.autoRunStash;</code></pre></strong>Is set to <kbd>false</kbd> by default. This option will automatically run the recent triggered events when set to <kbd>true</kbd>. This is helpfull when internet connection is suddenly unreachable.</span></li>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>3. Subscribing channels for connection.</b></p>
						<ul class="no-style-ul">
							<li>There are two ways to declare a subscribe method.</li>
							<li class="mt-2"><pre class="mb-2"><code><b>a.</b> pushthru.subscribe('name_of_channel');</code></pre></li>
							<ul class="no-style-ul">
								<li class="mt-0 mb-2">In this method, you initially subscribe the <kbd>'name_of_channel'</kbd> for a connection</li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string value of your channel name</span></code></pre></li>
							</ul>
						</ul>
						<ul class="no-style-ul mt-4">
							<li>And here's the other way</li>
							<li class="mt-2"><pre class="mb-2"><code><b>b.</b> pushthru.bind('name_of_the_event', 'name_of_channel', function(data) {
	console.log(data.user_id);
	console.log(data.message);
	// this will output the values of the object transmitted to this channel connection with the event specify
});</code></pre></li>
							<ul class="no-style-ul">
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_the_event'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string value of your event name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string value of your channel name</span></code></pre></li>
							</ul>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>4. Binding an event to a channel connection.</b></p>
						<ul class="no-style-ul">
							<li>There are also two ways to declare an event to a channel connection.</li>
								<li class="mt-2"><pre class="mb-2"><code><b>a.</b> var channel = pushthru.subscribe('name_of_channel');</code></pre></li>
							<ul class="no-style-ul">
								<li class="alert alert-warning" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string value of your channel name</span></code></pre></li>
							</ul>
							<li class="mt-4"><pre class="mb-2"><code>channel.listen('name_of_the_event', function(data) {
	console.log(data.user_id);
	console.log(data.message);
	// this will output the values of the object transmitted to this channel connection with the event specify
});</code></pre></li>
							<ul class="no-style-ul">
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_the_event'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string value of your event name</span><br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a fixed object for event binding of pushthru class</span></code></pre></li>
								<li class="alert alert-success" role="alert"><span class="small"><b>NOTE:</b> You cant only call the <kbd>listen</kbd> function on the last subscribed channel</span></li>
							</ul>
							<li><kbd><b>b.</b></kbd> Or same as letter (b) in the step for Subscribing channels for connection.</li>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>5. Transmitting your data to a channel connection.</b></p>
						<ul class="no-style-ul">
							<li>Finally this show you how to transmit the data to another user subscribed to a channel connection.</li>
							<li class="mt-2"><pre class="mb-2"><code><b>a.</b> pushthru.trigger('name_of_the_event', 'name_of_channel', data_to_transmit_or_push);</code></pre></li>
							<ul class="no-style-ul mb-4">
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_the_event'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string value of your event name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string value of your channel name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'data_to_transmit_or_push'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string or object value to transmit</span></code></pre></li>
							</ul>
							<li class="mb-2">Data types of <kbd><b>data_to_transmit_or_push</b></kbd> parameter</li>
							<li class="mb-2"><pre class="mb-0"><code><b>string</b><br/>pushthru.trigger('name_of_the_event', 'name_of_channel', 'Hello world!');</code></pre></li>
							<li><pre><code><b>object</b><br/>pushthru.trigger('name_of_the_event', 'name_of_channel', {
	user_id: 1,
	message: "Hello world!"
});</code></pre></li>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>6. Catching the transmitted data.</b></p>
						<ul class="no-style-ul">
							<li>This will show you how to handle the transmitted data.</li>
							<li class="mt-2"><pre class="mb-2"><code><b>a.</b> pushthru.bind('name_of_the_event', 'name_of_channel', function(data) {
	console.log(data.user_id);
	console.log(data.message);
	// this will output the values of the object transmitted to this channel connection with the event specify
});</code></pre></li>
							<ul class="no-style-ul mb-4">
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_the_event'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string value of your event name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a string value of your channel name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'callback'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a fixed object for event binding of pushthru class</span></code></pre></li>
							</ul>
						</ul>
					</div>
				</div>
			</div>

			<div class="mt-5">
				<h3>PHP Documentation</h3>
				<div class="mt-4">
					<div>
						<p class="mb-0"><b>1. Initializing the Pushthru object class in the backend.</b></p>
						<ul class="no-style-ul">
							<li>Copy and patse this php file to desired folder in your website application path.</li>
							<li>This is class library for backend implementation, there are ways of initializing this class base on your framework style on initializing it.</li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>CodeIgniter</b></h5><br/>$this->load->library('pushthru', array('app_key'=><i><kbd>YOUR_APP_KEY</kbd></i>));</code></pre></li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>Native PHP</b></h5><br/>require('path/to/the/PushThru.php');<br/><br/>$PushThruClass = new PushThru;<br/>$pushthru = $PushThruClass->initialize('<i><kbd>YOUR_APP_KEY</kbd></i>');</code></pre></li>
							<li>or this</li>
							<li class="mt-2"><pre class="mb-2"><code>$pushthru = new PushThru('<i><kbd>YOUR_APP_KEY</kbd></i>');</code></pre></li>
						</ul>		
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>2. Transmitting data on the subscribed channel and event in the frontend</b></p>
						<ul class="no-style-ul">
							<li>Transmitting data from backend. You must already subscribed and added the event on a channel (please see JavaScript Documentation steps 3 and 4).</li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>CodeIgniter</b></h5><br/>$this->load->library('pushthru', array('app_key'=><i><kbd>YOUR_APP_KEY</kbd></i>));<br/>$PushThruObject = $this->pushthru;<br/><br/>$PushThruObject->trigger('name_of_the_event', 'name_of_channel', data_to_transmit_or_push);</code></pre></li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>Native PHP</b></h5><br/>require('path/to/the/PushThru.php');<br/><br/>$PushThruClass = new PushThru;<br/>$pushthru = $PushThruClass->initialize('<i><kbd>YOUR_APP_KEY</kbd></i>');</code></pre></li>
							<li>or this</li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>Native PHP</b></h5><br/>$pushthru = new PushThru('<i><kbd>YOUR_APP_KEY</kbd></i>');<br/><br/>$pushthru->trigger('name_of_the_event', 'name_of_channel', data_to_transmit_or_push);</code></pre></li>
						</ul>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>