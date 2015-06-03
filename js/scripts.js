/**
 * Functions and scripts related to the theme.
 */
 $(document).ready(function(){
 	$('#return_button').on('click',function(){
 		if($(this).find('.return_container .check_button').hasClass('checked_permenant')){
 			$(this).find('.return_container .check_button').removeClass('checked_permenant');
 			$("#return_trip").val('no');
 			$(".departure_date_container").slideUp('fast');
 		}
 		else{
 			$("#return_trip").val('yes');
 			$(this).find('.return_container .check_button').addClass('checked_permenant');
 			$(".departure_date_container").slideDown('fast');
 		}
 	});
 	$('#return_button').on('hover',function(){
		$(this).find('.return_container .check_button').addClass('checked_temp');
 	});
 	$('#return_button').on('mouseout',function(){
		$(this).find('.return_container .check_button').removeClass('checked_temp');
 	});

 	$('#return_button .checked').on('click',function(){
 		if($(this).find('.return_container .check_button').hasClass('checked_permenant')){
 			$(this).find('.return_container .check_button').removeClass('checked_permenant');
 			$("#return_trip").val('no');
 			$(".departure_date_container").slideUp('fast');
 		}
 		else{
 			$(".departure_date_container").slideDown('fast');
 			$("#return_trip").val('yes');
 			$(this).find('.return_container .check_button').addClass('checked_permenant');
 		}
 	});
 	$('#return_button .checked').on('hover',function(){
		$(this).closest('#return_button').find('.return_container .check_button').addClass('checked_temp');
	});
 	$('#return_button .checked').on('mouseout',function(){
		$(this).find('.return_container .check_button').removeClass('checked_temp');
 	});

	$('#return_button .checked').on('click',function(){
 		if($(this).find('.return_container .check_button').hasClass('checked_permenant')){
 			$(this).find('.return_container .check_button').removeClass('checked_permenant');
 			$("#return_trip").val('no');
 			$(".departure_date_container").slideUp('fast');
 		}
 		else{
 			$("#return_trip").val('yes');
 			$(".departure_date_container").slideDown('fast');
 			$(this).find('.return_container .check_button').addClass('checked_permenant');
 		}
 	});
 	$('#return_button .text_container').on('click',function(){
 		if($(this).find('.return_container .check_button').hasClass('checked_permenant')){
 			$(this).find('.return_container .check_button').removeClass('checked_permenant');
 			$("#return_trip").val('no');
 		}
 		else{
 			$("#return_trip").val('yes');
 			$(this).find('.return_container .check_button').addClass('checked_permenant');
 		}
 	});
 	$('#return_button .text_container').on('hover',function(){
		$(this).closest('#return_button').find('.return_container .check_button').addClass('checked_temp');
	});
 	$('#return_button .text_container').on('mouseout',function(){
		$(this).find('.return_container .check_button').removeClass('checked_temp');
 	});
 	
 });