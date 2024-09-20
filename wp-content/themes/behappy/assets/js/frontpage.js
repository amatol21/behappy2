document.addEventListener('DOMContentLoaded', function () {
	if (document.querySelector('#splide1')) {
		var splide = new Splide('.splide', {
			type: 'slide',
			width: '100%',
			height: '250px',
			perPage: 5,
			arrows: false,
			gap: '20px',
			lazyLoad: 'nearby',
			breakpoints: {
				0: {
					perPage: 1,
				},
				600: {
					perPage: 2,
				},
				800: {
					perPage: 3,
				},
				1024: {
					perPage: 5,
				},
			},
			pagination: false
		}).mount();
	}

	if (document.querySelector('#splide2')) {
		var splide2 = new Splide('#splide2', {
			type: 'slide',
			width: '100%',
			height: '250px',
			perPage: 5,
			arrows: false,
			gap: '20px',
			lazyLoad: 'nearby',
			breakpoints: {
				0: {
					perPage: 1,
				},
				600: {
					perPage: 2,
				},
				800: {
					perPage: 3,
				},
				1024: {
					perPage: 5,
				},
			},
			pagination: false
		}).mount();
	}

	if (document.querySelector('#splide3')) {
		var splide3 = new Splide('#splide3', {
			type: 'slide',
			width: '100%',
			height: '250px',
			perPage: 5,
			arrows: false,
			gap: '20px',
			lazyLoad: 'nearby',
			breakpoints: {
				0: {
					perPage: 1,
				},
				600: {
					perPage: 2,
				},
				800: {
					perPage: 3,
				},
				1024: {
					perPage: 5,
				},
			},
			pagination: false
		}).mount();
	}
});

jQuery(document).ready(function ($) {



});