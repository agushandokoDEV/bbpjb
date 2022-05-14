<script>
$(function() {
    $('area[title]').qtip({
        position: {
            my: 'bottom center',
            at: 'center center'
        }
    });
    //$('[data-toggle="tooltip"]').tooltip();
	$('.mapjabar').maphilight({
	   //fillColor: '009525',
       alwaysOn: false
	});
    
    $('.mapjabarx').maphilight({
	   fillColor: '009525',
       alwaysOn: true
	});
});
</script>
<img class="mapjabar mapjabarx" id="Image-Maps-Com-image-maps-2016-03-27-231822" src="<?php echo site_url('common/map/jabar.png') ?>" border="0" width="918" height="500" orgWidth="918" orgHeight="500" usemap="#image-maps-2016-03-27-231822" alt="" />
<map name="image-maps-2016-03-27-231822" id="ImageMapsCom-image-maps-2016-03-27-231822">
<area shape="rect" coords="916,498,918,500" alt="Image Map" style="outline:none;" title="Image Map" href="#" />

<!--
<area data-maphilight='{"fillColor":"F40000"}' onclick="get_data('23')" data-toggle="tooltip" alt="Bogor Kota" title="Bogor Kota" shape="poly" coords="181,196,182,195,179,195,176,195,174,195,173,193,176,190,174,189,171,187,168,183,165,177,163,176,162,171,162,169,169,167,172,163,172,160,181,164,189,166,191,173,192,179,188,182,196,192,197,201,192,201,189,201,187,201" style="outline:none;" target="_self"/>                                
<area data-maphilight='{"fillColor":"47A7B1","stroke":false,"alwaysOn":false,"wrapClass":true}' onclick="get_data('46')" data-toggle="tooltip" alt="Bogor" title="Bogor" shape="poly" coords="85,223,90,221,96,219,100,214,104,213,116,218,125,218,136,220,138,216,146,218,154,216,161,213,169,216,178,222,187,223,197,224,209,227,218,228,229,227,232,223,238,221,246,214,250,207,248,204,246,203,247,198,260,196,268,195,278,195,290,197,301,199,305,196,314,191,317,187,324,181,322,180,316,179,312,172,308,169,306,162,304,157,304,154,296,150,287,147,283,145,271,142,274,139,267,136,263,133,252,130,248,126,242,124,239,125,242,119,242,111,241,106,238,111,236,115,234,120,232,126,229,131,223,133,220,133,215,137,209,140,203,146,200,146,197,144,197,141,194,140,190,143,188,149,183,149,178,144,174,145,172,143,167,143,161,143,158,141,157,133,155,129,155,126,154,122,153,119,149,118,141,119,136,119,131,121,124,121,116,121,108,120,104,117,100,116,92,114,86,113,85,122,83,120,78,118,75,113,72,110,66,111,62,116,58,119,58,127,59,138,58,143,52,144,51,144,47,146,47,155,43,161,47,171,54,181,54,194,53,201,62,211,73,216,83,223,80,222" style="outline:none;" target="_self"/>
-->

<?php foreach($dt_map as $map){ ?>
<?php
$jum_keg=$this->M_dashboard->get_jum_keg($map->id_kabkot,$thn)->jumlah;
if($jum_keg == 0){
    $color='FBFBFB';
}else if($jum_keg <= 3){
    $color='1DB128';
}else if($jum_keg >= 4){
    $color='FFFF24';
}else if($jum_keg >= 8){
    $color='FF3535';
}
?>
<area data-maphilight='{"fillColor":"<?php echo $color ?>","stroke":false,"shadow":false}' onclick="get_data('<?php echo $map->id_kabkot ?>')" data-toggle="tooltip" alt="<?php echo ucwords($map->nama_kota) ?>" title="<?php echo ucwords($map->nama_kota) ?>" shape="poly" coords="<?php echo $map->coord ?>" style="outline:none;" target="_self"     />
<?php }?>

</map>