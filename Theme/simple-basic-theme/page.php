<?php get_header(); ?>

    <div class="container py-5">
        <div class="row">
            <?php 
                if(have_posts()) : 
                    while(have_posts()) : the_post();
            ?>
                <article>
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </article>

            <?php 
                    endwhile;
                endif;
            ?>
        </div>
    </div>
    

<?php get_footer(); ?>