<script>
$(document).ready(function() {
    <?php //echo $this->session->flashdata('notif-mdl') ?>
    $(".item" ).first().addClass('active');
    $('#btn-logx').click(function(e){
        //e.preventDefault();
        if($('input[name="username"]').val() == ''){
            $('#notif').html('<div class="alert alert-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-info-sign"></span> Ups !!! Username harus di isi</div>');
        }else if($('input[name="password"]').val() == ''){
            $('#notif').html('<div class="alert alert-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-info-sign"></span> Ups !!! Password harus di isi</div>');
        }else if($('input[name="username"]').val() == '' && $('input[name="password"]').val() == ''){
            $('#notif').html('<p>Data tidak lengkap</p>');
        }else{
            $('#notif').html('');
            $.post('<?php echo site_url('auth/ajax_login') ?>',{u:$('input[name="username"]').val(),p:$('input[name="password"]').val()},function(r){
                var res=jQuery.parseJSON(r);
                if(res.logged){
                    window.location.href=res.redirect;
                }else{
                    $('#notif').html('<div class="alert alert-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-info-sign"></span>'+res.notif+'</div>');
                }
            })
            .fail(function(){
                alert('Terjadi kesalahan');
            });
        }
    });
    $('#form-log').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: ''
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: ''
                    }
                }
            }
        }
    })
    .on('err.field.fv', function(e, data) {
            // $(e.target)  --> The field element
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            // Hide the messages
            data.element
                .data('fv.messages')
                .find('.help-block[data-fv-for="' + data.field + '"]').hide();
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
        $('#btn-log').removeClass('btn-danger').addClass('btn-default').html('Mohon tunggu...<?php echo loading('wek') ?>');
    });
});
function box_log(){
    $('#mdl-log').modal('show');
}
</script>
</div>
    <footer class="footer navbar-inverse">
      <div class="container container-footer">
        <div class="text-center copyright">Copyright &copy; 2016 <a href="#">Balai Bahasa Jawa Barat</a></div>
      </div>
    </footer>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>