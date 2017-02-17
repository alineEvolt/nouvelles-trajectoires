<?php get_header(); 	
	while ( have_posts() ) : the_post();

		$postID = $post->ID;
		$avatar = get_template_directory_uri() . '/dist/images/picto-bot.png';
		$avatarUrl = get_template_directory_uri() . '/dist/images/picto-bot.png';
	?>

<div class="wrapper">
	<form id="chat_form" action="<?php echo the_permalink(); ?>" data-confirm="<?php echo the_permalink(); ?>" method="post">

		<?php 
		$rowsFlex = get_field('scenario_next_choice');
		$countFlex = count($rowsFlex);
		if( have_rows('scenario_next_choice') ):
			$a = 1;
			while ( have_rows('scenario_next_choice') ) : the_row();

			  if( get_row_layout() == 'bulles_scen_next' ):

			    if( have_rows('bulles_scen_next_choice') ):									
			    	$countBulles = 0;

			    	while ( have_rows('bulles_scen_next_choice') ) : the_row();?>
			    		<?php if ( !$countBulles ) { ?>
			    		<div class="chat_list_item chat_list_item_new" data-update="question">
		    				<a href="#" target="_blank">
		    					<img class="avatar" src="<?php echo $avatarUrl; ?>" height="30" width="30" />
		    				</a>
			    			<?php } else { ?>
			    		<div class="chat_list_item" data-update="question">	
			    			<?php } ?>
			    			<div class="chat_bubble">
			    				<span><?php the_sub_field('bulle_scen_next_choice'); ?></span>
		    				</div>
	    				</div>
			    	<?php	

			    	$countBulles++;
						endwhile;

					endif;

			  endif; // end bulles de dialogue

			  //Boutons de type choice
			  if( get_row_layout() == 'btn_choice' ):
			    
			    $rowsChoice = get_sub_field('boutons_de_type_choix');
			  	$otherChoice = get_sub_field('bouton_de_type_choix_other');
			  	$countRows = count( $rowsChoice );
			  	if( $otherChoice ) {
			  		$countRows = $countRows+1;
			  	} else {
			  		$countRows = $countRows;
			  	}

					echo '<div class="chat_responses choicerep swiper-container" id="launch_rep_chat_sequence_' . $a . '_' . $countFlex++ . '">';
		      	echo '<div class="chat_response swiper-wrapper">';

			    	if( have_rows('boutons_de_type_choix') ):

			    		$i = 1;			      
							while ( have_rows('boutons_de_type_choix') ) : the_row();

							  $scenarChild = get_sub_field('ajout_btn_choice');

							  if( $scenarChild === 'ajout_scenar_next_next_2' ) {
						    	$nextSeq = 'chat_sequence_' . $i . '_' . $countFlex;
						    } 
						    else if( $scenarChild === 'ajout_input_text_2') {
						    	$nextSeq = 'chat_sequence_other_' . $a . '_' . $i;
						    } else {
						    	$nextSeq = 'normal_flux';
						    }

						    ?>

								<div class="radio btn_chat swiper-slide">
			            <label>
	                  <input type="radio" class="radio" name="choice_<?php echo $a; ?>" id="input<?php echo $a . '_' . $i; ?>" value="<?php the_sub_field('btn_text_choice'); ?>" data-next="<?php echo $nextSeq; ?>" />
	                  <?php the_sub_field('btn_text_choice'); ?>
		              </label>
			          </div>

			    			<?php	
			    		$i++;
							endwhile;
							
						endif;

						echo '</div>';
					echo '</div>';

			  endif; // end boutons de type choice

			  //Boutons de type choice bis
			  if( get_row_layout() == 'btn_choice' ):

			    if( have_rows('boutons_de_type_choix') ):
						$i = 1;
						while ( have_rows('boutons_de_type_choix') ) : the_row();
						  $scenarChild = get_sub_field('ajout_btn_choice');

						  if( $scenarChild === 'ajout_scenar_next_next_2' ) {

							  if( have_rows('next_next_scenario') ):
						    	
									$nextSeq = 'chat_sequence_' . $i . '_' . $countFlex;
									echo '<div id="' . $nextSeq . '" class="sequence">';
				    				while ( have_rows('next_next_scenario') ) : the_row();
				    						
				    					if( get_row_layout() == 'bulles_de_dialogue_next_next' ):	

				    						$last_row = count(get_field('bulles_scen_next_choice'));

				    						if( have_rows('bulles_scen_next_choice') ):			    									
				    							$countBulles = 0;
													while ( have_rows('bulles_scen_next_choice') ) : the_row();
														if ( !$countBulles ) { ?>
													    <div class="chat_list_item chat_list_item_new seqItem" data-update="question">
												    		<a href="#" target="_blank">
												    			<img class="avatar" src="<?php echo $avatarUrl; ?>" height="30" width="30" />
												    		</a>
													  <?php } else { ?>
													    <div class="chat_list_item seqItem" data-update="question">	
													  <?php } ?>
											    			<div class="chat_bubble">
											    				<span><?php the_sub_field('bulle_scen_next_choice'); ?></span>
										    				</div>
									    				</div>
												    <?php	

												    $countBulles++;
				    							endwhile;

			    							endif;

				    					endif; // end bulles dialogues

				    					if( get_row_layout() == 'btns_choice_next_next' ):

		    								$rowsChoice = get_sub_field('btns_next_sub_seq');
		    								$otherChoice = get_sub_field('bouton_de_type_choix_other_next');
												$countRows = count( $rowsChoice );

												if( $otherChoice ) {
										  		$countRows = $countRows+1;
										  	} else {
										  		$countRows = $countRows;
										  	}

			    							/*if( $countRows > 2 ) {
									      	$classSlide = 'swiper-slide';
									      	$classCont = 'swiper-container';
									      	$classWrap = 'swiper-wrapper';
								      	} else {
								      		$classSlide = '';
									      	$classCont = 'noslider';
									      	$classWrap = '';
								      	}*/
												if( $countRows > 2 ) {
										    	$chatRepId = 'launch_rep_chat_sequence_' . $countFlex . '_' . $i;
										    } else {
										    	$chatRepId = 'launch_rep_chat_sequence_' . $i . '_' . $countFlex;
										    }
									      echo '<div class="chat_responses choicerep seqItem swiper-container" id="' . $chatRepId . '">';
									      	echo '<div class="chat_response swiper-wrapper">';

										    if( have_rows('btns_next_sub_seq') ):
											    $k = 100;
													while ( have_rows('btns_next_sub_seq') ) : the_row();

													  $scenarChildNext = get_sub_field('ajout_btn_choice_next');
													  if( $scenarChildNext === 'ajout_input_text_2_next' ) {
												    	$nextSeq = 'chat_sequence_other_' . $k . '_' . $countFlex;
												    } else {
												    	$nextSeq = 'normal_flux';
												    } ?>

														<div class="radio btn_chat swiper-slide">
									            <label>
							                  <input type="radio" class="radio" name="choice_<?php echo $a; ?>" id="input<?php echo $a . '_' . $k; ?>" value="<?php the_sub_field('text_btns_next_sub_seq'); ?>" data-next="<?php echo $nextSeq; ?>" />
							                  <?php the_sub_field('text_btns_next_sub_seq'); ?>
								              </label>
									          </div>

									    			<?php	
									    			$k++;
													endwhile;

			    							endif;

			    							echo '</div>';
											echo '</div>';

											if( have_rows('btns_next_sub_seq') ):
												$m = 100;
												while( have_rows('btns_next_sub_seq') ) : the_row(); ?>

													<div id="chat_sequence_other_<?php echo $m . '_' . $countFlex; ?>" class="sequence">

										    		<?php if( get_sub_field('ajout_input_text_bulle_2_next') ) { ?>

										    			<div class="chat_list_item chat_list_item_new" data-update="question">
										    				<a href="#" target="_blank">
										    					<img class="avatar" src="<?php echo $avatarUrl; ?>" height="30" width="30" />
										    				</a>
											    			<div class="chat_bubble">
											    				<span><?php the_sub_field('ajout_input_text_bulle_2_next'); ?></span>
										    				</div>
										  				</div>

										    		<?php } ?>
										    		
														<div class="chat_responses seqItem writerep" id="launch_rep_chat_sequence_<?php echo $a . '_' . $m; ?>">
															<div class="chat_response">
											        	<div class="input_text btn_chat">

											        		<input type="text" class="input_text_text" placeholder="Écrivez un message..." />
											        			<a href="#" class="submit_input">Envoyer</a>

											        	</div>
															</div>
														</div>

								  				</div>

												<?php 
												$m++;
												endwhile;
											endif;


				    					endif; // end boutons de type choix

				    					if( get_row_layout() == 'btns_incr_next_next' ):

				    						$rowsInc = get_sub_field('btns_incr_add');
									      $countRows = count( $rowsInc );	

									      if( have_rows('btns_incr_add') ):
									      	if( $countRows > 2 ) {
									      		$noSlide = '';
										      	$classSlide = 'swiper-slide';
										      	$classCont = 'swiper-container';
										      	$classWrap = 'swiper-wrapper';
									      	} else {
									      		$classSlide = '';
										      	$noSlide = 'noslider';
										      	$classCont = '';
										      	$classWrap = '';
									      	}
									      	
		    									echo '<div class="chat_responses seqItem incrrep ' . $noSlide .'" id="launch_rep_chat_sequence_' . $countFlex . '_' . $i . '">';
							        		echo '<div class="chat_response">';
		    									echo '<div class="incr btn_chat">';
		    									echo '<div class="' . $classCont . '">';
		    									echo '<div class="' . $classWrap . '">';

										    	while ( have_rows('btns_incr_add') ) : the_row();
																					
														$prefixe = get_sub_field('btn_pref_incr');
														$suffixe = get_sub_field('btn_suff_incr');
														$picto = get_sub_field('btn_picto_incr_bool');
													?>
														
								            <div class="datas <?php echo $classSlide; ?>" data-prefixe="<?php echo $prefixe; ?>" data-suffixe="<?php echo $suffixe; ?>">
								            	<div class="inner">
									            	<?php
									            		if( $picto ) { ?>

									            			<div class="picto">
									            				<img src="<?php the_sub_field('btn_picto_incr'); ?>" alt="" />
									            			</div>
									            	<?php }
									            	?>

									              <input type="text" class="incrementbtn" id="input<?php echo $a . '_' . $i; ?>" value="-" placeholder="-" readonly="true" />
									              </div>
								            </div>

									        <?php
									        	
													endwhile;

													echo '</div></div>';
													echo '<div class="submit clearfix">';
									        echo 	'<a href="#" class="increment">Envoyer</a>';
													echo '</div>';
									        echo '</div>';
									        echo '</div>';
									        echo '</div>';

			    							endif;

				    					endif; // end boutons de type choix

				    					//Boutons de type select
									    if( get_row_layout() == 'btn_select_add_next' ):

							        	echo '<div class="chat_responses seqItem selectrep" id="launch_rep_chat_sequence_'. $a . '_' . $i . '">';
											  echo '<div class="chat_response">';
						        		echo '<div class="select btn_chat">';

													if( get_sub_field('btn_select_add') === 'horaire' ) { 

														echo get_template_part('/template-parts/selecthour', 'chat');

													}

													if( get_sub_field('btn_select_add') === 'jours' ) {

														echo get_template_part('/template-parts/selectday', 'chat');

													}

													if( get_sub_field('btn_select_add') === 'type_logement' ) {

														echo get_template_part('/template-parts/selecthousing', 'chat');

													}


													if( get_sub_field('btn_select_add') === 'custom_list' ) {

														echo get_template_part('/template-parts/selectcustom', 'chat');

													}

												echo '</div>';
												echo '</div>';
												echo '</div>';								

									    endif; // end boutons de type select

									    //Boutons de type input
									    if( get_row_layout() == 'btn_input_next' ):

									    	if(get_sub_field('btn_input_text') ) {

							        		echo '<div class="chat_responses seqItem writerep" id="launch_rep_chat_sequence_' . $a . '_' . $i . '">';
												  echo '<div class="chat_response">';
							        		echo '<div class="input_text btn_chat">';

							        		echo '<input type="text" class="input_text_text" placeholder="Écrivez un message..." />';
							        		echo '<a href="#" class="submit_input">Envoyer</a>';


							        		echo '</div>';
													echo '</div>';
													echo '</div>';


									      }

									    endif; // end boutons de type input

									    //Boutons de type zone de texte
									    if( get_row_layout() == 'btn_textarea_next' ):

									    	if(get_sub_field('btn_input_textarea') ) {

							        		echo '<div class="chat_responses seqItem writeZrep" id="launch_rep_chat_sequence_' . $a . '_' . $i . '">';
												  echo '<div class="chat_response">';
							        		echo '<div class="input_textarea btn_chat">';

							        		echo '<textarea rows="5" cols="50" class="input_text_textarea" placeholder="Écrivez un message..."></textarea>';
							        		echo '<a href="#" class="submit_input">Envoyer</a>';


							        		echo '</div>';
													echo '</div>';
													echo '</div>';


									      }

									    endif; // end boutons de type zone de texte

			    					
				    				endwhile;
				    						
									echo '</div>';
			    			endif; // end clone content flexible
			    		}

			    		else if( $scenarChild === 'ajout_input_text_2') { ?>

				    	<div id="chat_sequence_other_<?php echo $a . '_' . $i; ?>" class="sequence">

				    		<?php if( get_sub_field('ajout_input_text_bulle_2') ) { ?>

				    			<div class="chat_list_item chat_list_item_new" data-update="question">
				    				<a href="#" target="_blank">
				    					<img class="avatar" src="<?php echo $avatarUrl; ?>" height="30" width="30" />
				    				</a>
					    			<div class="chat_bubble">
					    				<span><?php the_sub_field('ajout_input_text_bulle_2'); ?></span>
				    				</div>
				  				</div>

				    		<?php } ?>
				    		
								<div class="chat_responses seqItem writerep" id="launch_rep_chat_sequence_<?php echo $i . '_' . $a; ?>">
									<div class="chat_response">
					        	<div class="input_text btn_chat">

					        		<input type="text" class="input_text_text" placeholder="Écrivez un message..." />
					        			<a href="#" class="submit_input">Envoyer</a>

					        	</div>
									</div>
								</div>

		  				</div>

			    	<?php	}

						$i++;
						endwhile;

					endif;

			  endif; // end boutons de type choice bis

				//Boutons de type incrément
			  if( get_row_layout() == 'btn_incr' ):

			    $rowsInc = get_sub_field('btns_incr_add');
			    $countRows = count( $rowsInc );	

			    if( have_rows('btns_incr_add') ):

			    	if( $countRows > 2 ) {
			    		$noSlide = '';
			      	$classSlide = 'swiper-slide';
			      	$classCont = 'swiper-container';
			      	$classWrap = 'swiper-wrapper';
		      	} else {
		      		$classSlide = '';
		      		$noSlide = 'noslider';
			      	$classCont = '';
			      	$classWrap = '';
		      	}

						echo '<div class="chat_responses seqItem incrrep ' . $noSlide . '" id="launch_rep_chat_sequence_' . $countFlex . '_' . $a . '">';
        		echo '<div class="chat_response">';
						echo '<div class="incr btn_chat">';
						echo '<div class="' . $classCont . '">';
						echo '<div class="' . $classWrap . '">';
        		

			    	while ( have_rows('btns_incr_add') ) : the_row();
														
							$prefixe = get_sub_field('btn_pref_incr');
							$suffixe = get_sub_field('btn_suff_incr');
							$picto = get_sub_field('btn_picto_incr_bool');
						?>
							
	            <div class="datas <?php echo $classSlide; ?>" data-prefixe="<?php echo $prefixe; ?>" data-suffixe="<?php echo $suffixe; ?>">
	            	<div class="inner">
		            	<?php
		            		if( $picto ) { ?>

		            			<div class="picto">
		            				<img src="<?php the_sub_field('btn_picto_incr'); ?>" alt="" />
		            			</div>
		            	<?php }
		            	?>

		              <input type="text" class="incrementbtn" id="input<?php echo $a . '_' . $i; ?>" value="-" placeholder="-" readonly="true" />
		              </div>
	            </div>

		        <?php
						endwhile;

						echo '</div></div>';
						echo '<div class="submit clearfix">';
		        echo 	'<a href="#" class="increment">Envoyer</a>';
						echo '</div>';
		        echo '</div>';
		        echo '</div>';
		        echo '</div>';				        

					endif;

			  endif; // end boutons de type incrément

			  //Boutons de type select
			  if( get_row_layout() == 'btn_select' ):

        	echo '<div class="chat_responses selectrep" id="launch_rep_chat_sequence_' . $a . '">';
				  echo '<div class="chat_response">';
      		echo '<div class="select btn_chat">';

      		if( get_sub_field('btn_select_add') === 'horaire' ) { 

						echo get_template_part('/template-parts/selecthour', 'chat');

					}

					if( get_sub_field('btn_select_add') === 'jours' ) {

						echo get_template_part('/template-parts/selectday', 'chat');

					}

					if( get_sub_field('btn_select_add') === 'type_logement' ) {

						echo get_template_part('/template-parts/selecthousing', 'chat');

					}

					if( get_sub_field('btn_select_add') === 'custom_list' ) {

						echo get_template_part('/template-parts/selectcustom', 'chat');

					}

					echo '</div>';
					echo '</div>';
					echo '</div>';								

			  endif; // end boutons de type select	

			  //Boutons de type input
			  if( get_row_layout() == 'btn_input' ):

			    if(get_sub_field('btn_input_text') ) {

        		echo '<div class="chat_responses writerep" id="launch_rep_chat_sequence_' . $a . '">';
					  echo '<div class="chat_response">';
        		echo '<div class="input_text btn_chat">';

        		echo '<input type="text" class="input_text_text" placeholder="Écrivez un message..." />';
        		echo '<a href="#" class="submit_input">Envoyer</a>';

        		echo '</div>';
						echo '</div>';
						echo '</div>';

			    }		    

			  endif; // end boutons de type input

			  //Boutons de type zone de texte
		    if( get_row_layout() == 'btn_textarea' ):

		    	if(get_sub_field('btn_input_textarea') ) {

        		echo '<div class="chat_responses writeZrep" id="launch_rep_chat_sequence_' . $a . '">';
					  echo '<div class="chat_response">';
        		echo '<div class="input_textarea btn_chat">';

        		echo '<textarea rows="5" cols="50" class="input_text_textarea" placeholder="Écrivez un message..."></textarea>';
        		echo '<a href="#" class="submit_input">Envoyer</a>';


        		echo '</div>';
						echo '</div>';
						echo '</div>';


		      }

		    endif; // end boutons de type zone de texte

			  //Boutons de type embed
			  if( get_row_layout() == 'bulle_embed' ):

			    if(get_sub_field('bulle_video_embed') ) {

        		echo '<div class="chat_list_item">';
					  echo '<div class="chat_bubble video_container">';

        		echo get_sub_field('bulle_video_embed');

						echo '</div>';
						echo '</div>';

			    }

			  endif; // end boutons de type embed
			  
			$a++;
			endwhile;

		endif; // end scenario next choice

		?>

		<?php
		//launch Mary popins
		echo get_template_part('/template-parts/submitmary', 'chat'); ?>


	</form>
	<div class="footer-chat"></div>
</div>

<?php 
endwhile; ?>

<?php
get_footer();
