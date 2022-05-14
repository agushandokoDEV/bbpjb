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
       alwaysOn: true
	});
});
</script>
<img class="mapjabar" id="Image-Maps-Com-image-maps-2016-03-27-231822" src="<?php echo site_url('common/map/jabar.png') ?>" border="0" width="918" height="500" orgWidth="918" orgHeight="500" usemap="#image-maps-2016-03-27-231822" alt="" />
<map name="image-maps-2016-03-27-231822" id="ImageMapsCom-image-maps-2016-03-27-231822">
<area shape="rect" coords="916,498,918,500" alt="Image Map" style="outline:none;" title="Image Map" href="#" />

<?php foreach($dt_map as $map){ ?>
<?php
$jum_keg=$this->M_maping->get_map_jurnal($map->id_kabkot,$thn,'m')->jumlah;
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
<area data-maphilight='{"fillColor":"<?php echo $color ?>","stroke":false}' onclick="get_data('<?php echo $map->id_kabkot ?>','<?php echo $id_menu ?>','<?php echo $maping->function ?>')" data-toggle="tooltip" alt="<?php echo ucwords($map->nama_kota) ?>" title="<?php echo ucwords($map->nama_kota) ?>" shape="poly" coords="<?php echo $map->coord ?>" style="outline:none;" target="_self"     />
<?php }?>

</map>