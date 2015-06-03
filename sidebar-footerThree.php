<?php 
/**
 * sidebar-footerThree.php
 *
 * The footer Column 3
 */
?>

<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
		<div class="col-md-2">
			<?php dynamic_sidebar( 'sidebar-5' ); ?>
	   </div> <!-- end row -->
<?php endif; ?>