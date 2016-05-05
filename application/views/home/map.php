<input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" id="site_url" value="<?php echo site_url(); ?>" />


<a href="<?php echo site_url() ?>">
  <div class="logomap">
    POTENSI KABUPATEN JOMBANG
  </div>
</a>


<div id="map_canvas" style="z-index: 10; width:100%; height:100%; position: absolute;border-radius: 5px 5px 5px 5px;"></div>

<div class="kotakfilter"  >
  <input type="hidden" id="map_longitude" value="112.4" />
  <center>
    <h4>FILTER DATA</h4>
  </center>
  <div class="row" >
    <div class="col-lg-6 combobox">
      Kecamatan: 
      <select id="pilihkecamatan" class="combo">
        <option value="0">SEMUA KECAMATAN</option>
        <?php foreach ($list_kecamatan as $row) { ?>
          <option value="<?php echo $row["kec_no"]; ?>" ><?php echo $row["kec_no"]; ?> | <?php echo $row["kecamatan"]; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-lg-6 combobox" >
      Desa: 
      <select id="pilihdesa" class="combo">
        <option value="0">SEMUA DESA</option>
      </select>
    </div>
    <div id="link_print" >
      <a href="<?= site_url() ?>/home/cetak" target="_blank" id="a_link_print" onmouseover="check_url()">Cetak</a>
    </div>
  </div>
  <div class="kotakdata" style="display: none;" id="kotakdata">
    wkwkwk
  </div>
</div>

<style>
  #link_print{
    right: 60px;
    float: left;
    position: absolute;
    margin-top: 25px;
  }
  .kotakfilter{
    position: absolute;
    right: 10px;
    top: 10px;
    width: 42%;
    min-height: 100px;
    background: #fff;
    padding: 10px;
    -webkit-box-shadow: 5px 5px 0px 0px rgba(50, 50, 50, 0.43);
    -moz-box-shadow: 5px 5px 0px 0px rgba(50, 50, 50, 0.43);
    box-shadow: 5px 5px 0px 0px rgba(50, 50, 50, 0.43);
    z-index: 11;
  }

  .combo{
    width: 170px;
  }
  .kotakdata{
    position: fixed;
    right: 10px;
    top: 130px;
    width: 42%;
    height: 500px;
    z-index: 100;
    background: none repeat scroll 0% 0% #FFF;
    padding: 10px;
    box-shadow: 5px 5px 0px 0px rgba(50, 50, 50, 0.43);
    overflow: hidden;
    margin-top: 10px;
    overflow-y: auto;
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
    $('#pilihkecamatan').on('change', function() {
      var oid = peta_dasar_kec_to_hide;
      kecamatan_klik(oid, this.value);
      $('#a_link_print').attr('href', '<?= site_url() ?>/home/cetak/' + this.value);
    });
    $('#pilihdesa').on('change', function() {
      var oid = peta_dasar_kec_to_hide;
      desa_klik(oid, this.value);
    });
//    $('#link_print').on('mouseover', function() {
//    });
  });
  function check_url() {
    console.log('check url to open');
    $('#a_link_print').attr('href', '<?= site_url() ?>/home/cetak/' + $('#pilihkecamatan').val());
  }
</script>