$(document).ready(function() {
	var search = window.location.search;
	if ($.inArray($.trim(search), ['', '?page=login', '?page=customed-register']) >= 0) {
		var slider = $("#calculatorSlider");
		var payloadLimit = $(".payloadLimit");
		var clientPrice = $(".clientPrice");
		var payloadLimitVal = $(".payloadLimitVal");
		var clientPriceVal = $(".clientPriceVal");
		// var percentageFee = 0.769;
		var license = {
			enterprise: {
				active: false,
				price: 3000,
				percentage: 0.991
			},
			corpo: {
				active: true,
				price: 1000,
				percentage: 0.769
			},
			priv: {
				active: false,
				price: 500,
				percentage: 0.658
			}
		};

		if ($.inArray(search, ['', '?page=login']) >= 0) {
			window.localStorage.removeItem('customed');
			window.sessionStorage.removeItem('customed');
		}

		function calculate(price, value) {
			// console.log(price)
			var newLimit = Math.round(value * price);
			payloadLimit.text(newLimit);
			payloadLimitVal.attr('value', newLimit);
			if ((value * price) == 0) {
				clientPrice.text(Math.round(0));
			} else {
				var percentageFee = 0.769;
				if (license.priv.active) {
					percentageFee = license.priv.percentage;
				} else if (license.corpo.active) {
					percentageFee = license.corpo.percentage;
				} else if (license.enterprise.active) {
					percentageFee = license.enterprise.percentage;
				}
				var newPrice = Math.round(((value * 300) + price) * percentageFee);
				clientPrice.text(newPrice);
				clientPriceVal.attr('value', newPrice);
				slider.attr('value', parseInt(newLimit) / price);
				slider.attr('data-value', parseInt(newLimit) / price);
				var obj = {'payload':newLimit, 'price':newPrice};
				window.localStorage.setItem('customed', JSON.stringify(obj));
				window.sessionStorage.setItem('customed', JSON.stringify(obj));
				return obj;
			}
		}
		slider.on("input change", function(e) {
			if (license.priv.active) {
				var obj = calculate(license.priv.price, $(this).val());
			} else if (license.corpo.active) {
				var obj = calculate(license.corpo.price, $(this).val());
			} else if (license.enterprise.active) {
				var obj = calculate(license.enterprise.price, $(this).val());
			}
			// document.cookie="customed=;expires=Wed; 01 Jan 1970";
			// var date = new Date();
			// date.setTime(date.getTime() + (1*24*60*60*1000));
			// var expires = "; expires=" + date.toUTCString();
			// document.cookie = "customed=" + (JSON.stringify(obj) || "")  + expires + "; path=/";
		});
		var value = 1;
		if (window.localStorage.getItem('customed')) {
			var obj = JSON.parse(window.localStorage.getItem('customed'));
			if (obj.payload != undefined) {
				// calculate(license.corpo.price, parseInt(value));
				if (license.priv.active) {
					value = obj.payload / license.priv.price;
					var obj = calculate(license.priv.price, parseInt(value));
				} else if (license.corpo.active) {
					value = obj.payload / license.corpo.price;
					var obj = calculate(license.corpo.price, parseInt(value));
				} else if (license.enterprise.active) {
					value = obj.payload / license.enterprise.price;
					var obj = calculate(license.enterprise.price, parseInt(value));
				}
				slider.attr('value', value);
				slider.attr('data-value', value);
			} else {
				// calculate(license.corpo.price, 1);
				if (license.priv.active) {
					var obj = calculate(license.priv.price, 1);
				} else if (license.corpo.active) {
					var obj = calculate(license.corpo.price, 1);
				} else if (license.enterprise.active) {
					var obj = calculate(license.enterprise.price, 1);
				}
			}
		} else {
			calculate(license.corpo.price, 1);
			if (license.priv.active) {
				var obj = calculate(license.priv.price, 1);
			} else if (license.corpo.active) {
				var obj = calculate(license.corpo.price, 1);
			} else if (license.enterprise.active) {
				var obj = calculate(license.enterprise.price, 1);
			}
		}
		$('#calculatorSlider').slider({'value': value});
	} else {	
		window.localStorage.removeItem('customed');
		window.sessionStorage.removeItem('customed');
		$('#calculatorSlider').slider({'value': 1});
	}
});