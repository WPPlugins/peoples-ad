<?php
/*
get peoples-ad store data	
*/
class pci_gyrix_view
{
	public function pci_gyrix_get_id()
	{
		if(!is_admin() && !current_user_can('manage_opions'))
        {
			die(0);
		}
		$data = array();
		$pci_id_data = get_option('_peoples_ad_iframe_id');
		if($pci_id_data)
		{
			return  $pci_id_data;
		}
		return(false);
	}
}
