<?php 
/**
 * footer.php
 *
 * The template for displaying the footer.
 */
?>
    <div class="container content simple-steps">
        <div class="container content">
            <div class="col-md-4">
                 <img src="<?php bloginfo('template_url'); ?>/images/icon-1.png">
                <h3>Location</h3>
                <p>Choose your desired location</p>
            </div>

            <div class="col-md-4">
                <img src="<?php bloginfo('template_url'); ?>/images/icon-2.png">
                <h3>Save Time &amp; Money</h3>
                <p>Easily create your trip online from everywhere</p>
            </div>

            <div class="col-md-4">
                <img src="<?php bloginfo('template_url'); ?>/images/icon-3.png">
                <h3>Pay Online</h3>
                <p>Pay online and enjoy your trip</p>
            </div>
        </div>
    </div>

	<!-- FOOTER -->
	<footer class="site-footer dark">
		<div class="container">
            
			<?php get_sidebar( 'footerOne' ); ?>
            <?php get_sidebar( 'footerTwo' ); ?>
            <?php get_sidebar( 'footerThree' ); ?>
            <?php get_sidebar( 'footerFour' ); ?>

			<div class="col-md-4 contact-details">
					<?php get_sidebar( 'footerFive' ); ?>
			</div> <!-- end copyright -->
		</div> <!-- end container -->
        <div class="row footer-copyright">
            <div class="container">
                <div class="col-md-10">Copyright 2014 Williams Garage. Web Design & Development by jeanpaulciantar.com</div>
                <div class="col-md-2">
                    <a href="http://www.jeanpaulciantar.com" target="_blank" class="jp"></a>
                </div>
            </div>
        </div>
	</footer> <!-- end site-footer -->
	<?php wp_footer(); ?>
</body>
</html>