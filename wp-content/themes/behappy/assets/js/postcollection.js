document.addEventListener('DOMContentLoaded', function () {
	if (document.querySelector('.splide')) {
		var splide = new Splide('.splide', {
			type: 'slide',
			width: '800px',
			height: '450px',
			lazyLoad: 'nearby',
			pagination: false
		});
		splide.mount();
	}
});

jQuery(document).ready(function ($) {



});