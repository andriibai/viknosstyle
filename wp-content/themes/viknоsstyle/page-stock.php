<?php
/* Template Name: Akcii Page */
get_header(); ?>

    <section class="content-page">
        <div class="wrapper">
            <h2 class="title"><?php the_title(); ?></h2>
			<?php if ( have_posts() ) {
				while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile;
			} ?>
        </div>
    </section>

<?php
get_template_part( 'templates/stock' );
require( 'templates/elements/catalog-list-block.php' );
get_footer();