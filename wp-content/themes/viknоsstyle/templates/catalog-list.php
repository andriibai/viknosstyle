<?php
$catalog_query = new WP_Query(array(
    'post_type' => 'catalog',
    'posts_per_page' => -1,
));

    if($catalog_query->have_posts()) : ?>
        <div class="content__catalog catalog">
            <h2 class="title">Каталог продукції</h2>
            <ul class="catalog__list">
                <?php while($catalog_query->have_posts())  : $catalog_query->the_post(); ?>
                    <li class="catalog__item">
                        <a class="catalog__link" href="<?php echo get_the_permalink(); ?>">
                            <span><?php the_title(); ?></span>
                            <span class="bg-icon">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </span>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php wp_reset_query(); endif; ?>




<div class="content__catalog catalog">
        <h2 class="title">Каталог продукції</h2>
        <ul class="catalog__list">
            <li class="catalog__item">
                <a class="catalog__link" href="http://localhost/wordpress/produkt/">
                    <span>віконі констукції</span>
                    <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                </a>
            </li>
            <li class="catalog__item">
                <a class="catalog__link" href="#">
                    <span>балконі конструкції</span>
                    <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                </a>
            </li>
            <li class="catalog__item">
                <a class="catalog__link" href="#">
                    <span>москітні сітки</span>
                    <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                </a>
            </li>
            <li class="catalog__item">
                <a class="catalog__link" href="#">
                    <span>підвіконя</span>
                    <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                </a>
            </li>
                <li class="catalog__item">
                    <a class="catalog__link" href="#">
                        <span>відливи</span>
                        <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
                <li class="catalog__item">
                    <a class="catalog__link" href="#">
                        <span>ролокасети</span>
                        <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
                <li class="catalog__item">
                    <a class="catalog__link" href="#">
                        <span>жалюзі</span>
                        <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
                    <li class="catalog__item">
                        <a class="catalog__link" href="#">
                            <span>карнізи</span>
                            <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                        </a>
                    </li>
                    <li class="catalog__item">
                        <a class="catalog__link" href="#">
                            <span>пластикові двері</span>
                            <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                        </a>
                    </li>
                    <li class="catalog__item">
                        <a class="catalog__link" href="#">
                            <span>гаражні ворота</span>
                            <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                        </a>
                    </li>
                    <li class="catalog__item">
                        <a class="catalog__link" href="#">
                            <span>аксесуари для дому</span>
                            <span class="bg-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                        </a>
                    </li>
        </ul>
</div>
