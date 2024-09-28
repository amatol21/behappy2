jQuery(document).ready(function ($) {
	$(function () {
		$('input[name="daterange"]').daterangepicker({
			opens: 'left',
			locale: {
				format: 'YYYY-MM-DD',
				daysOfWeek: [
					"Пн",
					"Вт",
					"Ср",
					"Чт",
					"Пт",
					"Сб",
					"Нд"
				],
				monthNames: [
					"Січень",
					"Лютий",
					"Березень",
					"Квітень",
					"Травень",
					"Червень",
					"Липень",
					"Серпень",
					"Вересень",
					"Жовтень",
					"Листопад",
					"Грудень"
				],
				applyLabel: "Обрати",
				cancelLabel: "Відмінити",
				separator: " - ",
			}
		});
	});


});