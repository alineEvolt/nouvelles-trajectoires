<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="wrapper">
		<div class="flex-container-v">
			<div class="flex-item-center">

				<?php while ( have_posts() ) : the_post(); ?>

					<h1>
						Nouveau contact : <?php the_field('nom_synthese'); ?>
						<span class="date">Date : <?php the_date(); ?></span>
					</h1>
					<div class="intro">
						<p>Bonjour, une nouvelle personne a rempli le formulaire de contact.</p>
					</div>

					<ul class="names">
						<li><strong>Nom : </strong><?php the_field('nom_synthese'); ?></li>
						<li><strong>Email : </strong><?php the_field('email_synthese'); ?></li>
					</ul>

					<div class="detail">
						<?php the_content(); ?>
					</div>

				<?php endwhile; ?>

			</div>
		</div>
	</div>
</article>

<?php get_footer();
