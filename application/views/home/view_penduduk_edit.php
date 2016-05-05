<?php
$this->load->view('page/header');
?>
<div class="container">
        <div style="margin-top:10px;" class="mainbox col-lg-12">                    
            <div class="panel panel-info" >
                <div style="padding-top:10px" class="panel-body">
                    <div class="page-tables" id="div_edit_penduduk_1" style="">
                    	<form action="<?= site_url() ?>/master/penduduk/edit" method="post">
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">NIK</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="nik" name="nik" value="<?= $penduduk['NIK'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">KK</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="kk" name="kk" value="<?= $penduduk['KK'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Nama</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $penduduk['NAMA'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Alamat</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['ALAMAT'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Kabupaten</label>
                        	<div class="col-lg-8">
	                            <select class="form-control" id="select_kabupaten" name="select_kabupaten">
	                                <?php
	                                foreach ($list_kabupaten as $key => $kabupaten) {
	                                    echo '<option value="'.$kabupaten['KABUPATEN_ID'].'">'.$kabupaten['KABUPATEN_KODE'].' '.$kabupaten['KABUPATEN_NAMA'].'</option>';
	                                }
	                                ?>
	                            </select>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Kecamatan</label>
                            <div class="col-lg-8">
	                            <select class="form-control" id="select_kecamatan" name="select_kecamatan">
	                                <?php
	                                foreach ($list_kecamatan as $key => $kecamatan) {
	                                    echo '<option '.($penduduk['KECAMATAN_ID']==$kecamatan['KECAMATAN_ID']?' selected="" ':'').' value="'.$kecamatan['KECAMATAN_ID'].'">'.$kecamatan['KECAMATAN_KODE'].' '.$kecamatan['KECAMATAN_NAMA'].'</option>';
	                                }
	                                ?>
	                            </select>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Desa</label>
                            <div class="col-lg-8">
	                            <select class="form-control" id="select_desa" name="select_desa">
	                                <?php
	                                foreach ($list_desa as $key => $desa) {
	                                    echo '<option '.($penduduk['DESA_ID']==$desa['DESA_ID']?' selected="" ':'').' value="'.$desa['DESA_ID'].'">'.$desa['DESA_KODE'].' '.$desa['DESA_NAMA'].'</option>';
	                                }
	                                ?>
	                            </select>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Tempat Lahir</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $penduduk['TEMPAT_LAHIR'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Tanggal Lahir</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $penduduk['TANGGAL_LAHIR'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Jenis Kelamin</label>
                            <div class="col-lg-8">
	                            <select class="form-control" id="select_kelamin" name="select_kelamin">
	                                <?php
	                                foreach ($list_kelamin as $key => $kelamin) {
	                                    echo '<option '.($penduduk['JENIS_KELAMIN']==$kelamin['JENIS_KELAMIN_KODE']?' selected="" ':'').' value="'.$kelamin['JENIS_KELAMIN_KODE'].'">'.$kelamin['JENIS_KELAMIN_NAMA'].'</option>';
	                                }
	                                ?>
	                            </select>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Hubungan Keluarga</label>
                            <div class="col-lg-8">
	                            <select class="form-control" id="select_hubungan_keluarga" name="select_hubungan_keluarga">
	                                <?php
	                                foreach ($list_hubungan_keluarga as $key => $keluarga) {
	                                    echo '<option '.($penduduk['HUBUNGAN_KELUARGA']==$keluarga['HUBUNGAN_KELUARGA_KODE']?' selected="" ':'').' value="'.$keluarga['HUBUNGAN_KELUARGA_KODE'].'">'.$keluarga['HUBUNGAN_KELUARGA_NAMA'].'</option>';
	                                }
	                                ?>
	                            </select>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Sekolah</label>
                            <div class="col-lg-8">
	                            <select class="form-control" id="select_sekolah" name="select_sekolah">
	                                <?php
	                                foreach ($list_sekolah as $key => $sekolah) {
	                                    echo '<option '.($penduduk['SEKOLAH']==$sekolah['SEKOLAH_KODE']?' selected="" ':'').' value="'.$sekolah['SEKOLAH_KODE'].'">'.$sekolah['SEKOLAH_NAMA'].'</option>';
	                                }
	                                ?>
	                            </select>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Cacat</label>
                            <div class="col-lg-8">
	                            <select class="form-control" id="select_cacat" name="select_cacat">
	                                <?php
	                                foreach ($list_cacat as $key => $cacat) {
	                                    echo '<option '.($penduduk['CACAT']==$cacat['CACAT_KODE']?' selected="" ':'').' value="'.$cacat['CACAT_KODE'].'">'.$cacat['CACAT_NAMA'].'</option>';
	                                }
	                                ?>
	                            </select>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Hamil</label>
                            <div class="col-lg-8">
	                            <select class="form-control" id="select_hamil" name="select_hamil">
	                                <?php
	                                foreach ($list_hamil as $key => $val) {
	                                    echo '<option '.($penduduk['CACAT']==$val['HAMIL_KODE']?' selected="" ':'').' value="'.$val['HAMIL_KODE'].'">'.$val['HAMIL_NAMA'].'</option>';
	                                }
	                                ?>
	                            </select>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Penghasilan Perbulan</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="penghasilan" name="penghasilan" value="<?= $penduduk['PENGHASILAN_PERBULAN'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Status Perkawinan</label>
                            <div class="col-lg-8">
	                            <select class="form-control" id="select_kawin" name="select_kawin">
	                                <?php
	                                foreach ($list_kawin as $key => $val) {
	                                    echo '<option '.($penduduk['STATUS_KAWIN']==$val['KAWIN_KODE']?' selected="" ':'').' value="'.$val['KAWIN_KODE'].'">'.$val['KAWIN_NAMA'].'</option>';
	                                }
	                                ?>
	                            </select>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<input type="hidden" name="id_penduduk" value="<?= $penduduk['PENDUDUK_ID'] ?>"/>
                            <div class="col-lg-8 col-lg-offset-3">
	                            <button type="submit" class="btn btn-success">Simpan</button>
	                        </div>
                        </div>
                    </form>
                        <!-- END FIELD EDIT-->
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
            </div>  
        </div>
    </div>
<?php
$this->load->view('page/footer');
?>
<script>
var site_url='<?=site_url()?>';
var base_url='<?=base_url()?>';
 $(document).ready(function () {
    $($('.has_sub')[1]).addClass('open');
 	$('#tanggal_lahir').datepicker({ dateFormat: 'yy-mm-dd' });
 	$('#select_kecamatan').on('change',function(){
        reqDataDropdown({
            target_element:'select_desa',
            param:{id_kecamatan:this.value},
            url:'master/desa/get_list_desa',
            ret_array:['DESA_ID','DESA_NAMA']
        });
 	});
 });
 function reqDataDropdown(d) {
    console.log(d);
    var targetEl = $('#' + d.target_element);
    targetEl.parent().parent().append('<img class="snake_loader" src="' + base_url + 'static/img/snake_loader.gif" width="20">');
    targetEl.html('');
    if(d.initial_text!=undefined)
        targetEl.html($('<option></option>').attr('selected', 'true').val('x').html(d.initial_text));
    $.ajax({
        type: "get",
        url: site_url + '/' + d.url,
        data: d.param,
        success: function (data) {
            var val = JSON.parse(data);
            if (val.length > 0) {
                var j2 = d.ret_array.length;
                for (var i = 0, l = val.length; i < l; i++) {
                    //console.log('proses data ke ' + i);
                    var v = val[i];
                    var id = v[d.ret_array[0]];
                    var teks = '';
                    for (var j = 1; j < j2; j++) {
                        teks += v[d.ret_array[j]] + ' ';
                    }
                    var opt = $('<option></option>').val(id).html(teks);
                    if (id == d.selected_value) {
                        opt.attr({'selected': 'true'});
                    }
                    targetEl.append(opt);
                }
            }
            if (d.end_text != undefined && d.end_text.length > 0)
                targetEl.append($('<option></option>').val('y').html(d.end_text));
            $('.snake_loader').remove();
        }
        , error: function (xhr, ajaxOptions, thrownError) {
            $('.snake_loader').remove();
        }
    });
if(d.element_reset==undefined)
d.element_reset=[];
    for (var i = 0, n_element_reset = d.element_reset.length; i < n_element_reset; i++) {
        var elmn = document.getElementById(d.element_reset[i]);
        while (elmn.children.length > 1) {
            elmn.children[1].remove();
        }
    }
}
</script>