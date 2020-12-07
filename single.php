<?php get_header(); ?>
    <div id="content-area">
        <main id="post-content">
            <div id="post">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <!-- post -->
                <h3>
                    <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
                </h3>
                <h1><?php the_title(); ?></h1>
                <p><?php the_content(); ?></p>
                <div class="film-part">Уривок фільму</div>
                <div class="video-yt">
                    <?php the_post_video(); ?>
                </div>
                <div class="share">шейри, лайки</div>
            <?php endwhile; ?>
            <!-- post navigation -->
            <?php else: ?>
            <!-- no posts found -->
            <?php endif; ?>
                               
            </div>
            <!-- EndPost -->
            <?php include ('post-sidebar.php'); ?>
            <!-- Related Posts -->
            <div class="related-posts">
                <h2>Вас може зацікавити</h2>
                <ul class="posts">
                <?php
                    $categories = get_the_category($post->ID);
                    if ($categories) {
                        $category_ids = array();
                        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                        $args=array(
                            'category__in' => $category_ids,
                            'post__not_in' => array($post->ID),
                            'showposts' => '3',
                            'orderby' => 'rand',
                            'ignore_sticky_posts' => '1');
                    $my_query = new wp_query($args);                    
                    if( $my_query->have_posts() ) {
                        
                        while ($my_query->have_posts()) {
                            $my_query->the_post();
                            ?>
                            
                                <li class="post">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                        <h3><?php the_title();?></h3>
                                    </a>
                                    <p><?php the_excerpt(); ?></p>
                                </li>
                <?php } } wp_reset_query();}?>
                </ul>
            </div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->
    <?php get_sidebar();?>
<?php get_footer(); ?>