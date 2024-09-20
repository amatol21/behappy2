jQuery(document).ready(function ($) {

	$(document).ready(function () {
		currencyOnChange()
	});

	const domain = location.hostname;
	const siteUrl = window.location.origin;

	let formInfo = {
		amount: {
			selector1: '.amount-choice',
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

		collection: {
			selector: '#collection',
			isError: false,
			message: "Оберіть збір",
			value: null
		}
	};

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
		} else {
			$(`${formInfo[key].selector}`).change(function () {
				formInfo[key].value = this.value;
				//console.log(formInfo[key].value);
			});
		}
	}


	$('#form-donate-button').click(function () {
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
			} else if (key == 'collection') {
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

			$.post(`${siteUrl}/?rest_route=/prepare/v1/get_sign/${formInfo['amount'].value}/${formInfo['currency'].value}/${formInfo['collection'].value}`,
				{},
				function (data) {
					let data2 = JSON.parse(data);
					//console.log(typeof (formInfo['amount'].value));

					post('https://secure.wayforpay.com/pay', {
						merchantAccount: "behappyua_com",
						merchantAuthType: "SimpleSignature",
						merchantDomainName: domain,
						orderReference: `bhwad_${data2['payment_post_id']}`,
						orderDate: data2['time'],
						amount: formInfo['amount'].value,
						currency: formInfo['currency'].value,
						productName: [`collection_${formInfo['collection'].value}`],
						productPrice: [formInfo['amount'].value],
						productCount: ["1"],
						merchantSignature: data2['sign'],

						//clientFirstName: formInfo['name'].value,
						//clientLastName: formInfo['lastName'].value,
						//clientEmail: formInfo['email'].value,
						//clientPhone: formInfo['phone'].value,
						language: 'UA',
						//serviceUrl: serviceUrl,
						returnUrl: data2['return_url']
					}, 'POST');
				}
			);

		}


	});




});