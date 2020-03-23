<?php

$catalog_list = get_field('catalog_list', 'option');
$heading_catalog = get_field('heading_catalog', 'option');

if( $catalog_list ): ?>
<div class="content__catalog catalog">
    <h2 class="title"><?php echo $heading_catalog; ?></h2>
    <ul class="catalog__list">
        <?php foreach( $catalog_list as $post): ?>
            <?php setup_postdata($post); ?>
            <li class="catalog__item">
                <a class="catalog__link" href="<?php echo get_the_permalink(); ?>">
                    <span><?php the_title(); ?></span>
                    <span class="bg-icon">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>