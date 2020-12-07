<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel='stylesheet' id='main-style'  href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="masthead" class="site-header">
    <div id="site-header-main">        
        <div id="site-branding">
            <div id="logo"><a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="logo"></a></div>
            <div id="header">                           
                <aside id="contact-info">
                <?php if ( !dynamic_sidebar( 'header-sidebar' ) ) : ?>                    
                    <div class="phone_info">Телефонна підтримка покупців:</div>
                    <div class="phone">(044) 501-86-65</div>
                    <div class="phone">(093) 502-91-21</div>
                    <div class="e-mail">
                        <div>е-mail:</div> 
                        <div>
                            osvita@ukr.net
                        </div>
                    </div>                    
                <?php endif; ?>
                 </aside><!-- .sidebar .widget-area -->
                
                <div id="shoping-cart"><a href="<?php echo get_permalink(5); ?>">В кошику <?php echo WC()->cart->get_cart_contents_count(); ?> товар(и)<br /> на суму <?php echo WC()->cart->get_cart_subtotal(); ?></a></div> 
            </div>
        </div><!-- .site-branding -->
    </div><!-- .site-header-main -->
    <div id="site-header-menu">
        <nav id="site-navigation">
            <?php wp_nav_menu( array(
                'theme_location' => 'primary',
                'wrapper' => false,
                'menu_class' => 'menu',
            ) );?>
            <div class="social"><a href="https://www.facebook.com/VseDlaVchitela"><img src="<?php bloginfo('template_url'); ?>/images/fb.png" alt="facebook"></a></div>
        </nav><!-- .main-navigation -->
    </div><!-- .site-header-menu --> 
</header><!-- .site-header -->

<div id="content" class="site-content">