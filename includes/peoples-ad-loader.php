<?php
/*
* Include css,js files and create menu
*/

class pci_gyrix_manager_load
{	
	// Add css
	public function pci_gyrixenqueue_styles() 
    {	 
        if(is_admin() || current_user_can('manage_opions'))
        {
        	wp_enqueue_style(
                'payment_gyrixcss',
                PAYMENT_TEMPLATEURL . 'admin/css/peoples-ad-gyrixcss.css',
                array(), 
                '1.0.0'
            );
           
        }
    }
	// Add menu
	public function pci_gyrixcallhooks()
    {
        if(is_admin() || current_user_can('manage_opions'))
        {
            add_menu_page( 'Peoples-Ad Iframe', 'Peoples-Ad Iframe', 'administrator', 'peoples-ad-gyrix-settings', array($this, 'pci_gyrix_settings_page') , 'dashicons-welcome-widgets-menus');           
        }
    }
    // Add settings page
    public function pci_gyrix_settings_page() 
	{	
		if(is_admin() || current_user_can('manage_opions'))
        {
            $gyrixhtml = new pci_gyrix_get_html;
            $gyrixView = new pci_gyrix_view;
            $viewData = $gyrixView->pci_gyrix_get_id();
            $gyrixhtml->pci_gyrix_header();           
            $gyrixhtml->pci_gyrix_show($viewData);           
            $gyrixhtml->pci_gyrix_footer();
        }
	}
    
    // Add script and nonce
    public function pci_gyrixenqueue_jscript() 
    {
        if(is_admin() || current_user_can('manage_opions'))
        {
            $userId = get_current_user_id();
            $ajaxSendGyrix = array(
                'ajaxSaveGyrix'=> wp_create_nonce('saveGyrixURL'. $userId ),
                'ajaxSaveOptionGyrix'=> wp_create_nonce('saveGyrixOptions'. $userId ),
                );
                wp_register_script(
                    'pci_templatejs',
                    PAYMENT_TEMPLATEURL . 'admin/js/peoples-ad-save-script.js',
                    array(), 
                    '1.0.0' 
                );
            wp_localize_script( 'pci_templatejs', 'gyrixrepaymentnonce', $ajaxSendGyrix );
            wp_enqueue_script('pci_templatejs');
        }
    }
}