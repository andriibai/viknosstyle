<?php
$title_about = get_field( 'title_about' );
$image_about = get_field( 'image_about' );
$text_about  = get_field( 'text_about' );
?>

<section id="catalog" class="content home">
    <div class="wrapper">
		<?php get_template_part( 'templates/catalog-list-home' ); ?>
        <div class="content__about">
            <h2 class="title"><?php echo $title_about; ?></h2>
			<?php echo $text_about; ?>
            <img src="<?php echo $image_about; ?>" alt="">
        </div>
    </div>
</section>
