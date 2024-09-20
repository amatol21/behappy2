jQuery(document).ready(function ($) {

	const siteUrl = window.location.origin;
	const domain = location.hostname;
	let formInfo = {
		amount: {
			selector1: '.amount_choice',
			selector2: '#id_amount',
			isError: false,
			message: 'Невірна сума пожертви. Перевірте суму.',
			valueButton: 0,
			valueWrite: 0,
			value: 0
		},

		currency: {
			selector: '#id_currency',
			isError: false,
			message: "Перевірте введене ім'я.",
			value: 'UAH'
		},

		name: {
			selector: '#first_name',
			isError: false,
			message: "Перевірте введене ім'я.",
			value: ''
		},

		lastName: {
			selector: '#last_name',
			isError: false,
			message: "Перевірте введене прізвище.",
			value: ''
		},

		email: {
			selector: '#email',
			isError: false,
			message: "Перевірте введений email.",
			value: ''
		},

		phone: {
			selector: '#phone',
			isError: false,
			message: "Перевірте введений номер телефону.",
			value: ''
		},

		collection: {
			selector: '#collection',
			isError: false,
			message: "Оберіть збір.",
			value: null
		},

		payDelivery: {
			selector: '#pay-delivery',
			isError: false,
			value: false
		},

		region: {
			selector: '#region',
			isError: false,
			message: "Оберіть регіон світу.",
			value: null
		},

		address: {
			selector: '#delivery_address',
			isError: false,
			message: "Перевірте введену адресу.",
			value: ''
		}
	};

	$('#pay-delivery').click(function () {
		$('.delivery-address').slideToggle(1000);
	});

	//console.log(`${formInfo.amount.selector1}`);

	for (let key in formInfo) {
		if (key == 'amount') {
			$(`${formInfo[key].selector1}`).change(function () {
				formInfo[key].valueButton = this.value;
				//console.log(formInfo[key].valueButton);
			});

			$(`${formInfo[key].selector2}`).change(function () {
				formInfo[key].valueWrite = this.value;
				//console.log(formInfo[key].valueWrite);
			});
		} else if (key == 'payDelivery') {
			$(`${formInfo[key].selector}`).change(function () {
				if ($(`${formInfo[key].selector}`).prop('checked')) {
					formInfo[key].value = true;
					//console.log(formInfo[key].value);
				} else {
					formInfo[key].value = false;
					//console.log(formInfo[key].value);
				}
			});
		} else {
			$(`${formInfo[key].selector}`).change(function () {
				formInfo[key].value = this.value;
				//console.log(formInfo[key].value);
			});
		}
	}


	$('#form-picture-button').click(function () {
		$('.errors').empty();
		for (let key in formInfo) {
			if (key == 'amount') {
				$(`${formInfo[key].selector2}`).removeClass('error-infosize');
				formInfo[key].isError = false;
			} else {
				$(`${formInfo[key].selector}`).removeClass('error-infosize');
				formInfo[key].isError = false;
			}
		}

		for (let key in formInfo) {

			if (key == 'amount') {
				if (formInfo[key].valueButton || formInfo[key].valueWrite) {
					if (formInfo[key].valueWrite) {
						formInfo[key].value = formInfo[key].valueWrite;
					} else {
						formInfo[key].value = formInfo[key].valueButton;
					}
				} else {
					$('.errors').append(`<p>${formInfo[key].message}</p>`);
					$(`${formInfo[key].selector2}`).addClass('error-infosize');
					formInfo[key].isError = true;
				}
			} else if (key == 'name' || key == 'lastName' || key == 'email' || key == 'phone' || key == 'collection') {
				if (!formInfo[key].value) {
					$('.errors').append(`<p>${formInfo[key].message}</p>`);
					$(`${formInfo[key].selector}`).addClass('error-infosize');
					formInfo[key].isError = true;
				}
			} else if (key == 'payDelivery') {
				continue;
			} else if ((key == 'region' || key == 'address') && (formInfo['payDelivery'].value)) {
				//console.log(formInfo['payDelivery'].value);
				if (!formInfo[key].value) {
					$('.errors').append(`<p>${formInfo[key].message}</p>`);
					$(`${formInfo[key].selector}`).addClass('error-infosize');
					formInfo[key].isError = true;
				}
			}
		}

		let errors = 0;

		for (let key in formInfo) {
			if (formInfo[key].isError) { errors++ };
		}

		if (!errors) {

			if (!formInfo['payDelivery'].value) {

				$.post(`${siteUrl}/?rest_route=/prepare/v1/get_sign/${formInfo['amount'].value}/${formInfo['currency'].value}/${formInfo['collection'].value}`, //для запуска на локальном сервере надо ставить http, для хостинга надо ставить https, иначе не работает
					{},
					function (data) {
						let data2 = JSON.parse(data);
						//console.log(data2);

						post('https://secure.wayforpay.com/pay', {
							merchantAccount: "behappyua_com",
							merchantAuthType: "SimpleSignature",
							merchantDomainName: domain,
							apiVersion: '2',
							orderReference: `bhwad_${data2['payment_post_id']}`,
							orderDate: data2['time'],
							amount: formInfo['amount'].value,
							currency: formInfo['currency'].value,
							productName: [`collection_${formInfo['collection'].value}`],
							productPrice: [formInfo['amount'].value],
							productCount: ["1"],
							merchantSignature: data2['sign'],

							clientFirstName: formInfo['name'].value,
							clientLastName: formInfo['lastName'].value,
							clientEmail: formInfo['email'].value,
							clientPhone: formInfo['phone'].value,
							language: 'UA',
							//serviceUrl: "http://behappy2/wp-content/themes/behappy/includes/finish_payment.php",
							returnUrl: data2['return_url']
						}, 'POST');
					}
				);
			} else {

				$.post(`${siteUrl}/?rest_route=/prepare/v1/get_complex_sign/${formInfo['amount'].value}/${formInfo['currency'].value}/${formInfo['name'].value}/${formInfo['lastName'].value}/${formInfo['email'].value}/${formInfo['phone'].value}/${formInfo['address'].value}/${formInfo['collection'].value}/${formInfo['region'].value}/${$('#id_post').val()}`,
					{},  							//для запуска на локальном сервере надо ставить http, для хостинга надо ставить https, иначе не работает
					function (data) {
						let data2 = JSON.parse(data);
						//let picturePostId = $('#id_post').val();
						//console.log(data2);

						post('https://secure.wayforpay.com/pay', {
							merchantAccount: "behappyua_com",
							merchantAuthType: "SimpleSignature",
							merchantDomainName: domain,
							orderReference: `bhwad_${data2['payment_post_id']}`,
							orderDate: data2['time'],
							amount: data2['full_amount'],
							currency: formInfo['currency'].value,
							productName: [`collection_${formInfo['collection'].value}`, `picture_${$('#id_post').val()}`],
							productPrice: [formInfo['amount'].value, data2['picture_fee']],
							productCount: ["1", "1"],
							merchantSignature: data2['sign'],

							clientFirstName: formInfo['name'].value,
							clientLastName: formInfo['lastName'].value,
							clientEmail: formInfo['email'].value,
							clientPhone: formInfo['phone'].value,
							clientAddress: formInfo['address'].value,
							language: 'UA',
							//serviceUrl: "http://behappy2/wp-content/themes/behappy/includes/finish_payment.php",
							returnUrl: data2['return_url']
						}, 'POST');
					}
				);

			}

		}


	});


});


