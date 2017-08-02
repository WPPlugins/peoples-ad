<?php
/*
add/update peoples ad id to database 
*/
class pci_GyrixSave
{
	public function pci_gyrix_save()
	{	
		
		check_ajax_referer( 'saveGyrixURL'.get_current_user_id(), 'security' );
		if(!is_admin() && !current_user_can('manage_opions'))
        {
			die(0);
		}
		$pci_option_store_id = update_option($_POST['pci_id_action'],$_POST['pci_store_id']);
		
		if($pci_option_store_id == 1 || $pci_option_store_id == 0)
		{
			die("Updated");			
		}
		else
		{
			die("error");
		}
	}
}


