<?php $this->load->view('frontend/head') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header bg-default">
                <h4 class="title"><i class="fa fa-street-view"></i> Visi dan Misi</h4>
                <hr class="hr"/>
            </div>    
            
            <div class="content">
                <p style="text-indent: 12px;">
                 Visi

                Visi Balai Bahasa Bandung adalah terwujudnya lembaga penelitian yang unggul dan pusat informasi serta pelayanan di bidang kebahasaan dan kesastraan (Indonesia dan daerah) di Jawa Barat.
                
                Misi
                
                Misi Balai Bahasa Bandung adalah
                </p>
                <ol>
                    <li> meningkatkan mutu bahasa dan sastra;</li>
                    <li>meningkatkan sikap positif masyarakat terhadap bahasa dan sastra</li>
                    <li>mengembangkan bahan informasi kebahasaan dan kesastraan</li>
                    <li>mengembangkan tenaga kebahasaan dan kesastraan</li>
                    <li>meningkatkan kerja sama</li>
                </ol>
            </div>
        </div>
        
    </div>
    <div class="col-md-4">
        <?php $this->load->view('frontend/right_page') ?>
    </div>
</div>
<?php $this->load->view('frontend/footer') ?>