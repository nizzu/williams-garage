<?php 
/**
 * template-home.php
 *
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>

<div class="col-md-4" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    
        
        <?php
		// If the post has a thumbnail and it's not password protected
		// then display the thumbnail
		if ( has_post_thumbnail() && ! post_password_required() ) : ?>
        <a href="<?php echo get_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
        </a>
		<?php endif;
        
		// If single page, display the title
		// Else, we display the title in a link
		if ( is_single() ) : ?>
		<?php else : ?>
            <div class="item">
		<?php endif; ?>

	<!-- Article content -->
	<div class="entry-content">
		<?php
			if ( is_search() ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading &rarr;', 'alpha' ) );

				wp_link_pages();
			}
		?>
	</div> <!-- end entry-content -->
    </div>

	<p>
		<?php 
			// If we have a single page and the author bio exists, display it
			if ( is_single() && get_the_author_meta( 'description' ) ) {
				echo '<h2>' . __( 'Written by ', 'alpha' ) . get_the_author() . '</h2>';
				echo '<p>' . the_author_meta( 'description' ) . '</p>';
			}
		?>
	</p>
        
</div>

<?php echo do_shortcode( putRevSlider("homepage")) ?> <!-- Main Banner Slider -->
    
    <!-- Booking Form -->
    <div class="row dark">
        <div class="container content bookTaxi">
            <h1>Book a Taxi in Malta</h1>
            <p>William's Garage You can book your taxi in three easy steps secure your taxi
from wherever you are!</p>
        <?php 
        $find_service=get_page_by_title('find-service');
        $find_service=get_permalink($find_service->ID);
         ?>
        <form class="firstForm bookingForm" action="<?php echo $find_service ?>" method="post">
            <div class="first_step">
                <div class="col-md-6">
                    <select id="arrival" name="arrival">
                        <option selected disabled>From</option>
                        <?php get_locations(); ?>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="col-md-6">
                    <select id="departure" name="departure">
                        <option selected disabled>To</option>
                        <?php get_locations(); ?>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="col-md-6">
                    <input type="text" id="arrival-date" name="arrival_date" readonly class="date datepicker">
                </div>
                <div class="col-md-6">
                    <input type="text" id="pickup-time" name="arrival_time" placeholder="Pickup time : HH:MM">
                </div>
                <div class="col-md-6 departure_date_container">
                    <input type="text" id="departure-date" name="departure_date" readonly class="date datepicker">
                </div>
                <div class="col-md-6 departure_date_container">
                    <input type="text" id="departure-time" name="departure_time"  placeholder="Return Pickup time : HH:MM">
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <div id="return_button" class="input_style">
                        <div class="return_container">
                            <div class="pull-left checked"><div class='check_button'></div></div>
                           <div class="pull-left text_container"> Return</div> 
                           <input type='hidden' name="return_trip" value='no' id="return_trip">
                           <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
<!--                 <div class="col-md-6">
                    <select name="extra_stop" id="extra_stop">
                        <option selected disabled>Extra Stop</option>
                        <?php get_locations(); ?>
                    </select>
                    <span class="arrow"></span>
                </div> -->
                <div class="col-md-6">
                    <select name="num_persons" id="num_persons">
                        <option selected disabled required>Number of Persons</option>
                        <?php for ($i=1;$i<=20;$i++): ?>
                            <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
<!--
                    <select name="service" id="service">
                        <option disabled selected>Select Service</option>
                        <option value="Private">Private</option>
                        <option value="Executive">Executive</option>
                        <option value="Shared">Shared</option>
                        <option value="Ambi lift van (Wheelchair Case)">Ambi lift van (Wheelchair Case)</option>
                    </select>
-->
<!--                    <span class="arrow"></span>-->
                    
                    <select name="extra_service" id="extra_service">
                        <option disabled selected>Extra Service</option>
                        <option value="Baby Seat (+ 4 euro)">Baby Seat (+ 4 euro)</option>
                        <option value="Booster Seat (+ 4 euro)">Booster Seat (+ 4 euro)</option>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="col-md-6">
                    <input type="submit" id="first_step_button" class="sub_button" value="Book Now">
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                        
                </div>
                <div class="clearfix"></div>
            </div><!-- close of first step -->
            <div class="clearfix"></div>
        </form>
        </div>
    </div>


	<!-- Low Cost Section -->
    <div class="row light">
        <div class="container content" style="padding-bottom: 0;">
            <div class="">
                <h1>Low Cost Airport Transfers</h1>
                <h2 class="seo">
                    An affordable & value for money rate covering all Hotels in Malta.
                </h2>
            </div>
            <?php 

            $args=array(
                'post_status'       =>'publish',
                'posts_per_page'    =>-1,
                'post_type'         =>'post',
                );
            $three_posts=get_posts($args);
            foreach ($three_posts as $single_post) :
            ?>    
                <div class="low-cost">
                    <div class="col-md-4">
                            <div class="image_container">
                                <?php echo get_the_post_thumbnail($single_post->ID); ?>
                            </div>
                        <div class="item">
                            <h2><?php echo $single_post->post_title; ?></h2>
                            <p><?php echo $single_post->post_content; ?></p>
                        </div>
                    </div>
                </div>    
            <?php endforeach; ?>
    </div>   
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>