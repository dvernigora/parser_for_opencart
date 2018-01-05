$(document).ready(function () {
	$(function(){
		$('.cell').hover(function(){
			const icon = $(this).find('.fa');
			icon.animate({opacity: '1'}, 100);
		},
		function(){
			const icon = $(this).find('.fa');
			icon.animate({opacity: '0'}, 100);
		});
	});


	$('.row_0').click(function () {
		const self = $(this);

		let selfClass = self.attr("class").split(' ');
		if (selfClass[2] === 'col_0') {
			return false;
		}

		const col = self.parent();
		col.fadeOut();
		setTimeout(function () {col.remove();}, 1000);
	});

	$('.col_0').click(function () {
		const self = $(this);

		let selfClass = self.attr("class").split(' ');
		if (selfClass[1] === 'row_0') {
			return false;
		}

		const row = $('.' + selfClass[1]);
		row.fadeOut();
		setTimeout(function () {row.detach();}, 1000);
	});

	$('.cell').click(function () {
		const self = $(this);
		self.animate({fontSize: '0'}, 200);
		setTimeout(function () {self.children('.value').text('');}, 200);
	});
});

