<?php get_header(); ?>

<?php if (is_home() && !is_paged()) : ?>
    <?php
    $slider_query = new WP_Query([
        'posts_per_page' => 3,       // Mostramos 3 posts
        'ignore_sticky_posts' => 1   // Ignoramos los fijados para que sea cronológico
    ]);
    ?>

    <?php if ($slider_query->have_posts()) : ?>
        <section class="hero-slider swiper">
            <div class="swiper-wrapper">
                <?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                    <div class="swiper-slide" style="background-image: url('<?php echo get_the_post_thumbnail_url(null, 'large'); ?>');">
                        <div class="slide-content">
                            <span class="slide-cat"><?php the_category(', '); ?></span>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <a href="<?php the_permalink(); ?>" class="btn-slide">Leer más</a>
                        </div>
                        <div class="slide-overlay"></div> </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </section>
        <?php wp_reset_postdata(); ?> <?php endif; ?>
<?php endif; ?>


<main class="content-area">
    <h3 class="section-title">Últimas Publicaciones</h3>
    
    <?php if (have_posts()): ?>
        <div class="posts-loop">
            <?php while (have_posts()): the_post(); ?>
                <article class="post-card">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="thumb">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>
    <?php else: ?>
        <p>No hay contenido disponible.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>