<?php get_header(); ?>
    <div id="content-area">
        <main id="main" class="site-main">
            <h1>нові надходження</h1>           
            <?php if ( have_posts() ) : query_posts('showposts=15'); while (have_posts()) : the_post(); ?>
                <ul class="posts">
                    <li class="post">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <h3><?php the_title();?></h3>
                        </a>
                        <p><?php the_excerpt(); ?></p>
                    </li>            
                </ul>
            <?php endwhile; ?>
            <?php else: ?>
                <p>По запиту нічого не знайдено...</p>
            <?php endif; ?>        
        </main><!-- .site-main -->
    </div><!-- .content-area -->
    <!-- Endcontent -->
    <?php get_sidebar();?>
<?php get_footer(); ?>