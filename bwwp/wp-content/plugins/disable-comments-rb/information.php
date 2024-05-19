<?php
/*
 * RB Disable Comments
 * Version:           1.0.9 - 38451
 * Author:            RBS
 * Date:              03 02 2020 12:11:29 GMT
 */

if (!defined('WPINC') || !defined("ABSPATH")) {
	die();
}
/* wp_enqueue_script( array(  'updates') );
add_thickbox(); */

/*add_action('admin_menu', 'disable_comments_rb_js');
function disable_comments_rb_js() {
    add_thickbox();
}
*/
?>
<style type="text/css">
	.rbs_nw_wrap {
		margin-bottom: 10px;
		display: grid;
		grid-template-columns: 1fr 1fr 1fr 1fr;
		column-gap: 15px;
		margin-right: 25px;
	}

	.rbs_nw_item {
		background-color: #f9f9f9;
		margin: 0;
	}

	.rbs_nw_item_logo {
		text-align: center;
		padding-top: 10px;
		padding-bottom: 1px;
	}

	.rbs_nw_item_logo_plugin {
		width: 100px;
		height: 100px;
	}

	.rbs_nw_item_logo_upz {
		margin-top: 10px;
		margin-bottom: 1px;
		width: 225px;
		height: 66px;
	}

	.rbs_nw_item_header {
		text-align: center;
		text-align: center;
		line-height: 1.4em;
		min-height: 40px;
		padding: 5px;
		margin-top: 5px;
	}

	.rbs_nw_item_button {
		text-align: center;
		margin-bottom: 15px;
	}


	@media only screen and (max-width: 1100px) {
		.rbs_nw_wrap {
			grid-template-columns: 1fr 1fr;
		}

		.rbs_nw_item {
			margin-bottom: 15px;
		}
	}

	@media only screen and (max-width: 800px) {
		.rbs_nw_wrap {
			grid-template-columns: 1fr;
			column-gap: 0;
			row-gap: 15px;
			margin: 0;
		}

		.rbs_nw_item {
			margin-bottom: 0px;
			display: none;
		}

		.rbs_nw_item:nth-child(1),
		.rbs_nw_item:nth-child(2) {
			display: block;
		}

		.rbs_nw_item_header {
			margin-bottom: 0px;
		}

		.rbs_nw_item_logo {
			text-align: left;
			float: left;
		}

		.rbs_nw_item_logo_upz {
			margin-top: 7px;
			margin-bottom: 7px;
			width: 120px;
			height: 80px;
		}

		.rbs_nw_item_logo_plugin {
			margin-top: 0px;
			margin-left: 15px;
			margin-right: 5px;
			margin-bottom: 2px;
			width: 80px;
			height: 80px;
		}
	}

	.rbs-info-oneline {
		margin-bottom: 10px;
		display: grid;
		grid-template-columns: 1fr;
		grid-template-rows: 1fr;
		column-gap: 0;
		margin-right: 25px;
		justify-items: start center;
		background-color: #f9f9f9;
	}

	.rbs-info-oneline-item {
		margin: 0;
	}

	.rbs-info-oneline-header {
		text-align: left;
		padding: 5px;
		font-size: 22px;
		padding-left: 20px;
		;
	}

	.rbs-info-oneline-header a:not(.class){
		margin-left: 40px;
		
	}

	@media only screen and (max-width: 800px) {
		.rbs-info-oneline-header {		
		line-height: 32px;
		
		;
	}
	}
</style>

<?php 

$urlPlugin = plugin_dir_url(__FILE__); 
	
$plugin = "forms-rb";
$plugin_dir = WP_PLUGIN_DIR . '/'.$plugin;
$plugin_file = $plugin . '/' . $plugin . '.php';
$is_active = is_plugin_active($plugin_file);

if(!$is_active){

?>
<div class="rbs-info-oneline">

	<div class="rbs-info-oneline-item">

		<h3 class="rbs-info-oneline-header">
			<?php _e('RB Forms - absolutely FREE contact form plugin for WordPress'); ?>
			<a class="button-primary " aria-label="Install Rb Forms" data-title="Install Rb Forms" href="<?php
								
				  //file_exists($plugin_file)				
				if ( is_dir( $plugin_dir ) ){ 					

					if ( strpos( $plugin_file, '/' ) ) {
						$plugin_file = str_replace( '\/', '%2F', $plugin_file );
					}
					$url = sprintf( admin_url( 'plugins.php?action=activate&plugin=%s&plugin_status=all&paged=1' ), $plugin_file );
					$url =  wp_nonce_url( $url, 'activate-plugin_' . $plugin_file );
					echo $url;
				} else {					
					echo esc_url(
						wp_nonce_url(  self_admin_url('update.php?action=install-plugin&plugin=' . $plugin), 'install-plugin_' . $plugin)
					);
				}								
				//echo esc_url(network_admin_url('plugin-install.php?tab=plugin-information&amp;plugin=forms-rb&amp;TB_iframe=true&amp;width=772&amp;height=378') );
				?>">
				<?php _e('Install Rb Forms'); ?>
			</a>
		</h3>

	</div>
</div>
<?php 
}
return ; ?>
<div class="rbs_nw_wrap">	
	<div class="rbs_nw_item">
		<div class="rbs_nw_item_logo">
			<img class="rbs_nw_item_logo_plugin" src="<?php echo $urlPlugin; ?>assets/images/logo_dp.png" width="100" hight="100">
		</div>
		<h3 class="rbs_nw_item_header">
			<?php _e('Simple plugin that allows you to duplicate post easily'); ?>
		</h3>
		<div class="rbs_nw_item_button">
			<a class="button-primary thickbox" href="<?php
														echo self_admin_url('plugin-install.php?tab=plugin-information&amp;plugin=duplicate-post-rb&amp;TB_iframe=true');
														?>">
				<?php _e('Install Duplicate Post'); ?>
			</a>
		</div>
	</div>

	<div class="rbs_nw_item">
		<div class="rbs_nw_item_logo">
			<img class="rbs_nw_item_logo_plugin" src="<?php echo $urlPlugin; ?>assets/images/logo_drc.png" width="100" hight="100">
		</div>
		<h3 class="rbs_nw_item_header">
			<?php _e('Simple plugin that allows you to disable right click option easily'); ?>
		</h3>
		<div class="rbs_nw_item_button">
			<a class="button-primary thickbox" href="<?php
														echo self_admin_url('plugin-install.php?tab=plugin-information&amp;plugin=disable-right-click-rb&amp;TB_iframe=true');
														?>">
				<?php _e('Install Disable Right Click'); ?>
			</a>
		</div>
	</div>

	<div class="rbs_nw_item">
		<div class="rbs_nw_item_logo">
			<img class="rbs_nw_item_logo_plugin" src="<?php echo $urlPlugin; ?>assets/images/logo_rg.gif" width="100" hight="100">
		</div>
		<h3 class="rbs_nw_item_header">
			<?php _e('Create Free Gallery with Premium features with Robo Gallery'); ?>
		</h3>
		<div class="rbs_nw_item_button">
			<a class="button-primary thickbox" href="<?php
														echo self_admin_url('plugin-install.php?tab=plugin-information&amp;plugin=robo-gallery&amp;TB_iframe=true');
														?>">
				<?php _e('Install Gallery'); ?>
			</a>
		</div>
	</div>

	<div class="rbs_nw_item">
		<div class="rbs_nw_item_logo">
			<img class="rbs_nw_item_logo_upz" src="<?php echo $urlPlugin; ?>assets/images/upzilla_black_logo.svg" width="225" hight="67">
		</div>
		<h3 class="rbs_nw_item_header">
			<?php _e('Free website uptime and performance monitoring service for your WordPress', 'disable-comments-rb'); ?>
		</h3>
		<div class="rbs_nw_item_button">
			<a class="button-primary" href="https://www.upzilla.co/?pk_campaign=wp_dc" target="_blank">
				<?php _e('Register Free Account'); ?></a>
		</div>
	</div>
</div>