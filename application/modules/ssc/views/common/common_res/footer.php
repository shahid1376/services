<footer>
    <p>
        &copy; BiseAdmin 2015
    </p>
</footer>

<!--Add the following script at the bottom of the web page (before </body></html>)-->

<script src="<?php echo base_url(); ?>ssc/assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>ssc/assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>ssc/assets/js/jquery.scrollUp.js"></script>
<script src="<?php echo base_url(); ?>ssc/assets/js/wysiwyg/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ssc/assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ssc/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ssc/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ssc/assets/js/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ssc/assets/js/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url(); ?>ssc/assets/js/jquery-ui.js"></script>

<?php 
if(isset($files)){
    foreach($files as $file){
        echo '<script type="text/javascript" src="'.base_url().'ssc/assets/js/'.$file.'"></script>';
    }
}
?> 
<script type="">
    $(document).ready(function () {
        $('#data-table').dataTable({
            "sPaginationType": "full_numbers",
            "cache": false
        });
        $('#data-tablereg').dataTable({
            "sPaginationType": "full_numbers",
            "cache": false
        });
    });

</script>
<script type="">



    function downloadslip9th(rno,isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>result/resultcard9th/'+rno+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
     function downloadgroupwise11(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>result/resultcard11thgroupwise/'+$("#std_group").val()+'/'+isdownload

        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadgroupwise12(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>result/resultcard12thgroupwise/'+$("#std_group").val()+'/'+isdownload

        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadgroupwise9th(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>result/resultcard9thgroupwise/'+$("#std_group").val()+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadslip_Inter(rno,isdownlaod,issess)
    {
        window.location.href = '<?=base_url()?>result/resultcard12th/'+rno+'/'+isdownlaod+'/'+issess
    }
    function downloadslip_matric(rno,isdownlaod,issess)
    {
        window.location.href = '<?=base_url()?>result/resultcard10th/'+rno+'/'+isdownlaod+'/'+issess
    }
     function downloadslip_Inter1(rno,val)
    {
        window.location.href = '<?=base_url()?>result/resultcard11th/'+rno+'/'+val
    }
    function downloadgroupwise()
    {
        window.location.href = '<?=base_url()?>result/MatricRollNoGroupwise/'+$("#std_group").val()
    }
 function downloadgroupwise10thres(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>result/resultcard10thgroupwise/'+$("#std_group").val()+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
   var error =  '<?= @$error?>'
    
  if(error.length >1)
   {
       alertify.error("Record Not Found.");
       $('#rno').focus();
      
   }

    function logout(){
        var msg = "Are you Sure You want to LOGOUT?"

        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>login/logout';
            } 
        });
    }
</script>


</body>
</html>