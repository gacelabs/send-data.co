<div class="container">
	<div class="row">
		<div class="col-md-2 col-sm-12">
			<p class="mt-4 mb-0 bold-caps">JavaScript</p>
			<ul class="no-style-ul">
				<li>Declare</li>
				<li>Initialize</li>
				<li>Binding</li>
				<li>Subscribe</li>
				<li>Transmitting</li>
				<li>Unbinding</li>
				<li>Unsubscribe</li>
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
							<li>Login to <b><a href="/?page=login" target="_blank">https://send-data.co/?page=login</a></b></li>
							<li>Navigate to <b><a href="<?php echo PRODSITE;?>admin/profile" target="_blank"><?php echo PRODSITE;?>admin/profile</a></b> and click the<img src="/assets/images/appfilestab.png">tab. Then click the generate button for the desired project.</li>
							<li>Your php file library (for backend transmitting) and javascript tag will be generated.</li>
							<li class="my-3"></li>
							<li>a. In the script panel, copy the script tag and patse it at the bottom before the <kbd>&lt;/body&gt;</kbd> tag.</li>
							<li>b. Once your page has been loaded, the SendData object class and dependencies will then be loaded.</li>
							<li>c. It is essential that you save these files in your project in order to call the class anywhere.</li>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>2. Initializing the Senddata object script.</b></p>
						<ul class="no-style-ul">
							<li>Place these codes before the <kbd>&lt;/body&gt;</kbd> tag to call the Senddata object class</li>
							<li>
								<p class="mb-2">Then initialize the object into <code>window.initSendData</code> function, just like so:</p>
							</li>
							<li class="my-2">
								<pre><code>	<b>&lt;script type="text/javascript"&gt;<br>		var realtime = false;		
		window.initSendData = function() {
			realtime = new Senddata({
				debug: false,
				autoConnect: false,
				autoRunStash: false,
				afterInit: function() {
				  "☝NOTE: Only call the function connect() if autoConnect option is set to false"
				  /*connection to server*/
				  realtime.connect(function() {
				    /*Todo here, after initialization*/
				  });
				},
				afterConnect: function() {
				  /*Todo here, after connection*/
				}
			});
		};
		(function(d, s, id) {
			var js, p = d.getElementsByTagName(s), me = p[p.length - 1];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.type = "text/javascript";
			js.src = "<?php echo PRODSITE;?>get/jsfile/<a href="/?page=customed-register">YOUR_APP_KEY</a>";
			me.parentNode.insertBefore(js, me);
		}(document, "script", "sd-sdk"));<br>	&lt;/script&gt;</b><br>&lt;/body&gt;<br>&lt;/html&gt;</code></pre>
							</li>
							<li class="alert alert-success" role="alert">
								<span class="small"><b>NOTE:</b> 
									<strong>
										<pre style="margin: 0; height: 60px; overflow: hidden;">
											<code>realtime.app.options.autoRunStash = false;
realtime.app.options.autoConnect = false;</code>
										</pre>
									</strong>
									<b>autoRunStash</b> and <b>autoConnect</b> are set to <kbd>false</kbd> by default.
									<br>- Set <b>autoConnect</b> to <kbd>true</kbd> to re-attach the connection.
									<br>- To run the recent triggered events set both options to <kbd>true</kbd>.
									<br><br>These are helpfull after an internet connection was suddenly unreachable.
								</span>
							</li>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>3. Binding events to channels for connection.</b></p>
						<ul class="no-style-ul">
							<li>There's one way for catching the transmitted data.</li>
							<li class="mt-2"><pre class="mb-2"><code>realtime.bind('name_of_the_event', 'name_of_channel', function(data) {
	console.log(data.user_id);
	console.log(data.message);
	// todo here ...
});</code></pre></li>
							<ul class="no-style-ul">
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_the_event'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your event name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your channel name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'function(data){}'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>callback function</i> with the <b><i>data</i></b> argument passed/transmitted</span></code></pre></li>
							</ul>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>4. Subscribing a channel connection for an event.</b></p>
						<ul class="no-style-ul">
							<li>One way to subscribe a channel for an event:</li>
								<li class="mt-2"><pre class="mb-2"><code>var channel = realtime.subscribe('name_of_channel');</code></pre></li>
							<ul class="no-style-ul">
								<li class="alert alert-warning" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your channel name</span></code></pre></li>
							</ul>
							<li class="mt-4"><pre class="mb-2"><code>channel.listen('name_of_the_event', function(data) {
	console.log(data.user_id);
	console.log(data.message);
	// todo here ...
});</code></pre></li>
							<ul class="no-style-ul">
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_the_event'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your event name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'function(data){}'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>callback function</i> with the <b><i>data</i></b> argument passed/transmitted</span></code></pre></li>
								<li class="alert alert-success" role="alert"><span class="small"><b>NOTE:</b> You can only call the <kbd>listen</kbd> function on the last subscribed channel</span></li>
							</ul>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>5. Transmitting your data to a channel connection.</b></p>
						<ul class="no-style-ul">
							<li>This show you how to transmit the data to another user subscribed to a channel connection.</li>
							<li class="mt-2"><pre class="mb-2"><code>realtime.trigger('name_of_the_event', 'name_of_channel', data_to_transmit_or_push);</code></pre></li>
							<ul class="no-style-ul mb-4">
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_the_event'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your event name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your channel name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'data_to_transmit_or_push'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> or <i>object</i> value to transmit</span></code></pre></li>
							</ul>
							<li class="mb-2">Data types of <kbd><b>data_to_transmit_or_push</b></kbd> parameter</li>
							<li class="mb-2"><pre class="mb-0"><code><b>string</b><br/>realtime.trigger('name_of_the_event', 'name_of_channel', 'Hello world!');</code></pre></li>
							<li><pre><code><b>object</b><br/>realtime.trigger('name_of_the_event', 'name_of_channel', {
	user_id: 1,
	message: "Hello world!"
});</code></pre></li>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>6. Unbinding to an event from a channel connection.</b></p>
						<ul class="no-style-ul">
							<li>This will show you how to unbind the event from a channel.</li>
							<li class="mt-2"><pre class="mb-2"><code>realtime.unbind('name_of_the_event', 'name_of_channel', function(data) {
	// todo here ...
});</code></pre></li>
							<ul class="no-style-ul mb-4">
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_the_event'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your event name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your channel name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'function(data){}'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>callback function</i> for handling other todos</span></code></pre></li>
							</ul>
						</ul>
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>7. Unsubscribe an event with the channel connection.</b></p>
						<ul class="no-style-ul">
							<li>This will show you how to unsubscribe an event with channel.</li>
							<li class="mt-2"><pre class="mb-2"><code>realtime.unsubscribe('name_of_the_event<strong>:</strong>name_of_channel');</code></pre></li>
							<ul class="no-style-ul mb-4">
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_the_event'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your event name</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">': (colon)'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">Must be in between of 'name_of_the_event' and 'name_of_channel'</span></code></pre></li>
								<li class="alert alert-warning mb-2" role="alert"><pre class="mb-0"><code class="nohighlight">'name_of_channel'<br/><span class="fa fa-info-circle text-grey"></span> <span class="small">The parameter is a <i>string</i> value of your channel name</span></code></pre></li>
								<li class="alert alert-success" role="alert"><span class="small"><b>NOTE: </b>The Parameter of the function <b>unsubscribe(<i>string</i>)</b> <kbd>must</kbd> be a string data type.</span></li>
							</ul>
						</ul>
					</div>
				</div>
			</div>

			<div class="mt-5">
				<h3>PHP Documentation</h3>
				<div class="mt-4">
					<div>
						<p class="mb-0"><b>1. Initializing the Senddata object class in the backend.</b></p>
						<ul class="no-style-ul">
							<li>Copy and patse this php file to desired folder in your website application path.</li>
							<li>This is class library for backend implementation, there are ways of initializing this class base on your framework style on initializing it.</li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>CodeIgniter</b></h5><br/>$this->load->library('senddata', array('app_key'=><i><kbd><a href="/?page=customed-register">YOUR_APP_KEY</a></kbd></i>));</code></pre></li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>Native PHP</b></h5><br/>require('path/to/the/SendData.php');<br/><br/>$SendDataClass = new SendData;<br/>$senddata = $SendDataClass->initialize('<i><kbd><a href="/?page=customed-register">YOUR_APP_KEY</a></kbd></i>');</code></pre></li>
							<li>or this</li>
							<li class="mt-2"><pre class="mb-2"><code>$senddata = new SendData('<i><kbd><a href="/?page=customed-register">YOUR_APP_KEY</a></kbd></i>');</code></pre></li>
						</ul>		
					</div>
					<div class="mt-5">
						<p class="mb-0"><b>2. Transmitting data on the subscribed channel and event in the frontend</b></p>
						<ul class="no-style-ul">
							<li>Transmitting data from backend. You must already subscribed and added the event on a channel (please see JavaScript Documentation steps 3 and 4).</li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>CodeIgniter</b></h5><br/>$this->load->library('senddata', array('app_key'=><i><kbd><a href="/?page=customed-register">YOUR_APP_KEY</a></kbd></i>));<br/>$SendDataObject = $this->senddata;<br/><br/>$SendDataObject->trigger('name_of_the_event', 'name_of_channel', data_to_transmit_or_push);</code></pre></li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>Native PHP</b></h5><br/>require('path/to/the/SendData.php');<br/><br/>$SendDataClass = new SendData;<br/>$senddata = $SendDataClass->initialize('<i><kbd><a href="/?page=customed-register">YOUR_APP_KEY</a></kbd></i>');</code></pre></li>
							<li>or this</li>
							<li class="mt-2"><pre class="mb-2"><code><h5 class="mb-0"><b>Native PHP</b></h5><br/>$senddata = new SendData('<i><kbd><a href="/?page=customed-register">YOUR_APP_KEY</a></kbd></i>');<br/><br/>$senddata->trigger('name_of_the_event', 'name_of_channel', data_to_transmit_or_push);</code></pre></li>
						</ul>
					</div>
				</div>
			</div>

		</div>
	</div>
	<p>Last updated: <b>Tuesday, August 3, 2021</b></p>
</div>
