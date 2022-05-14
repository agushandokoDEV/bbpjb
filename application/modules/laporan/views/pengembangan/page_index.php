<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/highchart') ?>
<style>
ul.list-grafik li a{
    font-size: 15px;
    color: black;
}
</style>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<div class="card">
    <div class="header">
        <div class="row">
            <div class="col-md-10">
                <h4 class="title"><i class="fa fa-bar-chart bg-bulet bg-info"></i> Pengembangan</h4>
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('app/home') ?>">Home</a></li>
                  <li class="active">Laporan</li>
                  <li class="active">Pengembangan</li>
                </ol>
            </div>
            <div class="col-md-2">
                <!--<ul class="nav pull-right list-grafik">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pengembangan <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Rencana Kegiatan</a></li>
                        <li><a href="#">Hasil Kegiatan</a></li>
                      </ul>
                    </li>
                </ul>-->
                <form>
                    <div class="form-group" style="margin-bottom: 3px;">
                    <div class="input-group">
                      <span class="input-group-addon bg-app" id="basic-addon1" style="color: white;"><span class="glyphicon glyphicon-calendar"></span></span>
                      <select id="thn" class="form-control" aria-describedby="basic-addon1" style="height: 40px;">
                        <?php
                        for($t=2010; $t<=date('Y'); $t++)
                        {
                            $ar_thn[]=$t;
                        }
                        rsort($ar_thn);
                        foreach($ar_thn as $ar_thn)
                        {
                            echo '<option value="'.$ar_thn.'">'.$ar_thn.'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <div id="grafik"></div>
    </div>
</div>
<script>
$(function () {
    $('#grafik').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'GRAFIK DATA'
        },
        subtitle: {
            text: 'Tahun 2016'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nilai'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });
});
</script>
<?php $this->load->view('template/footer') ?>