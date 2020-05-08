$(document).ready(function() {

	var pathname = window.location.pathname;

	var slider = $("#calculatorSlider");
	var payloadLimit = $(".payloadLimit:not(input)");
	var inputPayloadLimit = $("input.payloadLimit");
	var clientPrice = $(".clientPrice:not(input)");
	var inputClientPrice = $("input.clientPrice");
	var payloadLimitVal = $(".payloadLimitVal");
	var clientPriceVal = $(".clientPriceVal");
	var license = oLicense;

	slider.on("input change", function(e) {
		if (license.priv.active) {
			var obj = calculate(license.priv.price, $(this).val(), $(this));
		} else if (license.corpo.active) {
			var obj = calculate(license.corpo.price, $(this).val(), $(this));
		} else if (license.enterprise.active) {
			var obj = calculate(license.enterprise.price, $(this).val(), $(this));
		}
	});

	if ($.inArray(pathname, ['/']) >= 0) {
		window.localStorage.removeItem('customed');
		window.sessionStorage.removeItem('customed');
		slider.slider({'value': 1});
	}

	var value = 1;
	if (window.localStorage.getItem('customed')) {
		var obj = JSON.parse(window.localStorage.getItem('customed'));
		console.log(obj)
		if (obj.payload != undefined) {
			// calculate(license.corpo.price, parseInt(value), slider);
			if (license.priv.active) {
				value = obj.payload / license.priv.price;
				var obj = calculate(license.priv.price, parseInt(value), slider);
			} else if (license.corpo.active) {
				value = obj.payload / license.corpo.price;
				var obj = calculate(license.corpo.price, parseInt(value), slider);
			} else if (license.enterprise.active) {
				value = obj.payload / license.enterprise.price;
				var obj = calculate(license.enterprise.price, parseInt(value), slider);
			}
			slider.attr('value', value);
			slider.attr('data-value', value);
		} else {
			// calculate(license.corpo.price, 1, slider);
			if (license.priv.active) {
				var obj = calculate(license.priv.price, 1, slider);
			} else if (license.corpo.active) {
				var obj = calculate(license.corpo.price, 1, slider);
			} else if (license.enterprise.active) {
				var obj = calculate(license.enterprise.price, 1, slider);
			}
		}
	} else {
		calculate(license.corpo.price, 1, slider);
		if (license.priv.active) {
			var obj = calculate(license.priv.price, 1, slider);
		} else if (license.corpo.active) {
			var obj = calculate(license.corpo.price, 1, slider);
		} else if (license.enterprise.active) {
			var obj = calculate(license.enterprise.price, 1, slider);
		}
	}

	$('#calculatorSlider').slider({'value': value});

	function calculate(price, value, slider) {
		// console.log(price)
		var newLimit = Math.round(value * price);
		payloadLimit.text(newLimit);
		inputPayloadLimit.val(newLimit);
		payloadLimitVal.attr('value', newLimit);
		if ((value * price) == 0) {
			clientPrice.text(Math.round(0));
			inputClientPrice.val(Math.round(0));
		} else {
			var percentageFee = 0.977;
			if (license.priv.active) {
				percentageFee = license.priv.percentage;
			} else if (license.corpo.active) {
				percentageFee = license.corpo.percentage;
			} else if (license.enterprise.active) {
				percentageFee = license.enterprise.percentage;
			}
			var newPrice = Math.round(((value * 300) + price) * percentageFee);
			newPrice = Math.round(newPrice / 39);
			clientPrice.text(newPrice);
			inputClientPrice.val(newPrice);
			clientPriceVal.attr('value', newPrice);
			slider.attr('value', parseInt(newLimit) / price);
			slider.attr('data-value', parseInt(newLimit) / price);
			var obj = {'payload':newLimit, 'price':newPrice};
			window.localStorage.setItem('customed', JSON.stringify(obj));
			window.sessionStorage.setItem('customed', JSON.stringify(obj));
			return obj;
		}
	}
});