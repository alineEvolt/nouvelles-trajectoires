<select class="selecctBtn selectCustom">
	<option disabled selected value><?php the_sub_field('liste_custom_select_title'); ?></option>
	<?php 
	if( have_rows('liste_custom_options') ):
		while( have_rows('liste_custom_options') ) : the_row();
	?>
	
	<option value="<?php the_sub_field('option_liste_custom_options'); ?>"><?php the_sub_field('option_liste_custom_options'); ?></option>

	<?php 
		endwhile; 
	endif;
	?>
</select>