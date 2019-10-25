jQuery(document).ready(function($) {

	 $('#submit').on('click', function(){
		$('#update-store').submit();
		$(this).hide();
		$('.processing-img').removeClass('hide-img');
	 });

});
