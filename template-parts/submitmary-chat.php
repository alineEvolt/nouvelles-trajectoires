<div class="field-group chat_response chat_submit" id="submit_mary"> 
	<div class="inner">
		<div id="mail_form">
			<label for="email">
				<?php the_field('text_intro_chat_pop', 'option'); ?>
			</label>
			<input type="text" id="name" name="name" placeholder="John Doe" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>" class="requiredField" />
			<input type="email" id="email" name="email" placeholder="email@exemple.fr" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" class="requiredField" />
			<input type="hidden" id="marypopins" name="maryPopins" value="maryP" />
			<div class="submit clearfix"> 
				<a href="#" class="submit_chat" id="goChat">Envoyer</a>
	    </div>
	    <?php //echo do_shortcode('[contact-form-7 id="405" title="Formulaire de contact"]'); ?>
	  </div>
	  <div id="mail_thx">
	  	<div class="avatar_bot">
	  		<!--<img class="animated" interval="25" pattern="<?php //echo get_template_directory_uri(); ?>/img/bot/bot_#.png" />-->
	  		<?php 
	      		$avatar = get_field('avatar_ok', 'option');
	      		$size = 'avatar_big';
						$thumb = $avatar['sizes'][ $size ];
						$width = $avatar['sizes'][ $size . '-width' ];
						$height = $avatar['sizes'][ $size . '-height' ];
	  		?>
	          <img src="<?php echo $thumb; ?>" alt="<?php echo $avatar['alt']; ?>" />
	          <!--<canvas id="botAnimation"></canvas>-->
			</div>
	  	<div class="text">
	  		<?php the_field('text_thx_form', 'option'); ?>
	  	</div>
	  </div>
	</div>
</div>