<?php
/**
 * The template for displaying all single posts.
 *
 * @package Genwhy_Theme
 */

get_header(); ?>
<h4 style="position:fixed;top:100px;left:0;z-index:600;">single.php</h4>
<div class="nav-background"></div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>