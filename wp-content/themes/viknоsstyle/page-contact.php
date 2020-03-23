<?php
/* Template Name: Contact Page */
get_header();

$map_google = get_field( 'map_google', 'option' );
?>
    <section class="content-page">
        <div class="wrapper">
            <h2 class="title"><?php the_title(); ?></h2>
            <div class="content-page__contact">
                <div class="content-page__form">
					<?php require( 'templates/elements/form.php' ); ?>
                </div>
                <div class="map">
                    <?php echo $map_google; ?>
                </div>
            </div>
        </div>
    </section>
<?php require( 'templates/elements/catalog-list-block.php' ); ?>
<?php get_footer(); ?>