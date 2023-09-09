<?php get_header(); ?>

<div class="container py-4">
	<div class="row justify-content-center">
		<div class="col-md-8 col-sm-12">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article>
						<h1 class="fw-bold text-center "><?php the_title(); ?></h1>
						<div class="article-content mt-3">
							<?php the_content(); ?>
						</div>
					</article>
			<?php endwhile;
			endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>