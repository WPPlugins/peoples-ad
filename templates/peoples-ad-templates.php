<?php

class pci_gyrix_get_html
{
	public function pci_gyrix_header()
	{
		?>
			<div id="pci-template-page">
			<h2>Peoples-Ad Iframe Settings Page</h2>
			<form method="post" name="update_pci" id="update_pci">
				<div class="pci_template_block">
		<?php
	}
	
	public function pci_gyrix_footer()
	{
		?>
			</div>
			</form>
			<button class="save_pci" style="margin-top:10px;">Save</button>
			</div>
		<?php
	}
	
	// show store id field
	public function pci_gyrix_show($item)
	{
		if(is_admin() || current_user_can('manage_opions'))
		{		
		?>
		<div class="pci_block block_pci">			
			<div class="pci_div">			
					<div><table class="table-style">
							<tr>
								<td>
									<span>Store ID</span>
								</td>
								<td>
									<input type="text" name="pci_store_id" value="<?php echo $item; ?>" class="input-style"  id="pci_store_id">										
								</td>
							</tr>
							
						</table>
					</div>
						
			</div>
		</div>
		<?php
		}	
	}
}