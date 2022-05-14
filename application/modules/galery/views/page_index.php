<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/elfinder') ?>
<script>
// Documentation for client options:
// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
$(document).ready(function() {
	$('#elfinder').elfinder({
		url : '<?php echo site_url('elFinder/php/connector.minimal.php') ?>',  // connector URL (REQUIRED)
        commands : [
        'custom','open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook', 
        'rm', 'duplicate', 'rename', 'mkdir', 'upload', 'copy', 
        'cut', 'paste', 'search', 'info', 'view', 'help', 'sort'
        ],
        contextmenu : {
            // navbarfolder menu
            navbar : ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],
            // current directory menu
            cwd    : ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'sort', '|', 'info'],
            // current directory file menu
            files  : ['getfile', '|', 'custom', 'quicklook', '|', 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'edit', 'rename', 'resize', '|', 'archive', 'extract', '|', 'info']
        },
		// , lang: 'ru'                    // language (OPTIONAL)
	});
});
</script>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-database bg-bulet bg-danger"></i> Galery</h4>
        <div class="row">
            <div class="col-md-10">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Master Data</li>
                  <li class="active">Gallery</li>
                </ol>
            </div>
            <div class="col-md-2">
                
            </div>
        </div>
        <hr class="hr"/>
        <?php echo $this->session->flashdata('notif') ?>
    </div>    
    
    <div class="content">
        <div id="elfinder"></div>
    </div>
</div>
<?php $this->load->view('template/footer') ?>