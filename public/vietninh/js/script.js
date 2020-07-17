$(document).ready(function() {

	$('.filter-form ul #construction-time input').datepicker();
	$('.filter-form ul #end-time input').datepicker();

	$('.header-page ._right .search-form button').click(function(){
		if($(this).hasClass('active-btn')){
			$(this).removeClass('active-btn');
			$('.header-page ._right .search-form form.active').removeClass('active');
			$('.header-page ._right .search-form input.active').removeClass('active');
		} else {
			$(this).addClass('active-btn');
			$('.header-page ._right .search-form form').addClass('active');
			$('.header-page ._right .search-form input').addClass('active');
		}
	});
});
