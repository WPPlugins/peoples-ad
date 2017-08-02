<?php
/**
 * Plugin Name:Peoples-Ad
 * Plugin URI: https://wordpress.org/plugins/peoples-ad
 * Description: Peoples-Ad Iframe will display after payment confirmation
 * Author: Gunnar Risnes, Peoples-Ad and Gyrix TechnoLabs
 * Author URI: https://www.peoples-ad.com/
 * Requires at least: 4.0
 * Tested up to: 4.8
 * Version: 1.0.1
 */
if (!defined('ABSPATH'))
{
    exit; // Exit if accessed directly
}
if(!defined('PAYMENT_TEMPLATEPATH'))
{
	define('PAYMENT_TEMPLATEPATH', plugin_dir_path(__FILE__));
	define('PAYMENT_TEMPLATEURL', plugin_dir_url(__FILE__));
}
// Include main file of plugin
include_once( dirname(__FILE__).'/includes/peoples-ad-confirmation.php' );

/**
 * Main instance of plugin.
*/

// to do when activate plugin
function pci_gyrix_register()
{
	if(is_admin() || current_user_can('manage_opions'))
	{
		pci_hooks_gyrix::pci_get_instance();
	}
	
	
}
add_action('init', 'pci_gyrix_register');
 
function pci_pluginprefix_install()
{
	if(is_admin() || current_user_can('manage_opions'))
	{	    
	    pci_gyrix_register();
	}
}
register_activation_hook(__FILE__, 'pci_pluginprefix_install');

// to do when de-activate plugin
function pci_gyrix_plugin_deactivation() 
{	
    flush_rewrite_rules(); 
}
register_deactivation_hook( __FILE__, 'pci_gyrix_plugin_deactivation' );

//add iframe when woocommerce_thankyou hook call
add_action( 'woocommerce_thankyou', 'pci_payment_confirm' , 10 , 3 );

function pci_payment_confirm($order_id){

	$order = new WC_Order( $order_id ); 
	if(isset($order) && !$order->has_status( 'failed' ) && !$order->has_status( 'cancelled' ))
	{
		$items = $order->get_items(); 
		$product_id = 0;
		foreach ($items as $item) 
		{
			$product_id = $item['product_id'];
			break;
		}
		$pci_store_id_value = get_option('_peoples_ad_iframe_id');

		if($product_id != 0 && $pci_store_id_value != '')
	    {
	    	echo '<div style="text-align: center;"><iframe style="width:350px; height:390px;" frameborder="0" src="https://www.peoples-ad.com/Publishad/ExternalView?id='.$product_id.'&providerid='.$pci_store_id_value.'"></iframe></div>';
	    }
	}
	
}

class pci_hooks_gyrix 
{
	private static $instance;

    static function pci_get_instance()
	{
		if (!isset(self::$instance))
	    {
	        self::$instance = new self();
	    }
	    return self::$instance;
	}

	public function __construct()
	{	
		//Create CPT			
		$obj_gyrix_manager = new pci_gyrix_manager;
	}
	
}
