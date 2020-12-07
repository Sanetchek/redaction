<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div id="post">
	<h3>
        <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
    </h3>	
		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>

		<div class="price-info">
		<?php
			/**
			 * redaction_single_product_price_info hook
			 *
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_add_to_cart - 20
			 */
			do_action( 'redaction_single_product_price_info' );
		?>
		</div>

		<p class="p-content"><?php the_content(); ?></p>

		<?php if ( has_post_video() ) : ?> 
			<div class="film-part">Уривок фільму</div>
	        <div class="video-yt">
	            <?php the_post_video(); ?>
	        </div>
		<?php endif; ?>
		<?php if ( has_post_thumbnail () ) : ?> 
		<?php
			/**
			 * woocommerce_before_single_product_summary hook.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>
		<?php endif; ?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?> 
	<aside id="right-sidebar" role="complementary">
		<?php dynamic_sidebar( 'right-sidebar' ); ?> 
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

<div class="related-posts">
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div>


<?php do_action( 'woocommerce_after_single_product' ); ?>
