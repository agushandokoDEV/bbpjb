<h4 style="margin-top: 0;"><?php echo $menu ?></h4>
<form id="form-addx" action="<?php echo site_url('import_data/'.$func) ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input type="file" name="excel" id="excel">
    <p class="help-block"><div id="loading-tf"><i>Harap perhatikan kembali file yang akan di tranfer harus sesuai dengan menu yang anda pilih.</i></div></p>
  </div>
  <button type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-transfer"></i> Import data</button>
</form>
<script>
$(document).ready(function() {
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            excel: {
                validators: {
                    file: {
                        extension: 'xls',
                        type: 'application/vnd.ms-excel',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'haraf masukan file ms.excel'
                    },
                    notEmpty: {
                        message: 'harap masukan file ms.excel'
                    },
                }
            },
        }
    })
    .on('success.form.fv', function(e) {
        // Prevent form submission
        //e.preventDefault();
        //console.log(e.target);        
        var $form = $(e.target);
        //var bar = $('#progress-bar-xl');
        //var percent = $('#percent-xl');
        //var status = $('#status');
        var loading=$('#loading-tf');
        $form.ajaxForm({
            beforeSend: function() {
                loading.html('Transferring data...<?php echo loading('tf') ?>');
                //var percentVal = '0%';
                //$('#xl-progress').show();
                //bar.width(percentVal)
                //percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                //$('#btn-sub').attr('disabled','deisabled').addClass('disabled');
                //var percentVal = percentComplete + '%';
                //bar.width(percentVal)
                //percent.html(percentVal+" Complete");
                //console.log(percentVal, position, total);
            },
            complete: function(xhr) {
                var j=jQuery.parseJSON(xhr.responseText);
                console.log(j.error);
                if(j.error == false){
                    loading.html('<i class="fa fa-check-circle-o fa-lg"></i> Transfering data berhasil, total data : '+j.msg);
                }else{
                    loading.html('<span class="glyphicon glyphicon-remove"></span> Terjadi kesalahan / error..');
                }
                $('#excel').attr('disabled','deisabled');
                $("#form-add")[0].reset();
            }
        });
    });
});
</script>