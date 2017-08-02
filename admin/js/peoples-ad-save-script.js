jQuery(document).ready(function(e) {
    
    jQuery(".save_pci").click(function() {
         
        var store_id = jQuery('#pci_store_id').val();         
        //save peoples ad store id
        jQuery.ajax({
            url : ajaxurl,
            data : {
                action : "pci_save",
                pci_id_action : "_peoples_ad_iframe_id",
                pci_store_id : store_id,
                security : gyrixrepaymentnonce.ajaxSaveGyrix
            },
            type : "POST",
            success : function(e) {
                console.log(e);
                e = e.replace(/^\s+|\s+$/g, '');
                if(e == 'error')
                {
                    alert('Error While action');
                    location.reload();
                }
                else
                {
                    e ? (alert("Updated Successfully"), location.reload()) : console.log("Not updated")
                }
                
            }
       });
    });    
});
