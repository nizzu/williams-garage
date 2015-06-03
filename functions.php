<?php 
error_reporting(0);
/**
 * functions.php
 *
 * The theme's functions and definitions.
 */

/**
 * ----------------------------------------------------------------------------------------
 * 1.0 - Define constants.
 * ----------------------------------------------------------------------------------------
 */
define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/images' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'FRAMEWORK', get_template_directory() . '/framework' );


/**
 * ----------------------------------------------------------------------------------------
 * 2.0 - Load the framework.
 * ----------------------------------------------------------------------------------------
 */
require_once( FRAMEWORK . '/init.php' );


/**
 * ----------------------------------------------------------------------------------------
 * 3.0 - Set up the content width value based on the theme's design.
 * ----------------------------------------------------------------------------------------
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}


/**
 * ----------------------------------------------------------------------------------------
 * 4.0 - Set up theme default and register various supported features.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'alpha_setup' ) ) {
	function alpha_setup() {
		/**
		 * Make the theme available for translation.
		 */
		$lang_dir = THEMEROOT . '/languages';
		load_theme_textdomain( 'alpha', $lang_dir );

		/**
		 * Add support for post formats.
		 */
		add_theme_support( 'post-formats',
			array(
				'gallery',
				'link',
				'image',
				'quote',
				'video',
				'audio'
			)
		);

		/**
		 * Add support for automatic feed links.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add support for post thumbnails.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'alpha' )
			)
		);
	}

	add_action( 'after_setup_theme', 'alpha_setup' );
}


/**
 * ----------------------------------------------------------------------------------------
 * 5.0 - Display meta information for a specific post.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'alpha_post_meta' ) ) {
	function alpha_post_meta() {
		echo '<ul class="list-inline entry-meta">';

		if ( get_post_type() === 'post' ) {
			// If the post is sticky, mark it.
			if ( is_sticky() ) {
				echo '<li class="meta-featured-post"><i class="fa fa-thumb-tack"></i> ' . __( 'Sticky', 'alpha' ) . ' </li>';
			}

			// Get the post author.
			printf(
				'<li class="meta-author"><a href="%1$s" rel="author">%2$s</a></li>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);

			// Get the date.
			echo '<li class="meta-date"> ' . get_the_date() . ' </li>';

			// The categories.
			$category_list = get_the_category_list( ', ' );
			if ( $category_list ) {
				echo '<li class="meta-categories"> ' . $category_list . ' </li>';
			}

			// The tags.
			$tag_list = get_the_tag_list( '', ', ' );
			if ( $tag_list ) {
				echo '<li class="meta-tags"> ' . $tag_list . ' </li>';
			}

			// Comments link.
			if ( comments_open() ) :
				echo '<li>';
				echo '<span class="meta-reply">';
				comments_popup_link( __( 'Leave a comment', 'alpha' ), __( 'One comment so far', 'alpha' ), __( 'View all % comments', 'alpha' ) );
				echo '</span>';
				echo '</li>';
			endif;

			// Edit link.
			if ( is_user_logged_in() ) {
				echo '<li>';
				edit_post_link( __( 'Edit', 'alpha' ), '<span class="meta-edit">', '</span>' );
				echo '</li>';
			}
		}
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * 6.0 - Display navigation to the next/previous set of posts.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'alpha_paging_nav' ) ) {
	function alpha_paging_nav() { ?>
		<ul>
			<?php 
				if ( get_previous_posts_link() ) : ?>
				<li class="next">
					<?php previous_posts_link( __( 'Newer Posts &rarr;', 'alpha' ) ); ?>
				</li>
				<?php endif;
			 ?>
			<?php 
				if ( get_next_posts_link() ) : ?>
				<li class="previous">
					<?php next_posts_link( __( '&larr; Older Posts', 'alpha' ) ); ?>
				</li>
				<?php endif;
			 ?>
		</ul> <?php
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * 7.0 - Register the widget areas.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'alpha_widget_init' ) ) {
	function alpha_widget_init() {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name' => __( 'Main Widget Area', 'alpha' ),
					'id' => 'sidebar-1',
					'description' => __( 'Appears on posts and pages.', 'alpha' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				)
			);

			register_sidebar(
				array(
					'name' => __( 'footer', 'alpha' ),
					'id' => 'sidebar-2',
					'description' => __( 'Appears on the footer.', 'alpha' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				)
			);
            register_sidebar(
				array(
					'name' => __( 'footerOne', 'alpha' ),
					'id' => 'sidebar-3',
					'description' => __( 'Footer Column 1', 'alpha' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				)
			);
            register_sidebar(
				array(
					'name' => __( 'footerTwo', 'alpha' ),
					'id' => 'sidebar-4',
					'description' => __( 'Footer Column 2', 'alpha' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				)
			);
            register_sidebar(
				array(
					'name' => __( 'footerThree', 'alpha' ),
					'id' => 'sidebar-5',
					'description' => __( 'Footer Column 3', 'alpha' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				)
			);
            register_sidebar(
				array(
					'name' => __( 'footerFour', 'alpha' ),
					'id' => 'sidebar-6',
					'description' => __( 'Footer Column 4', 'alpha' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				)
			);
            register_sidebar(
				array(
					'name' => __( 'footerFive', 'alpha' ),
					'id' => 'sidebar-7',
					'description' => __( 'Footer Column 5', 'alpha' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				)
			);
		}
	}

	add_action( 'widgets_init', 'alpha_widget_init' );
}

/**
 * ----------------------------------------------------------------------------------------
 * 8.0 - Function that validates a field's length.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'alpha_validate_length' ) ) {
	function alpha_validate_length( $fieldValue, $minLength ) {
		// First, remove trailing and leading whitespace
		return ( strlen( trim( $fieldValue ) ) > $minLength );
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * 9.0 - Include the generated CSS in the page header.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'alpha_load_wp_head' ) ) {
	function alpha_load_wp_head() {
		// Get the logos
		$logo = IMAGES . '/logo.png';
		$logo_retina = IMAGES . '/logo@2x.png';

		$logo_size = getimagesize( $logo );
		?>
		
		<!-- Logo CSS -->
		<style type="text/css">
			.site-logo a {
				background: transparent url( <?php echo $logo; ?> ) 0 0 no-repeat;
				width: <?php echo $logo_size[0] ?>px;
				height: <?php echo $logo_size[1] ?>px;
				display: inline-block;
			}

			@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
			only screen and (-moz-min-device-pixel-ratio: 1.5),
			only screen and (-o-min-device-pixel-ratio: 3/2),
			only screen and (min-device-pixel-ratio: 1.5) {
				.site-logo a {
					background: transparent url( <?php echo $logo_retina; ?> ) 0 0 no-repeat;
					background-size: <?php echo $logo_size[0]; ?>px <?php echo $logo_size[1]; ?>px;
				}
			}
		</style>

		<?php
	}

	add_action( 'wp_head', 'alpha_load_wp_head' );
}

/**
 * ----------------------------------------------------------------------------------------
 * 10.0 - Load the custom scripts for the theme.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'alpha_scripts' ) ) {
	function alpha_scripts() {
		// Adds support for pages with threaded comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Register scripts
		wp_register_script( 'bootstrap-js', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'alpha-custom', SCRIPTS . '/scripts.js', array( 'jquery' ), false, true );

		// Load the custom scripts
		wp_enqueue_script( 'bootstrap-js' );
		wp_enqueue_script( 'alpha-custom' );

		// Load the stylesheets
		wp_enqueue_style( 'font-awesome', THEMEROOT . '/css/font-awesome.min.css' );
		wp_enqueue_style( 'alpha-master', THEMEROOT . '/css/master.css' );
	}

	add_action( 'wp_enqueue_scripts', 'alpha_scripts' );
}


/** Creating Transfers Custom posts **/

function transfers_post_type() {

    $labels = array(
        'name'                =>  'Bookings', 'Bookings', 
        'singular_name'       => 'Booking', 'Booking', 
        'menu_name'           =>  'Bookings', 
        'all_items'           =>  'All Bookings', 
        'view_item'           =>  'View Booking', 
        'add_new_item'        =>  'Add New Booking', 
        'add_new'             =>  'Add New Booking', 
        'edit_item'           =>  'Edit Booking', 
        'update_item'         =>  'Update Booking', 
        'search_items'        =>  'Search Booking', 
        'not_found'           =>  'No Bookings found', 
        'not_found_in_trash'  =>  'No Bookings found in Trash', 
    );
    $args = array(
        'label'               =>  'transfers', 
        'description'         =>  'Here you should found transfers created by users ', 
        'labels'              => $labels,
        'supports'            => array('title'),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'transfers', $args );
}
// Hook into the 'init' action
add_action( 'init', 'transfers_post_type', 0 );

/************** Creating meta box **************/
add_action( 'add_meta_boxes', 'add_options_locations' );
function add_options_locations()
{
    add_meta_box( 'options-locations-id', 'locations Options', 'display_options_location', 'transfers', 'normal', 'high' );
}
function display_options_location( $post )
{
    $values = get_post_custom( $post->ID );
    $arrival = isset( $values['arrival'] ) ? esc_attr( $values['arrival'][0] ) : "";
    $departure = isset( $values['departure'] ) ? esc_attr( $values['departure'][0] ) : "";
    $extra_stop = isset( $values['extra_stop'] ) ? esc_attr( $values['extra_stop'][0] ) : "";
    $arrival_date = isset( $values['arrival_date'] ) ? esc_attr( $values['arrival_date'][0] ) : "";
    $type = isset( $values['type'] ) ? esc_attr( $values['type'][0] ) : "";
    $price = isset( $values['price'] ) ? esc_attr( $values['price'][0] ) : "";
    $passenger_name = isset( $values['passenger_name'] ) ? esc_attr( $values['passenger_name'][0] ) : "";
    $passenger_phone = isset( $values['passenger_phone'] ) ? esc_attr( $values['passenger_phone'][0] ) : "";
    $passenger_email = isset( $values['passenger_email'] ) ? esc_attr( $values['passenger_email'][0] ) : "";
    $passenger_address = isset( $values['passenger_address'] ) ? esc_attr( $values['passenger_address'][0] ) : "";
    $passenger_name = isset( $values['passenger_name'] ) ? esc_attr( $values['passenger_name'][0] ) : "";
    $arrival_time = isset( $values['arrival_time'] ) ? esc_attr( $values['arrival_time'][0] ) : "";
    $arrival_flight = isset( $values['arrival_flight'] ) ? esc_attr( $values['arrival_flight'][0] ) : "";
    $departure_time = isset( $values['departure_time'] ) ? esc_attr( $values['departure_time'][0] ) : "";
    $departure_flight = isset( $values['departure_flight'] ) ? esc_attr( $values['departure_flight'][0] ) : "";
    $holy_add = isset( $values['holy_add'] ) ? esc_attr( $values['holy_add'][0] ) : "";
    $extra_service = isset( $values['extra_service'] ) ? esc_attr( $values['extra_service'][0] ) : "";
    $credit_card_name = isset( $values['credit_card_name'] ) ? esc_attr( $values['credit_card_name'][0] ) : "";
    $card_type = isset( $values['card_type'] ) ? esc_attr( $values['card_type'][0] ) : "";
    $credit_card_num = isset( $values['credit_card_num'] ) ? esc_attr( $values['credit_card_num'][0] ) : "";
    $ccv = isset( $values['ccv'] ) ? esc_attr( $values['ccv'][0] ) : "";
    $payment_status = isset( $values['payment_status'] ) ? esc_attr( $values['payment_status'][0] ) : "";
    $return_trip = isset( $values['return_trip'] ) ? esc_attr( $values['return_trip'][0] ) : "";
    ?>
    <p class="floated">
        <label for="payment_status">Transfer Reference</label>
        <input type="text" disabled value="#000<?php echo $post->ID; ?>">
    </p>
	<p style="margin:auto;width:50%;">
        <label for="payment_status">Payment Status</label>
        <Select name="payment_status" id="payment_status" >
        	<option value="0">Pending</option>
        	<option value="1"  <?php if($payment_status==1)echo "Selected"  ?>>Completed</option>
        	<option value="2"  <?php if($payment_status==2)echo "Denied"  ?>>Cancel this booking</option>
        </select>
    </p>
    <?php if (isset($arrival)&&$arrival!=''): ?>
	    <p class="floated">
	        <label for="arrival">Arrival</label>
	        <input type="text" name="arrival" id="arrival" value="<?php echo $arrival; ?>" />
	    </p>
    <?php endif ?>

    <?php if (isset($departure)&&$departure!=''): ?>
	    <p class="floated">
	        <label for="departure">Departure</label>
	        <input type="text" name="departure" id="departure" value="<?php echo $departure; ?>" />
	    </p>
    <?php endif ?>

    <?php if (isset($extra_stop)&&$extra_stop!=''): ?>
	    <p class="floated">
	        <label for="extra_stop">Extra Stop</label>
	        <input type="text" name="extra_stop" id="extra_stop" value="<?php echo $extra_stop; ?>" />
	    </p>
    <?php endif ?>
   <?php if (isset($extra_service)&&$extra_service!=''): ?>
	    <p class="floated">
	        <label for="extra_service">Extra Stop</label>
	        <input type="text" name="extra_service" id="extra_service" value="<?php echo $extra_service; ?>" />
	    </p>
    <?php endif ?>

    <p class="floated">
        <label for="arrival_date">Arrival Date</label>
        <input type="text" name="arrival_date" id="arrival_date" value="<?php  echo $arrival_date; ?>" />
    </p>
    <p class="floated">
        <label for="type">Vehicle Type</label>
        <input type="text" name="type" id="type" value="<?php   echo $type; ?>" />
    </p>
    <p class="floated">
        <label for="type">Transfer price</label>
        <input type="text" name="price" id="price" value="<?php   echo $price; ?>" />
    </p>
    <p class="floated">
        <label for="passenger_name">Passenger Name</label>
        <input type="text" name="passenger_name" id="passenger_name" value="<?php   echo $passenger_name; ?>" />
    </p>
    <p class="floated">
        <label for="passenger_phone">Passenger Phone</label>
        <input type="text" name="passenger_phone" id="passenger_phone" value="<?php   echo $passenger_phone; ?>" />
    </p>
    <p class="floated">
        <label for="passenger_email">Passenger Email</label>
        <input type="text" name="passenger_email" id="passenger_email" value="<?php   echo $passenger_email; ?>" />
    </p>
    <p class="floated">
        <label for="passenger_address">Passenger Address</label>
        <input type="text" name="passenger_address" id="passenger_address" value="<?php   echo $passenger_address; ?>" />
    </p>
    <?php if (isset($return_trip)&&$return_trip!=''): ?>
	    <p class="floated">
	        <label for="return_trip">Return Trip</label>
	        <input type="text" name="return_trip" id="return_trip" value="<?php   echo $return_trip; ?>" />
	    </p>
    <?php endif; ?>
    <?php if (isset($arrival_time)&&$arrival_time!=''): ?>
	    <p class="floated">
	        <label for="arrival_time">Arrival Time</label>
	        <input type="text" name="arrival_time" id="arrival_time" value="<?php   echo $arrival_time; ?>" />
	    </p>
	    <p class="floated">
	        <label for="arrival_flight">Arrival Flight #</label>
	        <input type="text" name="arrival_flight" id="arrival_flight" value="<?php   echo $arrival_flight; ?>" />
	    </p>
    <?php endif; ?>
    <?php if (isset($departure_time)&&$departure_time!=''): ?>
	    <p class="floated">
	        <label for="departure_time">Departure Time</label>
	        <input type="text" name="departure_time" id="departure_time" value="<?php   echo $departure_time; ?>" />
	    </p>
	    <p class="floated">
	        <label for="departure_flight">Departure Flight #</label>
	        <input type="text" name="departure_flight" id="departure_flight" value="<?php   echo $departure_flight; ?>" />
	    </p>
    <?php endif; ?>
    <p class="floated">
        <label for="holy_add">Holiday Address</label>
        <input type="text" name="holy_add" id="holy_add" value="<?php   echo $holy_add; ?>" />
    </p>
    <p class="floated">
        <label for="credit_card_name">Credit Card Name</label>
        <input type="text" name="credit_card_name" id="credit_card_name" value="<?php   echo $credit_card_name; ?>" />
    </p>
    <p class="floated">
        <label for="card_type">Card Type</label>
        <input type="text" name="card_type" id="card_type" value="<?php   echo $card_type; ?>" />
    </p>
    <p class="floated">
        <label for="credit_card_num">Credit Card Number</label>
        <input type="text" name="credit_card_num" id="credit_card_num" value="<?php   echo $credit_card_num; ?>" />
    </p>
    <p class="floated">
        <label for="ccv">CCV</label>
        <input type="text" name="ccv" id="ccv" value="<?php   echo $ccv; ?>" />
    </p>
    <p class="clearfix"></p>
    <style type="text/css"> label{display: block;}.floated{float:left;width: 50%;}.clearfix{clear:both;}</style>
 <?php        
}
add_action( 'save_post', 'save_potions_locations' );
function save_potions_locations( $post_id )
{
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    if( !current_user_can( 'edit_post' ) ) return;
     
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    if( isset( $_POST['arrival'] ) )
        update_post_meta( $post_id, 'arrival', esc_attr( $_POST['arrival'] ) );
    if( isset( $_POST['pickup_time'] ) )
        update_post_meta( $post_id, 'pickup_time', esc_attr( $_POST['pickup_time'] ) );
    if( isset( $_POST['payment_status'] ) ){
    	$passenger_email=get_post_meta($post_id,'passenger_email');
    	$passenger_email=$passenger_email[0];
    	if($_POST['payment_status']==1){
    		$completed=get_post_meta($post_id,'completed');
    		if(!isset($completed[0])){
    			$message="<img src='http://www.williamsgarage.com/wp-content/themes/williams-garage/images/logo.png'/><br/><br/><br/>Dear Sir / Madam<br/><br/>I confirm your transfers.<br/><br/>A driver from William's Garage will greet you at the airport with a sign bearing your name. Just in case you don't meet your driver, please phone on 00356 99496047 / 00356 99496048.<br/><br/>Thanks for using our services.<br/>William’s Garage";
    			slavo_send_email($passenger_email,"Booking Confirmed",$message,'Support Williams Garage' );
		        update_post_meta( $post_id, 'completed', 'yes' ) ;
    		}
    	}
		else if($_POST['payment_status']==2){
    		$canceled=get_post_meta($post_id,'canceled');
    		if(!isset($canceled[0])){
    			$message="<img src='http://www.williamsgarage.com/wp-content/themes/williams-garage/images/logo.png'/><br/><br/><br/>Dear Sir / Madam<br/><br/>Your booking has been denied/cancelled for one of the following reasons<br/><br/><ul><li>Credit Card Details provided are incorrect</li><li>Your booking was received late and there wasn’t processed on time</li></ul><br/>You are kindly requested to make a new booking by clicking on this link <a href='www.williamsgarage.com'>www.williamsgarage.com</a> or contact our reservations team on <a href='mailto:reservations@williamsgarage.com'>reservations@williamsgarage.com</a> for further clarification.<br/><br/>Regards<br/>William’s Garage";
    			slavo_send_email($passenger_email,"Booking Denied",$message,'Support Williams Garage' );
		        update_post_meta( $post_id, 'canceled', 'yes' );
			}
		}
        update_post_meta( $post_id, 'payment_status', esc_attr( $_POST['payment_status'] ) );
    }
     
    if( isset( $_POST['departure'] ) )
        update_post_meta( $post_id, 'departure', wp_kses( $_POST['departure'], $allowed ) );
         
    if( isset( $_POST['extra_stop'] ) )
        update_post_meta( $post_id, 'extra_stop', esc_attr( $_POST['extra_stop'] ) );
    if( isset( $_POST['type'] ) )
        update_post_meta( $post_id, 'type', esc_attr( $_POST['type'] ) );

    if( isset( $_POST['arrival_date'] ) )
        update_post_meta( $post_id, 'arrival_date', esc_attr( $_POST['arrival_date'] ) );
    if( isset( $_POST['passenger_name'] ) )
        update_post_meta( $post_id, 'passenger_name', esc_attr( $_POST['passenger_name'] ) );
    if( isset( $_POST['passenger_phone'] ) )
        update_post_meta( $post_id, 'passenger_phone', esc_attr( $_POST['passenger_phone'] ) );
    if( isset( $_POST['passenger_email'] ) )
        update_post_meta( $post_id, 'passenger_email', esc_attr( $_POST['passenger_email'] ) );
    if( isset( $_POST['passenger_address'] ) )
        update_post_meta( $post_id, 'passenger_address', esc_attr( $_POST['passenger_address'] ) );
    if( isset( $_POST['arrival_time'] ) )
        update_post_meta( $post_id, 'arrival_time', esc_attr( $_POST['arrival_time'] ) );
    if( isset( $_POST['arrival_flight'] ) )
        update_post_meta( $post_id, 'arrival_flight', esc_attr( $_POST['arrival_flight'] ) );
    if( isset( $_POST['departure_time'] ) )
        update_post_meta( $post_id, 'departure_time', esc_attr( $_POST['departure_time'] ) );
    if( isset( $_POST['departure_flight'] ) )
        update_post_meta( $post_id, 'departure_flight', esc_attr( $_POST['departure_flight'] ) );
    if( isset( $_POST['holy_add'] ) )
        update_post_meta( $post_id, 'holy_add', esc_attr( $_POST['holy_add'] ) );
    if( isset( $_POST['credit_card_name'] ) )
        update_post_meta( $post_id, 'credit_card_name', esc_attr( $_POST['credit_card_name'] ) );
    if( isset( $_POST['card_type'] ) )
        update_post_meta( $post_id, 'card_type', esc_attr( $_POST['card_type'] ) );
    if( isset( $_POST['credit_card_num'] ) )
        update_post_meta( $post_id, 'credit_card_num', esc_attr( $_POST['credit_card_num'] ) );
    if( isset( $_POST['ccv'] ) )
        update_post_meta( $post_id, 'ccv', esc_attr( $_POST['ccv'] ) );
    if( isset( $_POST['service'] ) )
        update_post_meta( $post_id, 'service', esc_attr( $_POST['service'] ) );
    if( isset( $_POST['extra_service'] ) )
        update_post_meta( $post_id, 'extra_service', esc_attr( $_POST['extra_service'] ) );
    if( isset( $_POST['return_trip'] ) )
        update_post_meta( $post_id, 'return_trip', esc_attr( $_POST['return_trip'] ) );
}
/************** Creating meta box **************/



/** adding transfers icon to wp-admin **/
function add_transfers_icon_backend(){
    ?>
    <style type="text/css">
    #menu-posts-transfers .wp-menu-image{
        background:transparent url("<?php bloginfo('stylesheet_directory'); ?>/images/transfers_icon.png") no-repeat 50% 50% !important;
        background-size: 85% 85%!important;
    }
    #menu-posts-transfers .dashicons-before:before {
        content: none!important;
    }
    </style>
    <?php 
}
add_action('admin_head','add_transfers_icon_backend');


/** Create Extra tables **/
function create_zones_table(){
	global $wpdb;
	$table_name = "zones";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$charset_collate = $wpdb->get_charset_collate();
		$wpdb->transfersTracker = "{$wpdb->prefix}$table_name";

		$sql = "CREATE TABLE $wpdb->prefix$table_name (
			zone_id bigint(20) NOT NULL AUTO_INCREMENT,
			zone_name varchar(150) NOT NULL ,
			standard bigint(150)  NOT NULL ,
			executive bigint(150)  NOT NULL ,
			seater7 bigint(150)  NOT NULL ,
			seater10 bigint(150)  NOT NULL ,
			seater16 bigint(150)  NOT NULL ,
			shuttle bigint(150)  NOT NULL ,
			UNIQUE KEY id (zone_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

	}// end of if table not exists
}
create_zones_table();

function create_locations_table(){
	global $wpdb;
	$table_name = "locations";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$charset_collate = $wpdb->get_charset_collate();
		$wpdb->transfersTracker = "{$wpdb->prefix}$table_name";

		$sql = "CREATE TABLE $wpdb->prefix$table_name (
			loc_id bigint(20) NOT NULL AUTO_INCREMENT,
			location_name varchar(150)  NOT NULL ,
			zone_num bigint(20)  NOT NULL ,
			UNIQUE KEY id (loc_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

	}// end of if table not exists
}
create_locations_table();

/** Adding transfers mangers **/

// Hook for adding admin menus
add_action('admin_menu', 'mt_add_pages');

// action function for above hook
function mt_add_pages() {

    add_menu_page(__('Manage Options','alpha'), __('Mange Options','alpha'), 'manage_options', 'mange-options', 'manage_option_page' );
}

function manage_option_page() {
	global $wpdb;

	/************************* MANAGING ZONES ************************/

	if($_POST['type']=='zones'){
		$max_num=$_POST['num_zones'];
		$zones=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."zones");
		$zones_found=array();
		foreach ($zones as $zone) {
			$zone_found[]=$zone->zone_name;
		}
		for ($i=1; $i <=$max_num ; $i++) { 
				$data=array(
					'zone_name'		=>$_POST['zone_name_'.$i],
					'standard'		=>$_POST['standard_'.$i],
					'executive'		=>$_POST['executive_'.$i],
					'seater7'		=>$_POST['seater7_'.$i],
					'seater10'		=>$_POST['seater10_'.$i],
					'seater16'		=>$_POST['seater16_'.$i],
					'shuttle'		=>$_POST['shuttle_'.$i],
					);
				if(!in_array($_POST['zone_id_'.$i], $zones_found)){
					if(!isset($_POST['zone_id_'.$i]))
						$wpdb->insert($wpdb->prefix."zones",$data);
					else{
						$where=array('zone_id'=>$_POST['zone_id_'.$i]);
						$wpdb->update($wpdb->prefix."zones",$data,$where);
					}
				}
				if(isset($_POST['zone_id_'.$i])&&$_POST['zone_name_'.$i]==''){
					$where['zone_id']=$_POST['zone_id_'.$i];
					$wpdb->delete($wpdb->prefix."zones",$where);
				}
		}
	}
    echo "<h2>" . __( 'Manage Zones', 'alpha' ) . "</h2>";
    echo "<hr>";
	if($_POST['type']=='zones')
		echo "<div class='updated'><p> Zones have been saved successfully !</p></div>";
    echo "<form id='zones_form' action='' method='post'>";
    echo "<input type='hidden' name='type' value='zones'>";
    $zones=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."zones");
    echo "<div class='inputs_container'>";
	    foreach ($zones as $key=> $zone) {
	    	$d_key=$key+1;
			    echo "
			    <div class='floated'>
			    	<input type='text' name='zone_name_$d_key' value='".$zone->zone_name."' placeholder='zone difference'>
			    	<input type='hidden' name='zone_id_$d_key' value='".$zone->zone_id."'>
			    </div>
			    <div class='floated'>
			    	<input type='text' placeholder='standard' name='standard_$d_key' value='".$zone->standard."'>
		    	</div>
			    <div class='floated'>
			    	<input type='text' placeholder='executive' name='executive_$d_key' value='".$zone->executive."'>
		    	</div>
			    <div class='floated'>
			    	<input type='text' placeholder='seater7' name='seater7_$d_key' value='".$zone->seater7."'>
		    	</div>
			    <div class='floated'>
			    	<input type='text' placeholder='seater10' name='seater10_$d_key' value='".$zone->seater10."'>
		    	</div>
			    <div class='floated'>
			    	<input type='text' placeholder='seater16' name='seater16_$d_key' value='".$zone->seater16."'>
		    	</div>
			    <div class='floated'>
			    	<input type='text' placeholder='shuttle' name='shuttle_$d_key' value='".$zone->shuttle."'>
		    	</div>
			<div class='clearfix'></div>";
	    }
	    echo "</div>"; // end of container
    echo "<input type='hidden' id='num_zones' name='num_zones' value='".sizeof($zones)."'>";
    echo "<input type='submit' value='Save' class='button'>";
    echo "<div class='add_zone button'>Add New Zone</div><p class='note'>To Delete a zone just clear its zone filed and save</p>";
    echo "</form>";
    echo "<style>.floated{float:left;min-width: 140px;text-align: center;}.lg_width{text-align:left;width:400px;}.clearfix{clear:both;}form#vehicles_form input {max-width: 135px;}.note{color:red;text-align:center}</style>";
	
	/************************* MANAGING ZONES ************************/
	
	if($_POST['type']=='locations'){
		$max_num=$_POST['num_locations'];
		$locations=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."locations");
		$locations_found=array();
		foreach ($locations as $location) {
			$location_found[]=$location->location_name;
		}
		for ($i=1; $i <=$max_num; $i++) { 
			$data=array(
				'location_name'	=>$_POST['loc_'.$i],
				'zone_num'		=>$_POST['zone_num_'.$i],
				);
			if(!in_array($_POST['loc_id_'.$i], $locations_found)){
				if(!isset($_POST['loc_id_'.$i]))
					$wpdb->insert($wpdb->prefix."locations",$data);
				else{
					$where=array('loc_id'=>$i);
					$wpdb->update($wpdb->prefix."locations",$data,$where);
				}
			}
			if(isset($_POST['loc_id_'.$i])&&$_POST['loc_id_'.$i]==''){
				$where['loc_id']=$_POST['loc_id_'.$i];
				$wpdb->delete($wpdb->prefix."locations",$where);
			}
		}
	}

    echo "<h2>" . __( 'Manage Locations', 'alpha' ) . "</h2>";
    echo "<hr>";
	if($_POST['type']=='locations')
		echo "<div class='updated'><p> Locations have been saved successfully !</p></div>";
    echo "<form id='locations_form' action='' method='post'>";
    echo "<input type='hidden' name='type' value='locations'>";
    $locations=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."locations");
    echo "<div class='inputs_container'>";
	    foreach ($locations as $key=> $location) {
	    	$d_key=$key+1;
		    echo "
		    <div class='floated'>
		    	<input type='text' name='loc_$d_key' value='".$location->location_name."' placeholder='Location $d_key'>
		    	<input type='hidden' name='loc_id_$d_key' value='".$location->loc_id."'>
		    </div>
		    <div class='floated'>
		    	<input type='text' name='zone_num_$d_key' value='".$location->zone_num."'>
			</div>
		<div class='clearfix'></div>";
	    }
	    echo "</div>"; // end of container
    echo "<input type='hidden' id='num_locations' name='num_locations' value='".sizeof($locations)."'>";
    echo "<input type='submit' value='Save' class='button'>";
    echo "<div class='add_location button'>Add New Location</div><p class='note'>To Delete a location just clear its location filed and save</p>";
    echo "</form>";
    echo "<style>.floated{float:left;min-width: 140px;text-align: center;}.lg_width{text-align:left;width:400px;}.clearfix{clear:both;}form#vehicles_form input {max-width: 135px;}.note{color:red;text-align:center}</style>";
    echo "<hr>";

	/************************* MANAGING Images ************************/
	if($_POST['type']=='images'){
		require_once( ABSPATH . 'wp-admin/includes/user.php');
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		$attachment_id = media_handle_upload( 'standard_image', 0 );
		if(!is_wp_error($attachment_id )){
			update_post_meta($attachment_id,'image_for','standard' );
			$src=wp_get_attachment_url( $attachment_id);
			update_option('standard',$src);
		}
		$attachment_id = media_handle_upload( 'executive_image', 0 );
		if(!is_wp_error($attachment_id )){
			update_post_meta($attachment_id,'image_for','executive' );
			$src=wp_get_attachment_url( $attachment_id);
			update_option('executive',$src);
		}
		$attachment_id = media_handle_upload( 'seater7_image', 0 );
		if(!is_wp_error($attachment_id )){
			update_post_meta($attachment_id,'image_for','seater7' );
			$src=wp_get_attachment_url( $attachment_id); 
			update_option('seater7',$src);
		}
		$attachment_id = media_handle_upload( 'seater10_image', 0 );
		if(!is_wp_error($attachment_id )){
			update_post_meta($attachment_id,'image_for','seater10' );
			$src=wp_get_attachment_url( $attachment_id);
			update_option('seater10',$src);
		}
		$attachment_id = media_handle_upload( 'seater16_image', 0 );
		if(!is_wp_error($attachment_id )){
			update_post_meta($attachment_id,'image_for','seater16' );
			$src=wp_get_attachment_url( $attachment_id);
			update_option('seater16',$src);
		}
		$attachment_id = media_handle_upload( 'shuttle_image', 0 );
		if(!is_wp_error($attachment_id )){
			update_post_meta($attachment_id,'image_for','shuttle' );
			$src=wp_get_attachment_url( $attachment_id);
			update_option('shuttle',$src);
		}
	}
	$standard=get_option('standard');
	$executive=get_option('executive');
	$seater7=get_option('seater7');
	$seater10=get_option('seater10');
	$seater16=get_option('seater16');
	$shuttle=get_option('shuttle');
	echo '<form method="post" action="#" enctype="multipart/form-data" style="margin-bottom:25px;">
		<input type="hidden" name="type" value="images"> 
		<div class="floated"><b>standard</b></div><div class="floated"><input type="file" name="standard_image"></div>';
		if($standard)
			echo '<div class="floated"><img src='.$standard.' style="max-width:100px;,max-height:100px;"></div>';
		echo '<div class="clearfix"></div>';
		echo '<div class="floated"><b>executive</b></div><div class="floated"><input type="file" name="executive_image"></div>';
		if($executive)
			echo '<div class="floated"><img src='.$executive.' style="max-width:100px;,max-height:100px;"></div>';
		echo '<div class="clearfix"></div>';
		echo '<div class="floated"><b>seater7</b></div><div class="floated"><input type="file" name="seater7_image"></div>';
		if($seater7)
			echo '<div class="floated"><img src='.$seater7.' style="max-width:100px;,max-height:100px;"></div>';
		echo '<div class="clearfix"></div>';
		echo '<div class="floated"><b>seater10</b></div><div class="floated"><input type="file" name="seater10_image"></div>';
		if($seater10)
			echo '<div class="floated"><img src='.$seater10.' style="max-width:100px;,max-height:100px;"></div>';
		echo '<div class="clearfix"></div>';
		echo '<div class="floated"><b>seater16</b></div><div class="floated"><input type="file" name="seater16_image"></div>';
		if($seater16)
			echo '<div class="floated"><img src='.$seater16.' style="max-width:100px;,max-height:100px;"></div>';
		echo '<div class="clearfix"></div>';
		echo '<div class="floated"><b>shuttle</b></div><div class="floated"><input type="file" name="shuttle_image"></div>';
		if($shuttle)
			echo '<div class="floated"><img src='.$shuttle.' style="max-width:100px;,max-height:100px;"></div>';
		echo '<div class="clearfix"></div>';
	echo '<input type="submit" value="Save Images" class="button"></form>';
    ?>
    <style type="text/css">
    #zones_form input[type='text']{
    	max-width: 150px;
    }
    #locations_form input[type='text']{
    	min-width: 250px;
    	text-align: center;
    }
    </style>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#locations_form .add_location').on('click',function(){
			var num=parseInt(jQuery('#num_locations').val());
			num+=1;
			jQuery(this).closest('form#locations_form').find('.inputs_container').append("<div class='floated'><input type='text' name='loc_"+num+"'  placeholder='Location "+num+"'></div><div class='floated'><input type='text' name='zone_num_"+num+"' placeholder='Zone Number' ></div><div class='clearfix'></div>");
			jQuery('#num_locations').val(num);
		});
		jQuery('#zones_form .add_zone').on('click',function(){
			var num=parseInt(jQuery('#num_zones').val());
			num+=1;
			jQuery(this).closest('form#zones_form').find('.inputs_container').append("<div class='floated'><input type='text' name='zone_name_"+num+"' placeholder='zone difference'></div><div class='floated'><input type='text' placeholder='standard' name='standard_"+num+"'></div><div class='floated'><input type='text' placeholder='executive' name='executive_"+num+"'></div><div class='floated'><input type='text' placeholder='seater7' name='seater7_"+num+"'></div><div class='floated'><input type='text' placeholder='seater10' name='seater10_"+num+"'></div><div class='floated'><input type='text' placeholder='seater16' name='seater16_"+num+"'></div><div class='floated'><input type='text' placeholder='shuttle' name='shuttle_"+num+"'></div><div class='clearfix'></div>");
		    jQuery('#num_zones').val(num);
		});
	});
	</script>
    <?php
}

function get_locations(){
	global $wpdb;
	$locations=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."locations");
	foreach ($locations as $location) {
		echo "<option value='$location->location_name'>$location->location_name</option>";
	}
}

/** Create Thanks Page **/
function create_thanks_page(){
	$args=array(
		'post_type'			=>'page',
		'post_title'		=>'booking-confirmed',
		'post_content'		=>'',
		'post_status'		=>'publish',
		'post_name'			=>'booking-confirmed',
		'page_template'		=>'',
		);
	$exist=get_page_by_title('booking-confirmed');
	if(!$exist)
		wp_insert_post($args );
	
	$args=array(
		'post_type'			=>'page',
		'post_title'		=>'find-service',
		'post_content'		=>'',
		'post_status'		=>'publish',
		'post_name'			=>'find-service',
		'page_template'		=>'',
		);
	$exist=get_page_by_title('find-service');
	if(!$exist)
		wp_insert_post($args );

}
add_action('init','create_thanks_page');


// ADD NEW COLUMN
function sl_column_head($defaults) {
	unset(
		$defaults['date']
	);
	$new_columns = array(
		'Ref'				=> __('Ref', 'alpha'),
		'Client Name'		=> __('Client Name', 'alpha'),
		'Client Email' 		=> __('Client Email', 'alpha'),
		'Payment Method' 	=> __('Payment Method', 'alpha'),
		'Payment Status'	=> __('Payment Status', 'alpha'),
	);
    return array_merge($defaults, $new_columns);
}
 
// SHOW THE FEATURED IMAGE
function sl_column_content($column_name, $post_ID) {
    if ($column_name == 'Ref') {
        echo $post_ID;
    }
    if ($column_name == 'Client Name') {
		$custom=get_post_meta($post_ID);
        echo $custom['passenger_name'][0];
    }
    if ($column_name == 'Client Email') {
		$custom=get_post_meta($post_ID);
        echo $custom['passenger_email'][0];
    }
    if ($column_name == 'Payment Method') {
        echo 'Credit Card';
    }
    if ($column_name == 'Payment Status') {
		$custom=get_post_meta($post_ID);
    	if(isset($custom['payment_status'][0])&&$custom['payment_status'][0]==1)
    		echo "<span style='color:#00A700'>Completed</span>";
    	else
    		echo "<span style='color:#F00'>Pending</span>";
    }
}
add_filter('manage_transfers_posts_columns', 'sl_column_head');
add_action('manage_transfers_posts_custom_column', 'sl_column_content', 10,2);

/*** ** Send mail function ** ***/
function slavo_send_email ($recipients, $subject = '', $message = '',$sender_name='Support Williams Garage (no reply)',$sender_email='reservations@williamsgarage.com'){
	$message = stripslashes($message);
	$subject = stripslashes($subject); 

	$email_name_from  = $sender_name;
	$email_addr_from  = $sender_email;
	    
	$headers = 'From: '. $email_name_from .' <'. $email_addr_from .'>' . PHP_EOL;
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: " . get_bloginfo('html_type') . "; charset=\"". get_bloginfo('charset') . "\"\n";
	$mailtext = "<html><head><title>" . $subject . "</title></head><body>" . nl2br($message) . "</body></html>";
	return wp_mail($recipients, $subject, $mailtext, $headers);
}
function get_api_key(){return "AIzaSyAHNPvfRJhsBujIqEYGPeZscxFcqDnzE90";}
function get_lat_long($location,$api_key){
	$response=array();
	$location=urlencode($location);
	$location='https://maps.googleapis.com/maps/api/geocode/json?address='.$location.'&sensor=false&components=country:MT&key='.$api_key;
	$details=json_decode(curl_get_file_contents($location));
	
	$return->lat=$details->results[0]->geometry->location->lat;
	$return->long=$details->results[0]->geometry->location->lng;
	return $return;
}

function curl_get_file_contents($URL) {
	$c = curl_init();
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_URL, $URL);
	curl_setopt($c,CURLOPT_SSL_VERIFYPEER, false);
	$contents = curl_exec($c);
	$err  = curl_getinfo($c,CURLINFO_HTTP_CODE);
	curl_close($c);
	if ($contents) return $contents;
	else return false;
}