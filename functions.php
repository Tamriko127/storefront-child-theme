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
add_action( 'wp_enqueue_scripts', 'artabr_script' );
function artabr_script() {
	
	wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/assets/js/custom-js.js', array('jquery'), null, true );
	wp_enqueue_script( 'magnific', get_stylesheet_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), null, true );
	wp_enqueue_style( 'magnific-popup', get_stylesheet_directory_uri() . '/assets/css/magnific-popup.css');

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
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
/*add_filter( 'woocommerce_product_single_add_to_cart_text', 'artabr_change_add_to_cart_text' );
function artabr_change_add_to_cart_text($text){
$text = 'Заказать';
return $text;
}*/
/*add_filter( 'woocommerce_add_to_cart_form_action', 'artabr_remove_form_action');
function artabr_remove_form_action($url){
	echo '<pre>';
	print_r ($url);
	echo '</pre>';
}*/
add_action( 'woocommerce_after_add_to_cart_button', 'artabr_add_custom_button' );
function artabr_add_custom_button(){
	global $product;
	?>
	<a href="#form-custom-order" data-value-product-id="<?php echo esc_attr( $product->get_id() ); ?>" class="custom-order button alt">Заказать</a>

	<?php
}
add_action( 'wp_footer', 'artabr_form_custom_order' );
function artabr_form_custom_order(){
	global $product;
	
	if (!is_product()){
		return;
		
	}
	
	$product_var = new WC_Product_Variable($product->get_id());
	$product_var_attrs = implode(',', $product_var->get_available_variations()[0]['attributes']);

	?>
	<div id="form-custom-order" class="form-custom-order-footer mfp-hide">
		<?php //echo esc_attr( $product->get_id() );
		$post_thumbnail_id = get_post_thumbnail_id( $product->get_id() );
		$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'shop_thumbnail' );
		echo $full_size_image[0];
		echo $product->get_title();
		echo $product->get_price_html();


		?>
		<div class="form-custom-order-title"><?php echo $product->get_title(); ?></div>
		<div class="form-custom-order-attr"><?php echo $product_var_attrs; ?></div>
		
		<?php echo do_shortcode('[contact-form-7 id="19" title="Страница контактов"]');?>
	
	</div>
	<?php
}





