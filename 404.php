<?php get_header(); ?>
    <div id="content-area">
        <main id="main" class="site-main">
        	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        	<!-- post -->
	        	<div class="error">
		    		<div>404</div>
		    		<h1>Нічого не знайдено...</h1>
		    	</div> 
        	<?php endwhile; ?>
        	<!-- post navigation -->
        	<?php else: ?>
        	<!-- no posts found -->
        	<?php endif; ?>	        
        </main><!-- .site-main -->
    </div><!-- .content-area -->
    <?php get_sidebar();?>
<?php get_footer(); ?>