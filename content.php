<?php 
/**
 * content.php
 *
 * The default template for displaying content.
 */
?>
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
			<h1><?php the_title(); ?></h1>
		<?php else : ?>
            <div class="item">
			<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
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