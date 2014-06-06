<?php

function wp_brb_do_page() { ?>
	<form method="post" action="options.php">
		<div class="wrap">
		<?php settings_fields( 'wp_brb_options' ); ?>
		<?php screen_icon(); echo "<h2>". __( 'WP Be Right Back', 'mytextdomain' ) . "</h2>"; ?>
			
            
            
            <div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
					
						
                        <div class="postbox">
                        <h3><span>Holding page activation</span></h3>
                        
                            <div class="inside">
                            <table class="wp_brb_table activate_table">
                            <tbody>
                            <tr>
                            <td class="label activate_label">
                            <input type="checkbox" id="wp_brb_activate" name="wp_brb_activate" value="1"<?php checked( 1 == get_option('wp_brb_activate') ); ?> />
                            </td>
                            <td>
                            <label for="wp_brb_activate">Tick this box to activate the holding page.</label>
                            </td>
                            </tr>
                            <tr>
                            	<td colspan="2">
                                <?php 
								if( get_option('wp_brb_activate') == '' ) {
									
								} elseif( get_option('wp_brb_return_date') == '' && get_option('wp_brb_activate') == 1 ) { 
                                	echo '<p>You have not entered a <a href="#returndate">return date</a>. You will need to manually uncheck this option to show the website.</p>';
                                } else {
									echo '<p>Once the <a href="#returndate">return date</a> has passed, this option will automatically uncheck to show the website.</p>';	
								} ?>
                                </td>
                            </tr>
                            </tbody>
                            </table>
                            </div>
                        
                        </div>
                        
                        
                        <div class="postbox">
                        <h3><span>Date options</span></h3>
                        
                            <div class="inside">
                            <table class="wp_brb_table date_options">
                            <tbody>
                            
                            
                            <tr>
                            <td id="returndate" class="label">
                            	<?php _e( 'Return Date', 'mytextdomain' ); ?>
                                <p class="description">Click in the box to select the date you would like your website to be back online.</p>
                            </td>
                            <td>
                            	<input class="wp_brb_return_date regular-text" id="wp_brb_return_date" type="text" name="wp_brb_return_date" value="<?php esc_attr_e( get_option('wp_brb_return_date') ); ?>" />
						
								<input class="regular-text" id="wp_brb_return_date_format" type="hidden" name="wp_brb_return_date_format" value="<?php esc_attr_e( get_option('wp_brb_return_date_format') ); ?>" />
                            </td>
                            </tr>
                            
                            <tr>
                            <td id="returndate" class="label">
                            	<p class="description">Check this option if you'd like to show the website's return date on the front-end.</p>
                            </td>
                            <td>
                            	<input type="checkbox" id="wp_brb_show_date" name="wp_brb_show_date" value="1"<?php checked( 1 == get_option('wp_brb_show_date') ); ?> /> <label for="wp_brb_show_date"><?php _e( 'Show return date?', 'mytextdomain' ); ?></label>
                            </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                            </tbody>
                            </table>
                            </div>
                        
                        </div>
                        
                        
					
						<div class="postbox">
                        <h3><span>Holding page options</span></h3>
                        
                            <div class="inside">
                            <table class="form-table">
                            
                            
                            <tr valign="top">
                            <th scope="row"><?php _e( 'Holding page logo', 'mytextdomain' ); ?></th>
                            <td>
                            <input id="wp_brb_logo_image" type="text" size="36" name="wp_brb_logo_image" value="<?php esc_attr_e( get_option('wp_brb_logo_image') ); ?>" /> 
                            <input id="wp_brb_logo_" class="button wp_brb_upload_image" type="button" value="Upload Logo" />
                            <p>Enter a URL or upload an image</p>
                            </td>
                            </tr>
                            <tr valign="top">
                            <th scope="row"><?php _e( 'Background image', 'mytextdomain' ); ?></th>
                            <td>
                            <input id="wp_brb_background_image" type="text" size="36" name="wp_brb_background_image" value="<?php esc_attr_e( get_option('wp_brb_background_image') ); ?>" /> 
                            <input id="wp_brb_background_" class="button wp_brb_upload_image" type="button" value="Upload image" />
                            <br/>
                            <input class="background-colour" id="wp_brb_background_colour" type="text" size="36" name="wp_brb_background_colour" value="<?php esc_attr_e( get_option('wp_brb_background_colour') ); ?>" /> 
                            <p>Enter a URL or upload an image or select a colour using the colour picker.</p>
                            </td>
                            </tr>             
                            
                            <tr valign="top">
                            <th scope="row"><?php _e( 'Holding page title', 'mytextdomain' ); ?></th>
                            <td>
                            <input id="wp_brb_holding_title" class="regular-text" type="text" name="wp_brb_holding_title" value="<?php esc_attr_e( get_option('wp_brb_holding_title') ); ?>" />
                            </td>
                            </tr>                     
                            <tr valign="top">
                            <th scope="row"><?php _e( 'Holding page content', 'mytextdomain' ); ?></th>
                            <td>
                            <?php 
                            $content = get_option('wp_brb_holding_content');
                            wp_editor( $content, 'wp_brb_holding_content', array( 'media_buttons' => false, 'textarea_rows' => 5 ) );
                            ?>
                            </td>
                            </tr> 
                            <tr valign="top">
                            <th scope="row"><?php _e( 'Email address', 'mytextdomain' ); ?></th>
                            <td>
                            <input id="wp_brb_email" class="regular-text" type="text" name="wp_brb_email" value="<?php esc_attr_e( get_option('wp_brb_email') ); ?>" />
                            <p>Enter the email address you'd like to show on the front-end.</p>
                            </td>
                            </tr>
                            <tr valign="top">
                            <th scope="row"><?php _e( 'Telephone number', 'mytextdomain' ); ?></th>
                            <td>
                            <input id="wp_brb_telephone" class="regular-text" type="text" name="wp_brb_telephone" value="<?php esc_attr_e( get_option('wp_brb_telephone') ); ?>" />
                            <p>Enter the telephone number you'd like to show on the front-end.</p>
                            </td>
                            </tr> 
                            </table> 
						</div>
						
					</div>
                    </div>
					
					<div id="postbox-container-1" class="postbox-container">
						<div id="side-sortables">
					
							<div class="postbox">
								<h3 class="hndle"><span>Save options</span></h3>
								<div class="inside">
									<p>Once you're happy with the settings, save them by clicking the button below.</p>
									
											<span class="spinner"></span>											
											<div id="save-action">
												<input id="publish" class="button-primary" type="submit" value="<?php _e( 'Save', 'mytextdomain' ); ?>" />
											</div>
									
								</div>
							</div>
						
						</div>
					</div>
					
					
				</div>
			</div>
		</div>
	</form> 
<?php }