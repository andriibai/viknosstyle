<?php if ( have_rows( 'slider_home' ) ): ?>
    <section id="stock" class="stock home">
        <div class="stock__content">
            <div class="owl-carousel stock__slider">
				<?php while ( have_rows( 'slider_home' ) ) : the_row(); ?>
                    <div class="stock__item">
                        <div class="stock__image">
                            <img src="<?php echo the_sub_field( 'image_slider' ); ?>" alt="">
                        </div>

                        <div class="wrapper">
                            <div class="stock__text">
								<?php if ( get_sub_field( 'text1_slider' ) ) : ?>
                                    <h1><?php echo get_sub_field( 'text1_slider' ); ?></h1>
								<?php endif; ?>
								<?php if ( get_sub_field( 'text2_slider' ) ) : ?>
                                    <span class="stock__descr-bottom"><?php echo get_sub_field( 'text2_slider' ); ?></span>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
				<?php endwhile; ?>
            </div>
			<?php if ( get_field( 'button_slider' ) ) : ?>
                <div class="btn-slider-wrap">
                    <a href="#contacts" class="stock__btn-contact btn popup__btn">
                        <span><?php echo get_field( 'button_slider' ); ?></span>
                    </a>
                </div>
			<?php endif; ?>
            <div id="button-down" class="button__down">
                <a href="#catalog"><span></span></a>
            </div>
        </div>
    </section>
<?php endif; ?>