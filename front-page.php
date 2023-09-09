<?php get_header(); ?>

<div class="container h-100">
    <section id="sec-1" class="h-100 w-100">
        <div class="container h-100">
            <div class="row h-100 align-items-center" data-aos="fade-right">
                <div class="col-6"></div>
                <div class="col-6">
                    <p class="fw-bold m-0"><a class=" text-decoration-none" href="<?php echo site_url(); ?>"><?php bloginfo('name') ?></a></p>
                    <p class="m-0"><?php bloginfo('description') ?></span>
                    <div class="pulse">
                        <a href="#sec-2">
                            <i class="fas fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="sec-2" class="h-100 w-100">
        <div class="d-flex h-100 align-items-center justify-content-center">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-sm-12">
                    <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
                        <?php $the_query = new WP_Query(array('category_name' => get_theme_mod('cfp_category_name'), 'posts_per_page' => get_theme_mod('cfp_max_elements'),)); ?>
                        <?php if ($the_query->have_posts()) : ?>
                            <?php $count = $the_query->found_posts; ?>

                            <div class="carousel-indicators">
                                <?php $post_idx = 0; ?>
                                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <button data-bs-target="#carouselIndicators" data-bs-slide-to="<?php echo $post_idx; ?>" class="<?php if ($post_idx == 0) : ?>active<?php endif; ?>"></button>
                                    <?php $post_idx++; ?>
                                <?php endwhile; ?>
                            </div>
                            <div class="carousel-inner">
                                <?php $post_idx = 0; ?>
                                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <div class="carousel-item <?php if ($post_idx == 0) : ?>active<?php endif; ?>">
                                        <a href="<?php the_permalink(); ?>">
                                            <img class="d-block w-100" src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>">
                                        </a>
                                        <div class="carousel-caption d-none d-md-block">
                                            <p class="fw-bold"><?php the_title(); ?></p>
                                        </div>
                                    </div>
                                    <?php $post_idx++; ?>
                                <?php endwhile; ?>
                            </div>
                            <?php if ($count > 1) : ?>
                                <button type="button" class="carousel-control-prev" data-bs-target="#carouselIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <button type="button" class="carousel-control-next" data-bs-target="#carouselIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </button>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (is_active_sidebar('sidebar')) : ?>
        <section class="mt-4">
            <?php get_sidebar(); ?>
        </section>
    <?php endif; ?>
</div>

<?php get_footer(); ?>