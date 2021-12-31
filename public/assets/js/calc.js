$(document).ready(function() {
	// oldCompute();
	newCompute($('.calculatorSlider'));
});

function nFormatter(num) {
	if (num >= 1000000000) {
		return (num / 1000000000).toFixed(1).replace(/\.0$/, '') + ' Billion';
	}
	if (num >= 1000000) {
		return (num / 1000000).toFixed(1).replace(/\.0$/, '') + ' Million';
	}
	if (num >= 1000) {
		return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
	}
	return num;
}

function oldCompute() {
	var search = window.location.search;
	var slider = $("#calculatorSlider");
	if (slider.length) {
		var payloadLimit = $(".payloadLimit");
		var clientPrice = $(".clientPrice");
		var payloadLimitVal = $(".payloadLimitVal");
		var clientPriceVal = $(".clientPriceVal");
		var payloadTimes = 3000000;
		if (!license) {
			license = {
				enterprise: {
					active: false,
					price: 3000,
					percentage: 0.991
				},
				corpo: {
					active: true,
					price: 1000,
					percentage: 0.977
				},
				priv: {
					active: false,
					price: 500,
					percentage: 0.658
				}
			};
		}

		if ($.inArray(search, [''/*, '?page=login'*/]) >= 0) {
			window.localStorage.removeItem('customed');
			window.sessionStorage.removeItem('customed');
		}

		function calculate(price, value) {
			// console.log(price);
			var newLimit = Math.round(value * payloadTimes);
			payloadLimit.text(nFormatter(newLimit));
			payloadLimitVal.attr('value', newLimit);
			if ((value * price) == 0) {
				clientPrice.text(Math.round(0));
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
				clientPriceVal.attr('value', newPrice);
				slider.attr('value', parseInt(newLimit) / payloadTimes);
				slider.attr('data-value', parseInt(newLimit) / payloadTimes);
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
			console.log(obj);
			if (obj.payload != undefined) {
				// calculate(license.corpo.price, parseInt(value));
				if (license.priv.active) {
					value = obj.payload / license.priv.price;
					var obj = calculate(license.priv.price, parseInt(value));
				} else if (license.corpo.active) {
					value = obj.payload / payloadTimes;
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
			// calculate(license.corpo.price, 1);
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
}

function newCompute(sliders) {
	if (sliders == undefined) sliders = {length: 0};
	if (sliders.length) {
		var payloadTimes = 3000000;
		if (!license) {
			license = {
				enterprise: {
					active: false,
					price: 3000,
					percentage: 0.991
				},
				corpo: {
					active: true,
					price: 1000,
					percentage: 0.977
				},
				priv: {
					active: false,
					price: 500,
					percentage: 0.658
				}
			};
		}
		var pathname = window.location.pathname;

		function calculate(price, value, slider) {
			var payloadLimit = $(slider).parents('.card-body').find(".payloadLimit");
			var clientPrice = (pathname.indexOf('customed') < 0) ? $(slider).parents('.card-body').find(".clientPrice") : $(".clientPrice");
			var payloadLimitVal = $(".payloadLimitVal");
			var clientPriceVal = $(".clientPriceVal");
			// console.log($(slider), price, payloadLimit, clientPrice, payloadLimitVal, clientPriceVal);
			var newLimit = Math.round(value * payloadTimes);
			payloadLimit.text(nFormatter(newLimit));
			payloadLimitVal.attr('value', newLimit);
			if ((value * price) == 0) {
				clientPrice.text(Math.round(0));
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
				clientPriceVal.attr('value', newPrice);
				$(slider).attr('value', parseInt(newLimit) / payloadTimes);
				$(slider).attr('data-value', parseInt(newLimit) / payloadTimes);

				var obj = {'payload':newLimit, 'price':newPrice};
				window.localStorage.setItem('customed', JSON.stringify(obj));
				window.sessionStorage.setItem('customed', JSON.stringify(obj));
				return obj;
			}
		}

		sliders.each(function(i, slider) {
			if ($.inArray(pathname, ['/']) >= 0) {
				window.localStorage.removeItem('customed');
				window.sessionStorage.removeItem('customed');
			}

			$(slider).on("input change", function(e) {
				if (license.priv.active) {
					var obj = calculate(license.priv.price, $(this).val(), e.target);
				} else if (license.corpo.active) {
					var obj = calculate(license.corpo.price, $(this).val(), e.target);
				} else if (license.enterprise.active) {
					var obj = calculate(license.enterprise.price, $(this).val(), e.target);
				}
			});

			var value = 1;
			if (window.localStorage.getItem('customed')) {
				var obj = JSON.parse(window.localStorage.getItem('customed'));
				// console.log(obj);
				if (obj.payload != undefined) {
					// calculate(license.corpo.price, parseInt(value));
					if (license.priv.active) {
						value = obj.payload / license.priv.price;
						var obj = calculate(license.priv.price, parseInt(value), slider);
					} else if (license.corpo.active) {
						value = obj.payload / payloadTimes;
						var obj = calculate(license.corpo.price, parseInt(value), slider);
					} else if (license.enterprise.active) {
						value = obj.payload / license.enterprise.price;
						var obj = calculate(license.enterprise.price, parseInt(value), slider);
					}
					$(slider).attr('value', value);
					$(slider).attr('data-value', value);
				} else {
					// calculate(license.corpo.price, 1);
					if (license.priv.active) {
						var obj = calculate(license.priv.price, 1, slider);
					} else if (license.corpo.active) {
						var obj = calculate(license.corpo.price, 1, slider);
					} else if (license.enterprise.active) {
						var obj = calculate(license.enterprise.price, 1, slider);
					}
				}
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
			$(slider).slider({'value': value});
		});

	} else {	
		window.localStorage.removeItem('customed');
		window.sessionStorage.removeItem('customed');
		sliders.each(function(i, slider) {
			$(slider).slider({'value': 1});
		});
	}
}