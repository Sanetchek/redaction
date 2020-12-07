</div><!-- .site-content -->

<footer id="site-footer">                			
    <div class="site-info">
    	<?php if ( !dynamic_sidebar( 'footer-sidebar' ) ) : ?>
    		<p>&copy; 2016 ТОВ "Редакція освітянських видань" <span>Усі права захищені</span></p>
    		<img src="<?php bloginfo('template_url'); ?>/images/visa-mastercard.gif" class="way-pay" alt="Спосіб оплати">
            <?php wp_nav_menu( array(
                'theme_location' => 'tertiary',
                'wrapper' => false,
                'menu_class' => 'footer-menu',
            ) );?>
		<?php endif; ?><!-- .sidebar .widget-area -->
    </div><!-- .site-info -->

<?php wp_footer(); ?>    
</footer><!-- .site-footer -->
</body>
</html>