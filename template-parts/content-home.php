
<?php 
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();		
		
		if ( has_post_thumbnail() ) {
		  $visuel_home = 'background: url(' . get_the_post_thumbnail_url() . ') no-repeat 50% 100% / auto 65%';
		} else {
			$visuel_home = '';
		}
?>
		<section id="accueil">
			<div class="intro_home">
				<div class="wrapper" style="<?php echo $visuel_home; ?>">
					<div class="grid">
						<div>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
			<?php if( have_rows('bloc_contenu_home') ): ?>

			<div class="wrapper content_row">

				<div class="flex-container">
				
				<?php while( have_rows('bloc_contenu_home') ): the_row();

					$title = get_sub_field('title_contenu_home');
					$text = get_sub_field('text_contenu_home');
					$ajoutImg = get_sub_field('ajout_img_contenu_home');
					$image = get_sub_field('img_contenu_home');
					$posImg = get_sub_field('pos_img_contenu_home');

				?>
					<div class="flex-item-fluid column">
					<?php
						if( $image ) { ?>
							<div class="visu pos-<?php echo $posImg; ?>">
								<img src="<?php echo $image['url']; ?> alt="<?php echo $image['alt']; ?>" />
							</div>
						<?php } ?>
							<div class="text">
						<?php if( $title ) {
							echo '<h2>' . $title . '</h2>';
						} 
						if( $text ) {
							echo $text;
						} ?>
							</div>

					</div>

				<?php endwhile; ?>

				</div>

			</div>

			<?php endif; ?>

		</section>
	<?php
	endwhile;
endif;
?>
