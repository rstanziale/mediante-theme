<?php get_header(); ?>

<div class="container py-4">
	<h1 class="fw-bold text-center text-primary"><?php echo post_type_archive_title('', false)  ?></h1>
	<h2 class="text-center text-muted"><?php the_archive_description(); ?></h2>

	<div class="row justify-content-center mt-4">
		<div class="col-md-8 col-sm-12">
			<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="col">
							<div class="card shadow-sm mb-4">
								<?php if (has_post_thumbnail()) : ?>
									<img class="card-img-top" style="object-fit: cover; height: 8rem;" src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>">
								<?php endif; ?>
								<div class="card-body">
									<a href="<?php the_permalink(); ?>" class="card-title fw-bold stretched-link text-decoration-none"><?php the_title(); ?></a>
									<?php if (has_secondary_title()) : ?>
										<p class="text-muted m-0"><?php echo get_secondary_title(); ?></p>
									<?php endif; ?>
								</div>
								<div class="card-footer">
									<small class="text-muted"><?php the_time('d F Y'); ?></small>
								</div>
							</div>
						</div>
				<?php endwhile;
				endif; ?>
			</div>

			<div class="row justify-content-center border-top border-light pt-4">
				<div class="col-12">
					<?php get_search_form() ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>