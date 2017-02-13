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
		</main><!-- END MAIN -->
		<footer id="footer">
			<div class="grid contentinfo">
				<div class="full txtcenter">
					<img src="<?php the_field('logo_1', 'option'); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" width="367" height="44" />
				</div>
			</div>
			<div class="flex-container wrapper">
				<div class="flex-item-fluid">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'footer-menu' ) ); ?>
				</div>
				<div class="flex-item-fluid">
					<p><?php the_field('adresse', 'option'); ?><br />
					<a href="tel:<?php the_field('num_tel', 'option'); ?>"><?php the_field('num_tel', 'option'); ?></a></p>
				</div>
				<div class="flex-item-fluid social">
					<p>Suivez-nous sur <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/picto-linkedin.svg" alt="Linkedin" /></a></p>
				</div>
			</div>
			<div class="copyright">
				<div class="grid wrapper">
					<div class="copy two-thirds">
						<p><?php the_field('copyright', 'option'); ?> &copy; <?php echo date('Y'); ?></p>
					</div>
					<div class="realisation one-third">
						<p>Made with love by <a href="http://evolt.io" target="_blank">Évolt</a></p>
					</div>
				</div>
			</div>
		</footer>
	</div><!-- END PAGE -->

<?php wp_footer(); ?>

</body>
</html>
