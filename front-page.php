<?php get_header(); ?>

<?php // echo get_template_directory_uri(); ?>

<?php if ( have_posts()  ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title() ?></h2>
		<?php the_content(); ?>
	<?php endwhile; ?>

<?php else : ?>
	<p>Nothing to found.</p>
<?php endif; ?>

<?php get_footer(); ?>