<?php 
/**
 * template-tours.php
 *
 * Template Name: Tours
 */
?>

<?php get_header(); ?>

<?php echo do_shortcode( putRevSlider("tours")) ?> <!-- Main Banner Slider -->
    
<div class="row light">
	<div class="main-content col-md-12" role="main">
		<?php while( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!-- Article header -->
				<header class="entry-header"> <?php
					// If the post has a thumbnail and it's not password protected
					// then display the thumbnail
					if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
					<?php endif; ?>
				</header> <!-- end entry-header -->

				<!-- Article content -->
				<div class="container">
					<?php the_content(); ?>

					<?php wp_link_pages(); ?>
				</div> <!-- end entry-content -->

				<!-- Article footer -->
				<footer class="entry-footer">
					<?php 
						if ( is_user_logged_in() ) {
							echo '<p>';
							edit_post_link( __( 'Edit', 'alpha' ), '<span class="meta-edit">', '</span>' );
							echo '</p>';
						}
					?>
				</footer> <!-- end entry-footer -->
			</article>
		<?php endwhile; ?>
	</div> <!-- end main-content -->
</div>

<?php get_footer(); ?>