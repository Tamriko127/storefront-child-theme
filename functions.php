<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
	wp_dequeue_style( 'storefront-style' );
	wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

remove_filter( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_filter( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
add_action( 'woocommerce_after_main_content', 'woocommerce_taxonomy_archive_description',15 );
add_action( 'woocommerce_after_main_content', 'woocommerce_product_archive_description',15 );
add_action ('after_setup_theme', 'basic_child_theme_setup', 1);
function basic_child_theme_setup () {
	remove_filter( 'storefront_header', 'storefront_product_search', 40 );
	
}
/*add_action ('storefront_content_top', 'art_product', 10);
function art_product(){
	echo do_shortcode('[products limit=6 columns=2]');
}*/
add_action ('storefront_header', 'art_site_phone', 40);
function art_site_phone(){
	?>
	<div class="site-phone">
		<a href="tel:+789654123">+7 (984) 654 12 32</a>
	</div>
	<div class="site-phone">
		Москва, Красная площадь
	</div>
	<?php
}

add_action( 'storefront_handheld_footer_bar_links', 'artabr_unset_accunt' );
function artabr_unset_accunt($links){
	unset( $links['my-account'] );
	return $links;
}




