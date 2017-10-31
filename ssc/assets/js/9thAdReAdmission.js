$(document).ready(

  function()
    {
       $("#ReturnStatus").validate();

      $('#proceed').click(function(e)
        {
           var oldRno = $("#oldRno").val();
         $.ajax({
                      type: 'post',
                      url: "ajax.php",
                      data: "oldRno=" + oldRno,
                      success: function (msg) 
                      {
                       if(msg == 0) $(".return_msg").html('No Record Found');
                      }
                 });//======Closing of .ajax
    
      });//======Closing of proceed click event
      
    });//======= closing of Document of jqury
