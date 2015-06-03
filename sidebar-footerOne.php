<?php 
/**
 * sidebar-footerOne.php
 *
 * The footer Column 1 
 */
?>

<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div class="col-md-2">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
	   </div> <!-- end row -->
<?php endif; ?>