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
    
    <?php 
    /** Getting trnasfer data **/
    if($_POST['passenger_name']){
    	$transfer_details['type']=$_POST['vehicle_type'];
    	$transfer_details['price']=$_POST['price'];
	    $transfer_details['num_persons']=$_POST['num_persons'];
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
	    if($_POST['prov_id']!='')
		    $transfer_details['provider_id']=$_POST['prov_id'];
	    if($_POST['passenger_name']!='')
		    $transfer_details['passenger_name']=$_POST['passenger_name'];
	    if($_POST['passenger_surname']!='')
		    $transfer_details['passenger_surname']=$_POST['passenger_surname'];
	    if($_POST['passenger_phone']!='')
		    $transfer_details['passenger_phone']=$_POST['passenger_phone'];
	    if($_POST['passenger_email']!='')
		    $transfer_details['passenger_email']=$_POST['passenger_email'];
	    if($_POST['passenger_address']!='')
		    $transfer_details['passenger_address']=$_POST['passenger_address'];
	    if($_POST['passenger_country']!='')
		    $transfer_details['passenger_country']=$_POST['passenger_country'];
	    if($_POST['extra_service']!='')
		    $transfer_details['extra_service']=$_POST['extra_service'];
	    if($_POST['arrival_time']!='')
		    $transfer_details['arrival_time']=$_POST['arrival_time'];
	    if($_POST['arrival_flight']!='')
		    $transfer_details['arrival_flight']=$_POST['arrival_flight'];
	    if($_POST['departure_time']!='')
		    $transfer_details['departure_time']=$_POST['departure_time'];
	    if($_POST['departure_flight']!='')
		    $transfer_details['departure_flight']=$_POST['departure_flight'];
	    if($_POST['holy_add']!='')
		    $transfer_details['holy_add']=$_POST['holy_add'];
	    if($_POST['credit_card_name']!='')
		    $transfer_details['credit_card_name']=$_POST['credit_card_name'];
	    if($_POST['card_type']!='')
		    $transfer_details['card_type']=$_POST['card_type'];
	    if($_POST['credit_card_num']!='')
		    $transfer_details['credit_card_num']=$_POST['credit_card_num'];
        if($_POST['expiry_month']!='')
		    $transfer_details['expiry_month']=$_POST['expiry_month'];
         if($_POST['expiry_year']!='')
		    $transfer_details['expiry_year']=$_POST['expiry_year'];
	    if($_POST['ccv']!='')
		    $transfer_details['ccv']=$_POST['ccv'];
	    if($_POST['return_trip']!='')
		    $transfer_details['return_trip']=$_POST['return_trip'];

		$transfer=array(
			'post_type'			=>'transfers',
			'post_status'		=>'publish',
		);
		global $wpdb;
		$provider_type=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'vehicletype WHERE vec_id='.$transfer_details['provider_id']);
		$provider_type=$provider_type[0];
		if(isset($transfer_details['arrival']))
			$transfer['post_title']="Transfer To ".$transfer_details['arrival'];
		else if(isset($transfer_details['departure']))
			$transfer['post_title']="Transfer To ".$transfer_details['departure'];

		$transfer['post_title'].=" - ".$transfer_details['type'].' vehicle';
		$tid=wp_insert_post($transfer);

		foreach ($transfer_details as $key => $value) {
			update_post_meta($tid,$key,$value);
		}

		$admin_subject='New Transfers has been Booked';
		$admin_message="Transfer Details:<br/>";
		$admin_message.="Transfer Reference: #000$tid<br/>";

		if(isset($transfer_details['extra_stop']))
        $admin_message.="Arrival Date: ".$transfer_details['arrival_date']. "<br/>";
        $admin_message.="Arrival Time: ".$transfer_details['arrival_time']. "<br/>";
        $admin_message.="Arrival flight: ".$transfer_details['arrival_flight']. "<br/>";
        $admin_message.="Departure Date: ".$transfer_details['departure_date']. "<br/>";
        // $admin_message.="Departure Time: ".$transfer_details['departure_time']. "<br/>";
        // $admin_message.="Departure flight: ".$transfer_details['departure_flight']. "<br/>";
        $admin_message.="Passengers number: ".$transfer_details['num_persons']. "<br/><br/><br/>";
        
        $admin_message.="Name: ".$transfer_details['passenger_name']." ".$transfer_details['passenger_surname']."<br/>";
		$admin_message.="Email: ".$transfer_details['passenger_email']."<br/>";
		$admin_message.="Phone : ".$transfer_details['passenger_phone']." ".$transfer_details['passenger_country']."<br/><br/><br/>";
        
        
        $admin_message.="Pick Up and/or Destination Address: ".$transfer_details['holy_add']. "<br/>";
        if(isset($transfer_details['arrival']))
			$admin_message.="Pick-up: ".$transfer_details['arrival']."<br/>";
		if(isset($transfer_details['departure']))
        $admin_message.="Destination: ".$transfer_details['departure']."<br/>";
        $admin_message.="Vehicle Type: ".$transfer_details['type']."<br/><br/><br/>";
        
        
        $admin_message.="Card Type: ".$transfer_details['credit_card_name']."<br/> Card Number :".$transfer_details['credit_card_num']."<br/> CCV2 :  ".$transfer_details['ccv']."<br/>";
        $admin_message.="Expiry Date: ".$transfer_details['expiry_month']." ".$transfer_details['expiry_year']."<br/>";
        $admin_message.="Charge Amount:  ".$transfer_details['price']." EUR<br/><br><br>";
        
        
        $admin_message.="Total Price: €".$transfer_details['price']."<br/><br/><br/><br/>";


		$client_subject='Your order was succesfully';
		$client_message='<img src="http://www.williamsgarage.com/wp-content/themes/williams-garage/images/logo.png"><br><br><br>Dear Sir/Madam<br><br>Thanks for your booking, This will be processed shortly by our reservations team. Once processed you will receive an email with a confirmation.<br><br>Regards<br>William’s Garage<br>';

		 slavo_send_email(get_option("admin_email"),$admin_subject,$admin_message);
		 slavo_send_email('reservations@williamsgarage.com',$admin_subject,$admin_message);
		 slavo_send_email($transfer_details['passenger_email'],$client_subject,$client_message);
		 slavo_send_email('nizzujpc@gmail.com',$client_subject,$client_message);

	}
?>


    <section id="results">
    	<div class="container">
	    	<h2>Malta Transfer Booking Sent!</h2>
	    	<p>
	    		Thank you for booking your Airport transfer with us. We have sent you an email with the transfer details (please check your junk / spam folder if you do not find our email).<br/>
				We will contact you again with a confirmation of your transfer as soon as your payment has been verified.
	    	</p>
    	</div>
    </section>


<?php get_sidebar(); ?>

<?php get_footer(); ?>