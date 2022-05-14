<link rel="stylesheet" href="<?php echo base_url('assets/vendor/datepicker/css/datepicker.css') ?>"/>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/datepicker/js/bootstrap-datepicker.js') ?>"></script>
<script>
$(function(){
    $('.dpx').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
});
</script>