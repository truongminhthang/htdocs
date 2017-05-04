<?php 
// shortcode Progess bar
if ( !function_exists('univ_progres_bar_shortcode') ) {
	function univ_progres_bar_shortcode($atts,$content=null){
		extract(shortcode_atts(
			array(
			'id' => 'prog',				
			'height' => '6',
			'bgcolor' => '#fff',
			'bwidth' => '0',
			'bdcolor' => '',		
			'color' => '#337ab7',
			'tcolor' => '#444',
			'title' => 'Web Development',
			'value' => '80',			
			'duration' => '1.5',			
			'delay' => '1.2'			
			),$atts));

		return '
			<style type="text/css">
				#progressid'.$id.' {border-width:'.$bwidth.';border-style:solid; border-color:'.$bdcolor.';height:'.$height.'px;background-color:'.$bgcolor.'}		
				#progressbar'.$id.' {background-color:'.$color.'}
				#tooltipbg'.$id.' {background-color:'.$color.';color:'.$tcolor.'}
				#tooltipbg'.$id.'::before {border-color:'.$color.' transparent transparent;}
				#textcolor'.$id.'  {color:'.$tcolor.'}
			</style>	
			
		<div class="skill-bars">
			<div class="skill">
				<div class="progress" id="progressid'.$id.'">
				 <div id="textcolor'.$id.'" class="lead">'.$title.'</div>
				 <div class="progress-bar wow fadeInLeft" id="progressbar'.$id.'" data-progress="'.$value.'%" style="width: '.$value.'%;" data-wow-duration="'.$duration.'s" data-wow-delay="'.$delay.'s"> <span id="tooltipbg'.$id.'">'.$value.'%</span></div>
				</div>
			</div>
		</div>              	
		';

	}//[progress id="p1" height="6" bgcolor="#f00" bwidth="1" color="#f00" title="web development" tcolor="#000" " value="80" duration="1.5" delay="1.2"]
}//end if	
add_shortcode('progress','univ_progres_bar_shortcode');

//1. Add a new form element...
if ( !function_exists('univ_register_form') ) {
	function univ_register_form() {
		  $user_mobile = ( ! empty( $_POST['user_mobile'] ) ) ? trim( $_POST['user_mobile'] ) : '';
		   ?>
			<p>
				<label for="user_mobile"><?php _e( 'Phone', 'univ' ) ?><br />
				<input type="text" name="user_mobile" id="user_mobile" class="input" value="<?php echo esc_attr( wp_unslash( $user_mobile ) ); ?>" size="25" />
				</label>
			</p>
			<?php	
	}
}
add_action( 'register_form', 'univ_register_form' );




//2. Add validation. In this case, we make sure user mobile is required.
if ( !function_exists('univ_registration_errors') ) {
    function univ_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        
        if ( empty( $_POST['user_mobile'] ) || ! empty( $_POST['user_mobile'] ) && trim( $_POST['user_mobile'] ) == '' ) {
            $errors->add( 'user_mobile', __( '<strong>ERROR</strong>: You must include a mobile Number.', 'mydomain' ) );
        }
        return $errors;
    }
}
add_filter( 'registration_errors', 'univ_registration_errors', 10, 3 );
	
	
	

//3. Finally, save our extra registration user meta.
if ( !function_exists('univ_user_register') ) {
    function univ_user_register( $user_id ) {
        if ( ! empty( $_POST['user_mobile'] ) ) {
            update_user_meta( $user_id, 'user_mobile', trim( $_POST['user_mobile'] ) );
        }
    }
}
add_action( 'user_register', 'univ_user_register' );
	
	
	
//show admin bar
if ( !function_exists('univ_custom_user_profile_fields') ) {
	function univ_custom_user_profile_fields($user) {?>
		<table class="form-table">
			<tbody>
				<tr class="user-first-name-wrap">
					<th><label for="user_mobile"><?php esc_html_e( 'Phone', 'univ' ) ?></label></th>
					<td><input name="user_mobile" id="user_mobile" value="<?php echo esc_attr( get_the_author_meta( 'user_mobile', $user->ID, true ) ); ?>" class="regular-text" type="text"></td>
				</tr>
			</tbody>
		</table>	
	<?php }
}
add_action('show_user_profile', 'univ_custom_user_profile_fields');
add_action('edit_user_profile', 'univ_custom_user_profile_fields');
add_action('personal_options_update', 'univ_user_register');
add_action('edit_user_profile_update', 'univ_user_register');




// chenge wp site logo 
 if ( !function_exists('univ_login_logo') ) {
 function univ_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/image/logo.png);
            padding-bottom: 0px;
        }	
		body.login {
		  background: #ffffff none repeat scroll 0 0;
		}
		body.login div#login {}
		body.login div#login h1 {}
		body.login div#login h1 a {}
		body.login div#login form#loginform {
		  border-radius: 10px;
		  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		body.login div#login form#loginform p {}
		body.login div#login form#loginform p label {}
		body.login div#login form#loginform input {}
		body.login div#login form#loginform input#user_login {
			background:transparent;
			box-shadow:none;
			border: 1px solid #f1f1f1;
		}
		body.login div#login form#loginform input#user_pass {
			background:transparent;
			box-shadow:none;
			border: 1px solid #f1f1f1;
			
		}
		body.login div#login form#loginform p.forgetmenot {}
		body.login div#login form#loginform p.forgetmenot input#rememberme {}
		body.login div#login form#loginform p.submit {}
		body.login div#login form#loginform p.submit input#wp-submit {
		  background: #f5b120 none repeat scroll 0 0;
		  border: 0 none;
		  box-shadow: none;
		  color: #ffffff;
		  text-shadow: none;
		  transition:.5s;
		}
		body.login div#login form#loginform p.submit input#wp-submit:hover{
			background:#1bb4b9;
		}
		body.login div#login p#nav {}
		body.login div#login p#nav a {
		  padding: 0 5px;
		}
		body.login div#login p#backtoblog {}
		body.login div#login p#backtoblog a {}	


		.wp-core-ui .button-group.button-large .button, .wp-core-ui .button.button-large {
		  background: #f5b120 none repeat scroll 0 0;
		  border: 0 none;
		  box-shadow: none;
		  color: #ffffff;
		  text-shadow: none;
		  transition:.5s;
		}	
		
    </style>
 <?php }}
add_action( 'login_enqueue_scripts', 'univ_login_logo' );

// Logo Link
if ( !function_exists('univ_login_logo_url') ) {
	function univ_login_logo_url() {
		return home_url();
	}
}
add_filter( 'login_headerurl', 'univ_login_logo_url' );

// logo url title
if ( !function_exists('univ_login_logo_url_title') ) {
	function univ_login_logo_url_title() {
		return 'Powered By Univ';
	}
}
add_filter( 'login_headertitle', 'univ_login_logo_url_title' );
 
 
 