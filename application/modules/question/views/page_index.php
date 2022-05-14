<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="container" style="width: 80%;">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="glyphicon glyphicon-question-sign bg-bulet bg-info"></i> Informasi</h4>
                    <hr class="hr"/>
                </div>
                <div class="content">
                    <div class="text-center" id="loading-post"></div>
                    <div id="list-post">
                        <?php if($dt_post != null){ ?>
                        <?php foreach($dt_post as $p){ ?>
                        <a href="<?php echo site_url('question/detail/'.$p->id_ques) ?>" style="text-decoration: none; color: black;">
                            <div class="media" style="border-bottom: 1px dotted #ddd;padding-bottom: 5px;padding-top: 10px;">
                                <div class="media-left">
                                    <img class="media-object img-thumbnail" src="<?php echo site_url('common/album/pegawai/default.png') ?>"  data-holder-rendered="true" style="width: 64px; height: 64px;border-radius: 0;">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo ucfirst($p->nama) ?></h4>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p class="label label-danger" style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo tanggal($p->tgl) ?></p>
                                        </div>
                                        <div class="col-md-10">
                                            <?php
                                            $jumkom=$this->M_ques->get_jum_komentar($p->id_ques);
                                            ?>
                                            <p class="label label-success" style="font-size: 10px;"><span class="glyphicon glyphicon-comment"></span> <?php echo $jumkom->jumlah ?> Komentar</p>
                                        </div>
                                    </div>
                                    <?php echo word_limiter($p->isi, 30); ?>
                                    <br />
                                </div>
                            </div>
                        </a>
                        <?php }?>
                        <?php }else{?>
                        <p id="belum-ada" class="error text-center">Tidak ada informasi...!!!</p>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="glyphicon glyphicon-user bg-bulet bg-app"></i> Form</h4>
                    <hr class="hr"/>
                </div>
                <div class="content">
                    <form id="form-add" method="post" action="<?php echo site_url('question/add_posting') ?>">
                      <div class="form-group">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                      </div>
                      <div class="form-group">
                        <textarea rows="3" name="isi" id="isi" class="form-control" placeholder="Isi pertanyaan atau masukan jika ada menu atau data yang salah..."></textarea>
                        <p><i>*Gunakan enter untuk paragraf berikutnya</i></p>
                      </div>
                      
                      <button id="btn-submit" type="submit" class="btn btn-primary">Posting</button>
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
    var nm=$('#nama').val();
    var isi=$('#isi').val();
    $.post('<?php echo site_url('question/add_posting') ?>',{nama:nm,isi:isi},function(res){
        if(res == '0'){
            alert('Terjadi kesalahan...');
        }else{
            $('#belum-ada').remove();
            $('#loading-post').html('');
            $('#list-post').prepend(res);
            $('#isi').val('');
            $('#nama').val('');
            $('#btn-submit').removeClass('disabled').removeAttr('disabled');
        }
    })
    .fail(function(){
        alert('Terjadi kesalahan...');
    });
}
</script>
<?php $this->load->view('template/footer') ?>