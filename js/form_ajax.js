$(document).ready(function(){
	$(".firstForm").on('submit',function(event){
		event.preventDefault();
		var arrival=$('#arrival').val();
		if(arrival=='Arrival')
			arrival=null;
		var departure=$('#departure').val();
		if(departure=='Departure')
			departure=null;
		var extra_stop=$("#extra_stop").val();
		if(extra_stop=='Extra Stop')
			extra_stop=null;
		var arrival_date=$("#arrival-date").val();
		var departure_date=$("#departure-date").val();
		var num_persons=$("#num_persons").val();
		var service=$("#service").val();
		var extra_service=$("#extra_service").val();
		var sbmt=true;
		if(arrival==null&&departure==null){
			alert('Please Choose an arrival point');
			sbmt=false;
		}
		if(num_persons==null){
			alert('Please Choose the Persons Number');
			sbmt=false;
		}
		if(sbmt){
			$(this).unbind();
			$(this).submit();
		}
		else
			return false;
	});
	$(document).on ("click", ".select_provider", function () {
		var obj=$(this).closest('.provider_box');
		var price=$(this).attr('price');

		if ($(this).attr('type')=='shuttle') {
			price*=$("#num_persons").val();
		}

		$("input[type='submit']").val("Pay €"+price+" And Confirm");
		$("span.add_price").html(price);
		$(".providers_container .provider_box").remove();
		$(".providers_container").append(obj[0]);
		$('.providers_container .provider_box .select_provider').remove();
		$('.passenger_details_part').slideDown('fast');
		$("#passenger_address").hide();
		var output='';
		if($('#arrival').val().toLowerCase()=="malta international airport"){
			output+='<div class="col-md-6"><input type="text" name="arrival_time" id="arrival-time" placeholder="Arrival Time (HH:MM)"></div><div class="col-md-6"><input type="text"  name="arrival_flight" id="arrival-flight" placeholder="Arrival Flight #"></div>';
		}
		// if($("#departure").val().toLowerCase()=="malta international airport"){
		// 	output+='<div class="col-md-6"><input type="text" name="departure_time" id="departure-time" placeholder="Departure Time (HH:MM)"> </div> <div class="col-md-6"><input type="text" name="departure_flight" id="departure-flight" placeholder="Departure Flight #"></div>';
		// }
		output+='<div class="col-md-6"><input type="text" name="holy_add" id="holy_add" placeholder="Pick Up and/or Destination Address"></div> <div class="col-md-12"><a href="#payment_area"><div id="details_button"  class="sub_button">Pay Via Credit Card <span></span></div></a></div><div class="clearfix"></div>';
		$('.passenger_details_part').append(output);
		$('.passenger_details_part').slideDown('fast');
		$('#type').val($(this).attr('type'));
		$('#price').val(price);
	});
	$(document).on ("click", "#details_button", function () {
		var first_name=$('#passenger_name').val();
		var passenger_surname=$('#passenger_surname').val();
		var passenger_phone=$('#passenger_phone').val();
		var passenger_email=$('#passenger_email').val();
		var passenger_address=$('#passenger_address').val();
		var passenger_country=$('#passenger_country').val();
		var arrival_time=$('#arrival-time').val();
		var arrival_flight=$('#arrival-flight').val();
		var departure_time=$('#departure-time').val();
		var departure_flight=$('#departure-flight').val();
		var holy_add=$('#holy_add').val();
		var arrival=$('#arrival').val();
		var departure=$('#departure').val();
		var extra_stop=$("#extra_stop").val();
		var extra_stop_time=$("#extra-stop-time").val();
		var extra_stop_flight=$("#extra-stop_flight").val();

		if(first_name==''){
			alert('You must enter your first name');
			$('#passenger_name').focus();
			return false;
		}
		if(passenger_surname==''){
			alert('You must enter your surname');
			$('#passenger_surname').focus();
			return false;
		}
		if(passenger_phone==''){
			alert('You must enter your phone number');
			$('#passenger_phone').focus();
			return false;
		}
		if(passenger_email==''){
			alert('You must enter your email');
			$('#passenger_email').focus();
			return false;
		}
		if(passenger_country==''){
			alert('You must enter your country');
			$('#passenger_country').focus();
			return false;
		}
		if(arrival_time==''&&arrival!='Arrival'){
			alert('You must enter your arrival time');
			$('#arrival-time').focus();
			return false;
		}
		if(arrival_flight==''&&arrival!='Arrival'){
			alert('You must enter your arrival flight number');
			$("#arrival-flight").focus();
			return false;
		}
		if(departure_time==''&&departure!='Departure'){
			alert('You must enter your departure time');
			$("#departure-time").focus();
			return false;
		}
		if(departure_flight==''&&departure!='Departure'){
			alert('You must enter your departure flight');
			$("#departure-flight").focus();
			return false;
		}
		if(extra_stop_time==''&&extra_stop!='Extra Stop'){
			alert('You must enter your departure flight');
			$("#extra-stop-time").focus();
			return false;
		}
		if(extra_stop_flight==''&&extra_stop!='Extra Stop'){
			alert('You must enter your departure flight');
			$("#extra-stop_flight").focus();
			return false;
		}
		if(holy_add==''){
			alert('You must enter your holiday address');
			$("#holy_add").focus();
			return false;
		}
		$('.payment_area').slideDown('fast');
		$('#details_button').remove();
	});
	
	$('.bookingForm').on('submit',function(event){
		event.preventDefault();
		if($("#credit_card_name").val()==''){
			alert("You must enter the name on the credit card");
			$("#credit_card_name").focus();
			return false;
		}
		else if($("#credit_card_num").val()==''){
			alert("You must enter the credit card number");
			$("#credit_card_num").focus();
			return false;
		}
		else if($("#ccv").val()==''){
			alert("You must enter the ccv ((last 3 numbers on back of card))");
			$("#ccv").focus();
			return false;
		}
		else{
			$(this).unbind();
			$(this).submit();
		}

	});

	var myDate = new Date();
	var day=myDate.getDate()+7;
	var mnth=myDate.getMonth();
	var yr=myDate.getFullYear();

	for(var i=0;i<12;i++){
		if(mnth==i){
			if(mnth<10&&i!=12){
				mnth="0"+(i+1);
				break;
			}
			else if(mnth==i&&i==11){
				mnth="01";
				yr+=1;
				break;
			}
			else{
				mnth=i+1;
				break;
			}
		}
	}
		if(mnth==1||mnth==3||mnth==5||mnth==7||mnth==8||mnth==10||mnth==12){
			if(day>31){
				day-=31;
				mnth=parseInt(mnth)+1;
			}
		}
		else if(mnth==4||mnth==6||mnth==9||mnth==11){
			if(day>30){
				day-=30;
				mnth=parseInt(mnth)+1;
			}
		}
		else if(mnth==2){
			if(day>28){
				day-=28;
				mnth=parseInt(mnth)+1;
			}
		}
	if(parseInt(day)<10)
		day='0'+day;
	if(parseInt(mnth)<10&&mnth.toString().length<2)
		mnth="0"+mnth;
	var prettyDate =day + '/' + mnth + '/' +yr;
	$( ".datepicker" ).datepicker({ dateFormat: "dd/mm/yy", minDate:'0d',defaultDate: +7  });
        if($(".datepicker").val()==''||!$(".datepicker").val())
            $(".datepicker").val(prettyDate);

	$(document).on ("click", "a[href*=#]:not([href=#])", function () {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
			|| location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});
});