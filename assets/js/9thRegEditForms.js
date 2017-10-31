    $(document).ready( function() {

    $('#example').dataTable({
              "bJQueryUI": true,
              "sPaginationType": "full_numbers",
              "bAutoWidth": false
        });

        jQuery(".delete_record").live("click",function(event){
              event.preventDefault();
              var x = confirm("Are You Sure You Want To Delete This Record?");
                  if (x) {
                  jQuery.ajax({
                          type: 'post',
                          url: "ajax.php",
                          data: 'deleterecord='+jQuery(this).attr("id"),
                          success: function (data2) {
                            var arr2 = $.parseJSON(data2);
                                    noty({
                                        text: arr2.msg,
                                        type: arr2.type,
                                        dismissQueue: false,
                                        layout: "bottom",
                                        theme: 'defaultTheme'
                                    });
                                      setTimeout(function() {
                                        //$.noty.closeAll();
                                        location.reload();
                                      }, 3000);
                          }
                      });
                  return false;
                  }else {
                  return false;
                  }    
             });      
      
      });
