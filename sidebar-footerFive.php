<?php 
/**
 * sidebar-footerFive.php
 *
 * The footer Column 4
 */
?>

<?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
		<div class="col-md-12">
			<?php dynamic_sidebar( 'sidebar-7' ); ?>
	   </div> <!-- end row -->
<?php endif; ?>