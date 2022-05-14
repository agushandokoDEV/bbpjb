<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="container" style="width: 80%;">
    <div class="row">
        <div class="col-md-7">
            <?php if($p != null){ ?>
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="glyphicon glyphicon-question-sign bg-bulet bg-info"></i> Informasi</h4>
                    <hr class="hr"/>
                </div>
                <div class="content">
                    <input type="hidden" id="id_post" value="<?php echo $p->id_ques ?>"/>
                    <div class="media" style="border-bottom: 1px dotted #ddd;padding-bottom: 5px;">
                        <div class="media-left">
                            <img class="media-object img-thumbnail" src="<?php echo site_url('common/album/pegawai/default.png') ?>"  data-holder-rendered="true" style="width: 64px; height: 64px;border-radius: 0;">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo ucfirst($p->nama) ?></h4>
                            <p class="label label-danger" style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo tanggal($p->tgl) ?></p>
                            <p><?php echo $p->isi; ?></p>
                            <br />
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="label label-danger" style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo tanggal($p->tgl) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="glyphicon glyphicon-comment bg-bulet bg-success"></i> (<span id="jumkom"><?php echo $dt_jumkom->jumlah; ?></span>) Komentar</h4>
                    <hr class="hr"/>
                </div>
                <div class="content">
                    <div class="text-center" id="loading-post"></div>
                    <div id="list-post">
                    <?php if($dt_kom != null){ ?>
                    <?php foreach($dt_kom as $dt_kom){ ?>
                    <div class="media" style="border-bottom: 1px dotted #ddd;padding-bottom: 5px;">
                        <div class="media-left">
                            <img class="media-object img-thumbnail" src="<?php echo site_url('common/album/pegawai/default.png') ?>"  data-holder-rendered="true" style="width: 64px; height: 64px;border-radius: 0;">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo ucfirst($dt_kom->nama) ?></h4>
                            <p class="label label-danger" style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo tanggal($dt_kom->tgl_komentar) ?></p>
                            <p><?php echo $dt_kom->komentar; ?></p>
                            <br />
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="label label-danger" style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo tanggal($dt_kom->tgl) ?></p>
                                    <p class="label label-success" style="font-size: 10px;"><span class="glyphicon glyphicon-comment"></span> 0 Komentar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }}else{?>
                    <p id="belum-ada" class="error text-center">Tidak ada komentar...!!!</p>
                    <?php }?>
                    </div>
                </div>
            </div>
            <?php }else{?>
            <p id="belum-ada" class="error text-center">Tidak ada pertanyaan...!!!</p>
            <?php }?>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="glyphicon glyphicon-user bg-bulet bg-app"></i> Form</h4>
                    <hr class="hr"/>
                </div>
                <div class="content">
                    <form id="form-add" method="post" action="<?php echo site_url('question/add_komentar') ?>">
                      <div class="form-group">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                      </div>
                      <div class="form-group">
                        <textarea rows="3" name="isi" id="isi" class="form-control" placeholder="Komentar..."></textarea>
                      </div>
                      <button id="btn-submit" type="submit" class="btn btn-primary">Komentar</button>
                      <a href="<?php echo site_url('question') ?>" class="btn btn-default">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
            nama:{
                validators: {
                    notEmpty: {
                        message: 'Nama harus di isi'
                    }
                }
            },
            isi:{
                validators: {
                    notEmpty: {
                        message: 'Isi psertanyaan tidak boleh kosong'
                    }
                }
            }
        }
    })
    .on('err.field.fv', function(e, data) {
        data.element
            .data('fv.messages')
            .find('.help-block[data-fv-for="' + data.field + '"]').hide();
    })
    .on('success.form.fv', function(e) {
        // Prevent form submission
        e.preventDefault();
        set_post();
    });
});
function set_post(){
    $('#loading-post').html('<?php echo loading(); ?>');
    var id_post=$('#id_post').val();
    var nm=$('#nama').val();
    var isi=$('#isi').val();
    $.post('<?php echo site_url('question/add_komentar') ?>',{nama:nm,isi:isi,id_post:id_post},function(res){
        if(res == '0'){
            alert('Terjadi kesalahan...');
        }else{
            $('#belum-ada').remove();
            $('#loading-post').html('');
            $('#list-post').append(res);
            get_jumkom();
            $('#isi').val('');
            $('#nama').val('');
            $('#btn-submit').removeClass('disabled').removeAttr('disabled');
        }
    })
    .fail(function(){
        alert('Terjadi kesalahan...');
    });
}

function get_jumkom(){
    var id_post=$('#id_post').val();
    $.post('<?php echo site_url('question/get_jumkom') ?>',{id_post:id_post},function(res){
        $('#jumkom').text(res);
    })
    .fail(function(){
        alert('Terjadi kesalahan...');
    });
}
</script>
<?php $this->load->view('template/footer') ?>