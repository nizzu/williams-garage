<?php 
/**
 * sidebar-footerTwo.php
 *
 * The footer Column 2
 */
?>

<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div class="col-md-2">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
	   </div> <!-- end row -->
<?php endif; ?>