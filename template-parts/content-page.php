<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nouvelles-trajectoires
 */

	$secBkg = get_field('bkg_sec');
	$imgBkgQ = get_field('img_bkg_sec');
	$imgBkqR = get_field('img_bkg_sec_upload');
	$urlImgBkg = $imgBkqR['url'];
	$imgPos = get_field('pos_img_bkg_sec');
	$posBkg = '0 0';

	if( $secBkg ) { $background = $secBkg; } 
	else { $background = 'white'; }	

	if( $imgPos === 'top_left' ) { $posBkg = '0 0'; }
	elseif( $imgPos === 'top_center' ) { $posBkg = '50% 0'; }
	elseif( $imgPos === 'top_right' ) { $posBkg = '100% 0'; }
	elseif( $imgPos === 'middle_left' ) { $posBkg = '0 50%'; }
	elseif( $imgPos === 'middle_center' ) { $posBkg = '50% 50%'; }
	elseif( $imgPos === 'middle_right' ) { $posBkg = '100% 50%'; }
	elseif( $imgPos === 'bottom_left' ) { $posBkg = '0 100%'; }
	elseif( $imgPos === 'bottom_center' ) { $posBkg = '50% 100%'; }
	elseif( $imgPos === 'bottom_right' ) { $posBkg = '100% 100%'; }
	echo '<section class="section bkg-' . $background . '">';

	if( $imgBkgQ ) { ?>
		<div class="imgSection <?php echo $imgPos; ?>">
			<div class="wrapper">
				<img src="<?php echo $urlImgBkg; ?>" alt="" />
			</div>
		</div>
<?php	} 

	if( have_rows('section_row') ):
		while ( have_rows('section_row') ) : the_row();	

			if( get_row_layout() == 'bloc_intro'):
				echo '<div class="wrapper">';
			?>

				<div class="flex-container intro-section">
					<div class="flex-item-fluid">
						<h2><?php the_sub_field('title_intro'); ?></h2>
						<?php the_sub_field('text_intro'); ?>
					</div>
				</div>

			<?php
				echo '</div>';
			endif;

			if( get_row_layout() == 'bloc_contenu' ):
				echo '<div class="wrapper">';
				if( $secBkg != 'gray') {
					echo '<div class="content_row nopad_content">';
				} else {
					echo '<div class="content_row">';
				}
									
					$rows = get_sub_field('add_column');
					$count_rows = count($rows);
					$j = 0;
					$k = 0;
				if( have_rows('add_column') ):					
				  while ( have_rows('add_column') ) : the_row();					
					$title = get_sub_field('title_contenu');
					$text = get_sub_field('text_contenu');
					$ajoutImg = get_sub_field('ajout_img_contenu');
					$image = get_sub_field('img_contenu');
					$url_image = $image['url'];

					echo (++$j % 2 == 1) ? '<div class="flex-container">' : '';
				?>
					<div class="flex-item-center column">

						<?php if( $image ) { ?>
							<div class="visu pos-left">
								<img src="<?php echo $url_image; ?>" alt="<?php echo $image['alt']; ?>" />
							</div>
						<?php } ?>
							<div class="text">
						<?php if( $title ) {
							echo '<h3>' . $title . '</h3>';
						} 
						if( $text ) {
							echo $text;
						} ?>
							</div>
					</div>
			<?php

				echo (++$k % 2 == 0) ? '</div>' : '';
					endwhile;
				endif;
				echo '</div>';
				echo '</div>';
			endif;

			if( get_row_layout() == 'synthese_sec'):
				echo '<div class="content_synt">';
				echo '<div class="wrapper">';

				$title_synt = get_sub_field('title_contenu_synt');
				if( $title_synt ) {
			?>

				<div class="flex-container">
					<div class="flex-item-center">
						<h3><?php echo $title_synt; ?></h3>
					</div>
				</div>
			<?php
				}
				if( have_rows('bloc_contenu_synt') ):
					echo '<div class="flex-container columns">';
					$i = 1;
					while ( have_rows('bloc_contenu_synt') ) : the_row();
					$picto = get_sub_field('picto_contenu_synt');
					$url_picto = $picto['url'];

				?>
						<div class="flex-item-fluid column">	
							<div class="picto">					
								<img src="<?php echo $url_picto; ?>" alt="<?php $picto['alt']; ?>" />
							</div>
							<div class="text">
								<span class="num">0<?php echo $i; ?></span>
								<p><?php the_sub_field('texte_contenu_synt'); ?></p>
							</div>
						</div>

				<?php
					$i++;
					endwhile;
					echo '</div>';
				endif;
			?>

			<?php
					echo '</div>';
				echo '</div>';
			endif;

			if( get_row_layout() == 'call_to_action'):

				$contactBloc = get_sub_field('ajout_bloc_contact');

				//$linkBot = '';
				//if( $contactLink ) { $linkBot = $contactLink; } else { $linkBot = '/' }

				if( $contactBloc ) { 
					$contactLink = get_field('lien_contact', 'option');
					$linkBot = '/';
					if( $contactLink ) { $linkBot = $contactLink; }
					//echo $linkBot;
				?>
					<div class="wrapper">
						<div class="flex-container">
							<div class="flex-item-item right">
								<div class="contact-bloc">
									<a href="<?php echo $linkBot; ?>">
										<span class="bulle">
											Puis-je vous aider ?
										</span>
										<span class="picto-bot">
											<img src="<?php echo get_template_directory_uri(); ?>/dist/images/picto-bot.png" alt="Picto bot" />
										</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php }

			endif;
	?>

	<?php
		endwhile;
	endif;

	echo '</section>';
	?>

