<?php

/*Button Shortcode*/
function content_btn($atts){
	extract(shortcode_atts(array(
		'text' => 'Learn More',
		'link' => site_url(),
		'class' => false,
		'target' => false
	), $atts )); ?>
	<a href="<?php echo $link; ?>" class="button <?php echo $class ? $class :false; ?>" <?php echo $target ? 'target="'.$target.'" rel="noindex noopener"' :false; ?>><?php echo $text; ?></a>
<?php }
add_shortcode("button", "content_btn");

/*Custom Pagination*/
function custom_pagination() {
	ob_start();
	get_template_part('template-parts/global/shortcodes/custom-pagination');
	return ob_get_clean();
}
add_shortcode('custom-pagination','custom_pagination');

/*Google Rating*/
function google_rating() {
    ob_start();
    get_template_part('template-parts/global/shortcodes/google-rating');
    return ob_get_clean();
}
add_shortcode('google-rating','google_rating');

// Micro data
function get_offer_microdata(){
    ob_start();
    get_template_part('template-parts/global/shortcodes/offer-microdata');
    return ob_get_clean();
}
add_shortcode('offer_microdata','get_offer_microdata');

