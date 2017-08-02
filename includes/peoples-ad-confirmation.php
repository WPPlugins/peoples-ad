<?php 
/**
* Hook list
*/

class pci_gyrix_manager
{	
	public function __construct()
	{	
		$this->pci_init_plugin();
	}
	public function pci_init_plugin()
	{	
		 $this->pci_load_files();
		 $gyrixrepaymentfront = new pci_gyrix_manager_load;
		 add_action('admin_menu', array($gyrixrepaymentfront, 'pci_gyrixcallhooks'));
		 add_action( 'admin_enqueue_scripts', array($gyrixrepaymentfront, 'pci_gyrixenqueue_styles' ));
		 add_action( 'admin_enqueue_scripts', array($gyrixrepaymentfront, 'pci_gyrixenqueue_jscript' ));

		 $gyrixpages = new pci_GyrixSave;
		 add_action('wp_ajax_pci_save',array($gyrixpages , 'pci_gyrix_save' ));
	}
	public function pci_load_files()
	{	
		if(is_admin() || current_user_can('manage_opions'))
        {
			include_once(PAYMENT_TEMPLATEPATH.'/includes/peoples-ad-loader.php');
			include_once(PAYMENT_TEMPLATEPATH."/templates/peoples-ad-templates.php");
			include_once(PAYMENT_TEMPLATEPATH.'/admin/inc/peoples-ad-save.php');
			include_once(PAYMENT_TEMPLATEPATH.'/admin/inc/peoples-ad-view.php');			
		}
	}
}
?>