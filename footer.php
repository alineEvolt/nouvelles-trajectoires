<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nouvelles-trajectoires
 */

?>
		<footer id="contentinfo">
			<div class="grid">
				<div class="full">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo-big.svg" alt="<?php echo get_bloginfo( 'name' ); ?>" width="367" height="44" />
				</div>
			</div>
			<div class="flex-container-v">
			<div>
				<ul>
					<li><a href="#">Outils</a></li>
					<li><a href="#">Projet</a></li>
					<li><a href="#">Formation</a></li>
					<li><a href="#">Recrutement</a></li>
					<li><a href="#">À propos</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div>
			<div>
				<p>Nouvelles trajectoires<br />
				45 place Pitot<br />
				34000 Montpellier<br />
				<a href="tel:06 20 12 13 14">06 20 12 13 14</a></p>
			</div>
			<div>
				<p>Suivez-nous sur linkedin</p>
			</div>
			</div>
		</footer>
		</main><!-- END MAIN -->
	</div><!-- END PAGE -->

<?php wp_footer(); ?>

</body>
</html>
