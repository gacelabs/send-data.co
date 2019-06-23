$(document).ready(function() {
	var search = window.location.search;
	if ($.inArray($.trim(search), ['', '?page=login', '?page=customed-register']) >= 0) {
		var slider = $("#calculatorSlider");
		var payloadLimit = $(".payloadLimit");
		var clientPrice = $(".clientPrice");
		var payloadLimitVal = $(".payloadLimitVal");
		var clientPriceVal = $(".clientPriceVal");
		var percentageFee = 0.769;
		var license = {
			corpo: {
				active: true,
				price: 1000,
			},
			small: {
				active: false,
				price: 900,
			},
			priv: {
				active: false,
				price: 500,
			}
		};

		if ($.inArray(search, ['', '?page=login']) >= 0) {
			window.localStorage.removeItem('customed');
			window.sessionStorage.removeItem('customed');
		}

		function calculate(price, value) {
			// console.log(price)
			var newLimit = Math.round(value * 1000);
			payloadLimit.text(newLimit);
			payloadLimitVal.attr('value', newLimit);
			if ((value * 1000) == 0) {
				clientPrice.text(Math.round(0));
			} else {
				var newPrice = Math.round(((value * 300) + price) * percentageFee);
				clientPrice.text(newPrice);
				clientPriceVal.attr('value', newPrice);
				slider.attr('value', parseInt(newLimit) / 1000);
				slider.attr('data-value', parseInt(newLimit) / 1000);
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
			} else if (license.small.active) {
				var obj = calculate(license.small.price, $(this).val());
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
				value = obj.payload / 1000;
				calculate(license.corpo.price, parseInt(value));
				slider.attr('value', value);
				slider.attr('data-value', value);
			} else {
				calculate(license.corpo.price, 1);
			}
		} else {
			calculate(license.corpo.price, 1);
		}
		$('#calculatorSlider').slider({'value': value});
	} else {	
		window.localStorage.removeItem('customed');
		window.sessionStorage.removeItem('customed');
		$('#calculatorSlider').slider({'value': 1});
	}
});