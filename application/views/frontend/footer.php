<div class="modal fade" tabindex="-1" role="dialog" id="mdl-log" style="margin-top: 100px;">
  <div class="modal-dialog" style="width: 400px;">
    <div class="card">
    <div class="header bg-default">
        <h4 class="title text-left"><i class="fa fa-lock bg-bulet bg-danger"></i> <b class="black">LOGIN</b></h4>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <form id="form-log" method="post" action="<?php echo site_url('auth/do_login') ?>">
        <input type="hidden" name="current_url" value="<?php echo current_url() ?>"/>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
            </div>
          </div>
          <!--<div class="checkbox">
            <label>
              <input type="checkbox"> Remember
            </label>
          </div>-->
          <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-lock"></span> <b>LOGIN</b></button>
          <!--<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> <b>BATAL</b></button>-->
        </form>
        <br />
        <?php echo $this->session->flashdata('notif') ?>
    </div>
</div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
<?php echo $this->session->flashdata('notif-mdl') ?>
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
        <div class="text-center copyright">Copyright &copy; 2016 <a href="<?php echo site_url() ?>">Balai Bahasa Jawa Barat</a></div>
      </div>
    </footer>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>