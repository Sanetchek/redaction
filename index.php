<?php get_header(); ?>
    <div id="content-area">
        <main id="main" class="site-main">
            <ul class="posts">
            <?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
                    <li class="post">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <h3><?php the_title();?></h3>
                        </a>
                        <p><?php the_excerpt(); ?></p>
                    </li>
            <?php endwhile; ?>
            </ul>
            <?php else: ?>
            <?php endif; ?>        
        </main><!-- .site-main -->
    </div><!-- .content-area -->
    
    <?php get_sidebar();?>
<?php get_footer(); ?>