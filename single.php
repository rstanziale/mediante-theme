<?php get_header(); ?>
<?php get_template_part('includes/progress-bar'); ?>

<div class="container py-4">
	<div class="row justify-content-center">
		<div class="col-md-8 col-sm-12">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php $prev_post = get_previous_post();
					if (!empty($prev_post)) : ?>
						<div class="post-link post-link--right bg-primary shadow d-flex align-items-center position-fixed">
							<a class="text-white" href="<?php echo get_permalink($prev_post->ID); ?>"><i class="fas fa-chevron-right"></i></a>
						</div>
					<?php endif;

					$next_post = get_next_post();
					if (is_a($next_post, 'WP_Post')) { ?>
						<div class="post-link post-link--left bg-primary shadow d-flex align-items-center position-fixed">
							<a class="text-white" href="<?php echo get_permalink($next_post->ID); ?>"><i class="fas fa-chevron-left"></i></a>
						</div>
					<?php } ?>
					<article>
						<h1 class="fw-bold text-center text-primary"><?php the_title(); ?></h1>
						<?php if (has_secondary_title()) : ?>
							<h2 class="text-center text-muted"><?php echo get_secondary_title(); ?></h2>
						<?php endif; ?>
						<div class="d-flex my-3">
								<?php $tags = get_the_tags();
								foreach ($tags as $tag) {
									echo ('<span class="badge rounded-pill bg-primary me-1"><a class="link-light text-decoration-none" href="' . get_tag_link($tag->term_id) . '"><i class="fas fa-tag me-1"></i>' . $tag->name . "</a></span>");
								}
								?>
							<span class="ms-auto text-muted"><?php the_time('d F Y'); ?></span>
						</div>
						<div class="article-content">
							<?php the_content(); ?>
						</div>
						<?php $mediante_meta_value = get_post_meta( get_the_ID(), 'mediante-meta', true ); ?>
						<?php if ($mediante_meta_value != null) : ?>
							<div class="alert alert-primary shadow" role="alert">
								<?php echo $mediante_meta_value ?>
							</div>
						<?php endif; ?>
					</article>
					<div class="d-flex justify-content-around pt-4 mt-2 border-top border-light">
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fab fa-facebook "></i></a>
						<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>"><i class="fab fa-twitter "></i></a>
						<a target="_blank" href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>"><i class="fab fa-whatsapp "></i></a>
						<a target="_blank" href="https://telegram.me/share/url?url=<?php the_permalink(); ?>"><i class="fab fa-telegram "></i></a>
						<a target="_blank" href="mailto:?subject=<?php the_title(); ?>&amp;BODY=<?php the_title(); ?> - <?php the_permalink(); ?>"><i class="fas fa-envelope "></i></a>
					</div>
					<div class="pt-4 mt-4 border-top border-light">
						<?php get_template_part('includes/newsletter'); ?>
					</div>
					<div class="pt-4 mt-4 border-top border-light">
						<?php comments_template() ?>
					</div>
			<?php endwhile;
			endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>