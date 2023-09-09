<?php get_header(); ?>

<div class="container py-4">
	<div class="row justify-content-center">
		<div class="col-md-8 col-sm-12">
			<p class="fw-bold text-center ">Oops! - Errore 404</p>
            <p class="text-center text-muted">Pagina non trovata</p>
			<div class="d-flex justify-content-center">
				<img src="<?php echo get_theme_file_uri('/images/loading.gif') ?>" width="100%" alt="Coffee">
			</div>
			<br>
			<p>Ritorna alla <a class="text-muted" style="text-decoration: underline;" href="<?php echo home_url()?>">Home</a></p>
            <p>Oppure effettua una ricerca</p>
			<?php get_search_form() ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>