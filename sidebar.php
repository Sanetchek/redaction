<aside id="sidebar">
	<?php wp_nav_menu( array(
        'theme_location' => 'secondary',
        'wrapper' => false,
        'menu_class' => 'sidebar-menu',
    ) );?>
<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>	
		<?php dynamic_sidebar( 'left-sidebar' ); ?> 
<?php endif; ?>	
</aside><!-- .sidebar .widget-area -->