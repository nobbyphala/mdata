<input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" id="site_url" value="<?php echo site_url(); ?>" />


<a href="<?php echo site_url() ?>">
  <div class="logomap">
    POTENSI KABUPATEN JOMBANG
  </div>
</a>


<div id="map_canvas" style="z-index: 10; width:100%; height:100%; border-radius: 5px 5px 5px 5px;"></div>


<input type="hidden" id="pilihkecamatan" value="<?=$id_kec?>" />
<input type="hidden" id="map_longitude" value="112.3" />
<div class="kotakdata" style="display: none;" id="kotakdata">
    wkwkwk
  </div>
<style>
  .combo{
    width: 170px;
  }

  .kotakdata{
    
/*    right: 10px;
    top: 130px;*/
    width: 100%;
    
    z-index: 100;
    background: none repeat scroll 0% 0% #FFF;
    padding: 10px;
    box-shadow: 5px 5px 0px 0px rgba(50, 50, 50, 0.43);
    
    margin-top: 10px;
    

  }
  .logomap{
    position: absolute;
    left: 0px;
    top: 0px;
    z-index: 100;
    background-color: white;
    padding: 8px;
    border-bottom-right-radius: 5px;
  }
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>/static/js/peta_dasar.js"></script>
<script>
  $(document).ready(function() {
    google.maps.event.addDomListener(window, 'load', peta_dasar_initialize);
  });
</script>