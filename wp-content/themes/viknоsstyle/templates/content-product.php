<?php if( have_rows('review') ): ?>
<section class="product">
    <div class="wrapper">
        <h2 class="title"><?php the_title(); ?></h2>
        <div class="product__content">
          <?php  while ( have_rows('review') ) : the_row(); ?>
              <div class="product__item">
                  <div class="product__image">
                      <img src="<?php echo the_sub_field('image_product'); ?>" alt="">
                  </div>
                  <div class="product__info">
                      <h3><?php echo the_sub_field('title_product'); ?></h3>
                      <?php echo the_sub_field('review_product'); ?>
                  </div>
              </div>
           <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

