<?php 
	// Get the favicon.
	$favicon = IMAGES . '/icons/favicon.png';

	// Get the custom touch icon.
	$touch_icon = IMAGES . '/icons/apple-touch-icon-152x152-precomposed.png';
?>

<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

	<!-- Favicon and Apple Icons -->
	<link rel="shortcut icon" href="<?php echo $favicon; ?>">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $touch_icon; ?>">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory' ); ?>/css/datepicker_assets/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory' ); ?>/css/datepicker_assets/jquery-ui.structure.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory' ); ?>/css/datepicker_assets/jquery-ui.theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory' ); ?>/css/william_style.css">


    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory' ); ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory' ); ?>/js/jquery.ui.datepicker.js"></script>
    <script type="text/javascript"src="<?php bloginfo('stylesheet_directory' ); ?>/css/datepicker_assets/jquery-ui.min.js"></script>
    <script type="text/javascript"src="<?php bloginfo('stylesheet_directory' ); ?>/js/form_ajax.js"></script>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <!-- HEADER -->
    <header class="site-header" role="banner">
        <div class="container header-contents">
			<div class="row">
				<div class="col-xs-3">
					<div class="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a>
					</div> <!-- end site-logo -->
				</div> <!-- end col-xs-3 -->
				<div class="col-xs-9">
					<nav class="site-navigation" role="navigation">
						<?php 
							wp_nav_menu(
								array(
									'theme_location' => 'main-menu',
									'menu_class' => 'site-menu'
								)
							);
						?>
					</nav>
				</div> <!-- end col-xs-9 -->
			</div> <!-- end row -->
		</div> <!-- end container -->
	</header> <!-- end site-header -->
    
    <?php echo do_shortcode( putRevSlider("homepage")) ?> <!-- Main Banner Slider -->
    

    <section id="results">
    	<div class="container">
    	<?php
    	global $wpdb;
    	$booking_page=get_page_by_title('booking-confirmed');
        $booking_page=get_permalink($booking_page->ID);
        if($_POST['arrival']){
		    if($_POST['arrival']!='Arrival')
			    $transfer_details['arrival']=$_POST['arrival'];
		    if($_POST['arrival_time']!='')
			    $transfer_details['arrival_time']=$_POST['arrival_time'];
		    if($_POST['departure']!='Departure')
			    $transfer_details['departure']=$_POST['departure'];
		    if($_POST['extra_stop']!='Extra Stop')
			    $transfer_details['extra_stop']=$_POST['extra_stop'];
		    if($_POST['arrival_date']!='')
			    $transfer_details['arrival_date']=$_POST['arrival_date'];
		    if($_POST['departure_date']!='')
			    $transfer_details['departure_date']=$_POST['departure_date'];
		    if($_POST['departure_time']!='')
			    $transfer_details['departure_time']=$_POST['departure_time'];
		    if($_POST['extra_service']!='')
			    $transfer_details['extra_service']=$_POST['extra_service'];
			if($_POST['num_persons']!='')
			    $transfer_details['num_persons']=$_POST['num_persons'];
		    $transfer_details['return_trip']=$_POST['return_trip'];
		}
		if($transfer_details['arrival']=="Gozo Direct"||$transfer_details['departure']=="Gozo Direct"){
			$gozo='Gozo Direct';
		}
		else if($transfer_details['arrival']=="Gozo Split"||$transfer_details['departure']=="Gozo Split"){
			$gozo='Gozo Split';
		}
		else
			$gozo=false;
		if(!$gozo){
			$arr_point=get_lat_long($transfer_details['arrival'],get_api_key());
			$dep_point=get_lat_long($transfer_details['departure'],get_api_key());
			$zone1=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'locations WHERE location_name="'.$transfer_details['arrival'].'"');
			$zone1=$zone1[0];
			$zone1=$zone1->zone_num;
			$zone2=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'locations WHERE location_name="'.$transfer_details['departure'].'"');
			$zone2=$zone2[0];
			$zone2=$zone2->zone_num;
			$zone=abs(intval($zone1)-intval($zone2));
			$prices=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'zones WHERE zone_name="'.$zone.'"');
			$prices=$prices[0];
		}
		else{
			$prices=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'zones WHERE zone_name="'.$gozo.'"');
			$prices=$prices[0];
		}
		$types['standard']=get_option('standard');
		$types['executive']=get_option('executive');
		$types['seater7']=get_option('seater7');
		$types['seater10']=get_option('seater10');
		$types['seater16']=get_option('seater16');
		$types['shuttle']=get_option('shuttle');
        ?>
        <div class="row">
        	<div class="col-sm-8">
		        <form class="bookingForm" action="<?php echo $booking_page ?>" method="post">
		        	<input type="hidden" name="vehicle_type" id="type">
		        	<input type="hidden" name="price" id="price">
		        	<?php foreach ($transfer_details as $key => $value): ?>
		        		<input type="hidden" id="<?php echo $key ?>" name="<?php echo $key ?>" value="<?php echo $value; ?>">
		        	<?php endforeach ?>
		        	<div class="spinner"></div>
				    	<div id="providers_container" class="providers_container">
                            <h3>Choose a vehicle</h3>
				    		<?php foreach ($types as $key => $value): ?>
					    		<?php if (isset($prices->$key)): ?>
						    		<?php
						    		if (intval($transfer_details['num_persons'])>4&&intval($transfer_details['num_persons']<7)){ 
						    			if($key=='executive'||$key=='standard')
						    				continue;
						    		}
						    		else if(intval($transfer_details['num_persons'])>7&&intval($transfer_details['num_persons']<10)){
						    			if($key=='executive'||$key=='standard'||$key=='seater7')
						    				continue;
						    		}
						    		else if(intval($transfer_details['num_persons'])>10&&intval($transfer_details['num_persons']<16)){
						    			if($key=='executive'||$key=='standard'||$key=='seater7'||$key=='seater10')
						    				continue;
						    		}
						    		else if(intval($transfer_details['num_persons'])>16){
						    			if($key=='executive'||$key=='standard'||$key=='seater7'||$key=='seater16'||$key=='seater10')
						    				continue;
						    		}
						    		 ?>
							    		<div class="provider_box row">
	                                        <div class="col-xs-12 col-md-3"><?php if (isset($value)): ?>
							    			<img src="<?php echo $value; ?>" style="max-width:150px;max-height:150px;"><?php endif ?></div>
							    			<div class="col-xs-12 col-md-6">
	                                            <h3><?php echo $key; ?></h3>
	                                            <ul class="fees">
	                                                <li>No Amendment Fees</li>
	                                                <li>No Cancellation Fees</li>
	                                                <li>No Card Charges</li>
	                                                <li>24/7 Phone Support</li>
	                                            </ul>
	                                        </div>
							    			<div class="col-xs-12 col-md-3 top_margined">
	                                            <h5>
	                                            €
							    				<?php
							    				$price=$prices->$key;
							    				if($transfer_details['return_trip']==yes)
							    					$price*=2;
							    				if(isset($transfer_details['extra_service']))
							    					$price+=4;
						    					echo number_format((float)$price, 2, '.', ''); 
							    				?>
	                                             </h5>
	                                            <div class="sub_button select_provider" price="<?php echo $price; ?>" type="<?php echo $key; ?>">BOOK NOW</div></div>
							    			<div class="clearfix"></div>
							    		</div>
					    		<?php endif ?>
				    		<?php endforeach ?>
			            </div><!-- close of providers container -->
			            <div class="passenger_details_part">
			                <h3>Your Details</h3>
			                <div class="col-md-6">
			                    <input type="text" id="passenger_name" name="passenger_name" placeholder="Full Name" required>
			                </div>
			                <div class="col-md-6" style="padding-right: 0;">
			                    <input type="tel" id="passenger_phone" name="passenger_phone" placeholder="Phone" required>
			                </div>
			                <div class="col-md-6">
			                    <input type="email" id="passenger_email" name="passenger_email" placeholder="Email" required>
			                </div>
			                <div class="col-md-12">
			                    <textarea id="passenger_address" name="passenger_address" placeholder="Address"></textarea>
			                </div>
			            </div><!-- close of passenger details -->
			            <div class="clearfix"></div>
			            <div id="payment_area" class="payment_area">
			                <h3>Payment Method:</h3>
			                <div class="col-md-6 no-padding-right-mobile">
			                    <input type="text" id="credit_card_name" name="credit_card_name" placeholder="Name on Card" required>
			                </div>
			                <div class="col-md-6" style="padding-right: 0;">
			                    <select id="card_type" name="card_type">
			                        <option value="visa">Visa</option>
			                        <option value="master_card">Master Card</option>
			                    </select>
			                </div>
			                <div class="col-md-6 no-padding-right-mobile">
			                    <input type="text" id="credit_card_num" name="credit_card_num" placeholder="Credit Card Number" required>
			                </div>
                            
                            <div class="col-md-6" style="padding-right: 0;">
                                <select name="expiry_month" id="expiry_month" class="expiry_month">
                                    <option value="-1"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>                               
                                </select>
                                
                                <select name="expiry_year" id="expiry_year" class="expiry_year">
                                    <option value="-1"></option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>                                
                                </select>
                            </div>
                            
                            
			                <div class="col-md-6 ccv-mobile">
			                    <input type="text" id="ccv" name="ccv" placeholder="CVV2 (last 3 numbers on back of card)" required>
			                </div>
			                <div class="centered amount-charged">
			                    Amount to be Charged (in Euro): € <span class="add_price"></span>
			                </div>
			                <div class="col-md-12" style="padding-right: 0;">
			                    <input type='submit' class="second_page sub_button">
			                </div>
			            </div><!-- close of payment area -->
			            <div class="clearfix"></div>
			        </form>
	        	</div><!-- end of main contents -->
	        	<div class="col-sm-4">
	        		<div id="map-canvas"></div>
	        	</div><!-- end of sidebar -->
	        </div><!-- end of row -->
    	</div><!-- end of container -->
    </section>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory' ); ?>/js/find-service.js"></script>
<script type="text/javascript">$(document).ready(function(){update_map(<?php echo $arr_point->lat  ?>,<?php echo $arr_point->long ?>,<?php echo $dep_point->lat ?>,<?php echo $dep_point->long ?>);});</script>
<?php get_sidebar(); ?>

<?php get_footer(); ?>