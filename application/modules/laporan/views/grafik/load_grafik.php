<div id="grafik"></div>
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
            text: 'Total : <?php echo $total ?>, Tahun : <?php echo $thn ?>'
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
            allowDecimals:false,
            title: {
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key} :</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><a href="#data_lengkap" onclick="get_dtl({point.x},'+"'{series.name}'"+')"><b>{point.y}</b></span></a></td</tr>',
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
            name: 'Pembinaan',
            color: '#FF2020',
            data: [
                <?php
                for($i=0;$i<count($bulan); $i++){
                $p=$this->M_grafik->get_grafik_sum('pembinaan',$thn,$bulan[$i]);
                echo $p->jumlah.',';
                }
                ?>
            ]

        }, {
            name: 'Pengembangan',
            data: [
                <?php
                for($j=0;$j<count($bulan); $j++){
                $p=$this->M_grafik->get_grafik_sum('pengembangan',$thn,$bulan[$j]);
                echo $p->jumlah.',';
                }
                ?>
            ]

        }]
    });
});

function get_dtl(bln,s){
    $('#load-grafikx').html('<div class="text-center"><?php echo loading() ?></div>');
    $.post('<?php echo site_url('laporan/grafik_data/load_grafik_dt') ?>',{s:s.trim(),bln:bln,thn:<?php echo $thn ?>},function(rs){
        $('#load-grafikx').html(rs);
    })
    .error(function(){
        alert('Terjadi kesalahan, mohon cek koneksi internet..');
    });
}
</script>