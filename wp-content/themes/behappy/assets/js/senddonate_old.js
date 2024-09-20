jQuery(document).ready(function ($) {
	//console.log($(this));
	const DONATE_PICTURE_URL = window.location.href;
	let donateObjGlobal = null;
	$("form#donate-form").submit(function (e) {

		e.preventDefault();
		//console.log(window.location.href);
		//fbq('track', 'Donate');
		$('form#donate-form .errors').text('');
		let serializedData = $(this).serialize();
		//console.log($(this));

		$.ajax({
			type: 'POST',
			url: DONATE_PICTURE_URL,
			data: serializedData,
			success: function (donateObj) {
				console.log(donateObj);
				console.log(' ');
				console.log(donateObj['delivery_fee']);
				donateObjGlobal = donateObj;
				$('form#donate-form').hide();
				$('#payment-details-block').show();

				$('#amount').text(donateObj['amount']);
				$('#currency').text(donateObj['currency']);

				$('#delivery-fee').text(donateObj['delivery_fee']);
				$('#delivery-currency').text(donateObj['currency']);
				setInitial();
			},
			error: function (response) {
				let resp = JSON.parse(response.responseText)['error'];
				let errorAll = resp['__all__']
				if (errorAll) {
					$('form#donate-form .errors').text(errorAll)
				} else {
					$('form#donate-form .errors').text('Щось пішло не так')
				}
			}
		})
	});







	let thankYouURLPlaceholder = 'https://behappyua.com/donate/0/wayforpay/return/';
	let resultURLPlaceholder = 'https://behappyua.com/donate/0/wayforpay/serice/';

	let amountWithoutDelivery = undefined;
	let amountWithDelivery = undefined;
	let amountDelivery = undefined;
	let currency = undefined;
	let signWithoutDelivery = undefined;
	let signWithDelivery = undefined;
	let amount = amountWithoutDelivery;
	let sign = signWithoutDelivery;

	function setInitial() {
		amountWithoutDelivery = donateObjGlobal['amount'];
		amountWithDelivery = donateObjGlobal['total_amount'];
		amountDelivery = donateObjGlobal['delivery_amount'];
		currency = donateObjGlobal['currency'];
		signWithoutDelivery = donateObjGlobal['sign_without_delivery'];
		signWithDelivery = donateObjGlobal['sign_with_delivery'];
		amount = amountWithoutDelivery;
		sign = signWithoutDelivery;
	}

	let deliveryRequiredInputs = $('#delivery_address, #delivery_state, #delivery_country');

	$('#pay-delivery').change(function (event) {
		let checkbox = event.target;
		if (checkbox.checked) {
			sign = signWithDelivery;
			amount = amountWithDelivery;
			deliveryRequiredInputs.prop('required', 'true');
		} else {
			sign = signWithoutDelivery;
			amount = amountWithoutDelivery;
			deliveryRequiredInputs.removeAttr('required');
		}
		$('#amount').text(amount);
	});

	$("form#payment-details-form").submit(function (e) {
		e.preventDefault();
		let data = convertFormToJSON($(this));
		let returnURL = thankYouURLPlaceholder.replace('0', donateObjGlobal['id']);
		let serviceURL = resultURLPlaceholder.replace('0', donateObjGlobal['id']);

		let query = `?first_name=${data['firstName']}&last_name=${data['lastName']}&phone=${data['phone']}&email=${data['email']}`;
		let returnURLWithQuery = `${returnURL}${query}`;

		saveDetails(data);
		wayForPayPay(
			donateObjGlobal['payment_id'],
			donateObjGlobal['created_at'],
			amount,
			currency,
			sign,
			data,
			returnURLWithQuery,
			serviceURL,
		)
	});

	function wayForPayPay(orderId, orderDate, amount, currency, sign, paymentDetails, returnUrl, serviceUrl) {
		post('https://secure.wayforpay.com/pay', {
			merchantAccount: "behappyua_com",
			merchantDomainName: "www.behappyua.com",
			authorizationType: "SimpleSignature",
			merchantSignature: sign,
			orderReference: orderId,
			orderDate: orderDate,
			amount: amount,
			currency: currency,
			productName: ["Donation"],
			productPrice: [amount],
			productCount: ["1"],

			clientFirstName: paymentDetails.firstName,
			clientLastName: paymentDetails.lastName,
			clientEmail: paymentDetails.email,
			clientPhone: paymentDetails.phone,
			language: 'UA',
			serviceUrl: serviceUrl,
			returnUrl: returnUrl,
		}, 'POST')
	}

	$('#delivery_country').on('change', function () {
		$('button#calculate-delivery').removeAttr('disabled');
	})

	function calculateDeliveryFee() {
		$('.delivery-errors').text('');
		$('.delivery-errors').hide();
		if ($('#delivery_country').val() === '') {
			$('.delivery-errors').show();
			$('.delivery-errors').text('Введіть країну перше')
			return
		}
		$('#delivery-amount').text(`${amountDelivery} ${currency}`);
		$('#pay-delivery').removeAttr('disabled');
	}

	function saveDetails(data) {
		const SAVE_DETAILS_URL = "/donate/0/details/";
		let url = SAVE_DETAILS_URL.replace('0', donateObjGlobal['id']);

		$.ajax({
			type: 'POST',
			url: url,
			data: {
				country: $('#delivery_country').val(),
				state: $('#delivery_state').val(),
				address: $('#delivery_address').val(),
				pay_delivery: $('#pay-delivery').is(':checked'),
				first_name: data['firstName'],
				last_name: data['lastName'],
				phone: data['phone'],
				email: data['email'],
			},
			headers: { 'X-CSRFToken': getCookie('csrftoken') },
			success: function () {
			},
			error: function (response) {
				console.log('Error during saving address: ', response)
			}
		})
	}
});