<?php
/**
Plugin Name: ShopCode Popup Profile Builder
Plugin URI: https://wordpress.org/plugins/shopcode-popup-profile-builder
Description: ShopCode show product WooCommerce owl carousel on categories responsive 
Author: shopcode
Version: 1.0
Author URI: shopcode.org
*/
#prefix: ppb
#CLASS PPB_Popup_Profile_Builder
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Define Path 
*/
define( 'SHOPCODE_PPB_PLUGIN_URI', plugin_dir_url( __FILE__ ));
/**
 * Adding scripts
 */
 add_action( 'wp_enqueue_scripts', 'shopcode_ppb_adding_scripts' ); 	
 if( !function_exists('shopcode_ppb_adding_scripts') ){
	function shopcode_ppb_adding_scripts() {	    /*add ppb_jquery_last fix noConflict*/			wp_add_inline_script( 'jquery-core', 'ppb_jquery_last = jQuery;' );				/*include Bootstrap*/	        wp_register_style( 'ppb-include-bootstrap-css',  SHOPCODE_PPB_PLUGIN_URI.'bootstrap/css/bootstrap.css', '', '4.0', false );	    wp_enqueue_style( 'ppb-include-bootstrap-css' );		wp_register_script( 'ppb-include-bootstrap-js', SHOPCODE_PPB_PLUGIN_URI.'bootstrap/js/bootstrap.min.js', array('jquery'), '4.0', true );		wp_enqueue_script( 'ppb-include-bootstrap-js' );		
		/*include main_css*/	
		wp_register_style( 'ppb_owl_main_style', SHOPCODE_PPB_PLUGIN_URI.'assets/css/main.css', '', '1.0', false );
		wp_enqueue_style( 'ppb_owl_main_style' );					/*include main_scripts*/ 
		wp_register_script( 'ppb_main_scripts', SHOPCODE_PPB_PLUGIN_URI.('assets/js/main.js'), array( 'jquery'), '1.0', true );		wp_add_inline_script( 'ppb_main_scripts', 'var ppb_jquery_last = $.noConflict(true);', 'before');        wp_enqueue_script( 'ppb_main_scripts' );
	}}/**
 * CLASS WIDGET
 */
class PPB_Popup_Profile_Builder extends WP_Widget {//	@var string (The plugin version)		
	var $version = '1.0';
	//	@var string $localizationDomain (Domain used for localization)
	var $localizationDomain = 'ppb-popup-profile-builder';
	//	PHP 5 Constructor		
	function __construct() {
		$ppb_basename = dirname ( plugin_basename ( __FILE__ ) );
		$widget_ops = array (
		'classname' => $ppb_basename, 
		'description' => __ ( 'Show Popup Profile Builder', $this->localizationDomain ) 
		);
		parent::__construct( $ppb_basename, __ ( 'Show Popup Profile Builder', $this->localizationDomain ), $widget_ops );
	}

	function widget($args, $instance) {
		extract ( $args );			$title = $instance['title'];
	    $check_show_popup = apply_filters ( 'check_show_popup', isset ( $instance ['check_show_popup'] ) ? ( bool ) $instance ['check_show_popup'] : ( bool ) false );		echo '<h3>'.$title.'</h3>';
		echo $before_widget;
?>
<?php if($check_show_popup = true){global $current_user;$current_user = wp_get_current_user();$user_id = $current_user->ID;$user_email = $current_user->user_email;	  	  ?><div class="clearfix"></div> <div id="ppb-popup-profile-builder" class="ppb-popup-profile-builder no-js"><!-- Button Login - Register  --><button type="button" class="btn btn-primary ppblogin" onclick="ppbFunction()" data-toggle="modal" data-target="#ppb_login"><?php if($user_id !=0){ ?>	  	 <?php _e('Logout', $this->localizationDomain);  ?>  	  <?php	  }else{	  ?>	  	   <?php _e('Login', $this->localizationDomain);  ?> <?php } ?>  </button><button type="button" class="btn btn-primary ppbregister" onclick="ppbFunction()" data-toggle="modal" data-target="#ppb_register"> <?php _e('Register', $this->localizationDomain);  ?></button><!-- LOGIN --><div id="ppb_login"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">  <div class="modal-dialog modal-dialog-centered" role="document">    <div class="modal-content">      <div class="modal-header">        <h5 class="modal-title" id="ppb_ModalLongTitle"> <?php _e('Login', $this->localizationDomain);  ?></h5>        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">          <span aria-hidden="true">&times;</span>        </button>      </div>	       <div class="modal-body">      <?php echo do_shortcode('[wppb-login]'); ?>      </div>	  		        <div class="modal-footer">	  	  <?php if($user_id !=0){ ?>	  	  	  <?php	  }else{	  ?>			<button type="button" class="btn button-recover" data-toggle="modal" data-target="#ppb_forgot_pass"> <?php _e('Forgot password', $this->localizationDomain);  ?> </button>		<?php } ?>	   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Close', $this->localizationDomain);  ?> </button>             </div>    </div>  </div></div><!-- Register --><div id="ppb_register" class="modal fade" role="dialog">  <div class="modal-dialog">    <!-- Modal content-->    <div class="modal-content">     <div class="modal-header">        <h5 class="modal-title" id="ppb_ModalLongTitle"><?php _e('Register', $this->localizationDomain);  ?> </h5>        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">          <span aria-hidden="true">&times;</span>        </button>      </div>      <div class="modal-body">	  	   <?php echo do_shortcode('[wppb-register]'); ?>      </div>      <div class="modal-footer">	  	  <?php if($user_id !=0){ ?>	  	  	  <?php	  }else{	  ?>	  	  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ppb_login_when_register"> <?php _e(' Login', $this->localizationDomain);  ?> <?php }?> </button>        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Close', $this->localizationDomain);  ?> </button>             </div>    </div>  </div></div><!-- Forgot Password --><div id="ppb_forgot_pass" class="modal fade" role="dialog">  <div class="modal-dialog">    <!-- Modal content-->    <div class="modal-content">         <div class="modal-header">        <h5 class="modal-title" id="ppb_ModalLongTitle">  <?php _e('Recover password', $this->localizationDomain);  ?>   </h5>        <button type="button" class="close" data-dismiss="modal" aria-label="Close">          <span aria-hidden="true">&times;</span>        </button>      </div>      <div class="modal-body">	  		 <?php echo do_shortcode('[wppb-recover-password]'); ?>      </div>      <div class="modal-footer">        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Close', $this->localizationDomain);  ?> </button>		      </div>    </div>  </div></div><!-- Login_when_register --><div id="ppb_login_when_register" class="modal fade" role="dialog">  <div class="modal-dialog">    <!-- Modal content-->    <div class="modal-content">         <div class="modal-header">        <h5 class="modal-title" id="ppb_ModalLongTitle"><?php _e('Login', $this->localizationDomain);  ?> </h5>        <button type="button" class="close" data-dismiss="modal" aria-label="Close">          <span aria-hidden="true">&times;</span>        </button>      </div>      <div class="modal-body">	  		<?php echo do_shortcode('[wppb-login]'); ?>      </div>      <div class="modal-footer">        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Close', $this->localizationDomain);  ?> </button>		      </div>    </div>  </div></div><!-- Modal --> </div>
<div class="clearfix"></div>		
<?php } ?>
<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
	function form($instance) {	$title = esc_attr($instance['title']);
$check_show_popup = isset ( $instance ['check_show_popup'] ) ? ( bool ) $instance ['check_show_popup'] : true;
?>	<p>			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />		</p>		
<p>
<input id="<?php echo $this->get_field_id('check_show_popup'); ?>"
	name="<?php echo $this->get_field_name('check_show_popup'); ?>"
	type="checkbox" <?php checked($check_show_popup); ?> /> <label
	for="<?php echo $this->get_field_id('check_show_popup'); ?>"><?php _e('Show Popup Profile Buider'.'</br>	Require install Plugin: <a href="https://wordpress.org/plugins/profile-builder/" target="_blank">Profile Builder</a></br>	Using ShortCode: <a href="https://wordpress.org/plugins/widget-shortcode/" target="_blank">Widget Shortcode</a></br>	Plugin Popup: <a href="https://wordpress.org/plugins/shopcode-popup-profile-builder" target="_blank">Popup Profile Builder</a></br>		', $this->localizationDomain); ?></label><br />
</p>

<?php 
    }
} // End Class PPB_Popup_Profile_Builder

add_action('widgets_init', create_function('', 'return register_widget("PPB_Popup_Profile_Builder");'));
?>