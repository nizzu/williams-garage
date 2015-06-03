<?php 
/**
 * sidebar-footerFour.php
 *
 * The footer Column 4
 */
?>

<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
		<div class="col-md-2">
			<?php dynamic_sidebar( 'sidebar-6' ); ?>
	   </div> <!-- end row -->
<?php endif; ?>