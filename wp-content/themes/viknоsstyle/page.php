<?php get_header(); ?>
    <section class="content-page content">
        <div class="wrapper">
            <h2 class="title"><?php the_title(); ?></h2>
			<?php if ( have_posts() ) {
				while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile;
			} ?>
        </div>
    </section>

<?php require( 'templates/elements/catalog-list-block.php' ); ?>
<?php get_footer(); ?>