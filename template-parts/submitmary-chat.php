<?php
	$avatar = get_template_directory_uri() . '/dist/images/picto-bot.png';
	$avatarUrl = get_template_directory_uri() . '/dist/images/picto-bot.png';
?>

<div class="field-group chat_response chat_submit" id="submit_mary"> 
	<div id="mail_form">	
		<div class="chat_list_item chat_list_item_new" data-update="question">
			<a href="#" target="_blank">
				<img class="avatar" src="<?php echo $avatarUrl; ?>" height="30" width="30" />
			</a>
			<div class="chat_bubble">
				<span><?php the_field('text_contact_name', 'option'); ?></span>
			</div>
		</div>
		<div class="chat_responses writerep" id="launch_rep_chat_sequence_name">
			<div class="chat_response">
	      <div class="input_text btn_chat">
	        <input type="text" id="name" name="name" class="input_text_text" placeholder="John Doe" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>" class="requiredField" />
	        <a href="#" class="submit_input">Envoyer</a>
	       </div>
			</div>
		</div>
		<div class="chat_list_item chat_list_item_new" data-update="question">
			<a href="#" target="_blank">
				<img class="avatar" src="<?php echo $avatarUrl; ?>" height="30" width="30" />
			</a>
			<div class="chat_bubble">
				<span><?php the_field('text_contact_email', 'option'); ?></span>
			</div>
		</div>	
		<div class="chat_responses writerep" id="launch_rep_chat_sequence_email">
			<div class="chat_response">
	      <div class="input_text btn_chat">
	        <input type="email" id="email" name="email" class="input_text_text" placeholder="email@exemple.fr" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" class="requiredField" />	        
	        <a href="#" class="submit_input submit_chat">Envoyer</a>
	       </div>
			</div>
		</div>
		<div id="mail_thx">

			<div class="chat_list_item chat_list_item_new" id="end-chat" data-update="question">
				<a href="#" target="_blank">
					<img class="avatar" src="<?php echo $avatarUrl; ?>" height="30" width="30" />
				</a>
				<div class="chat_bubble">
					<span><?php the_field('text_contact_thx', 'option'); ?></span>
					<input type="hidden" id="marypopins" name="maryPopins" value="maryP" />
				</div>
			</div>

		</div>
	</div>		
		
</div>