<?php
$this->load->view('page/header');
?>
<div class="container">
        <div style="margin-top:10px;" class="mainbox col-lg-12">                    
            <div class="panel panel-info" >
                <div style="padding-top:10px" class="panel-body">
                    <div class="page-tables" id="div_edit_penduduk_1" style="">
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">NIK</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="nik" name="nik" value="<?= $penduduk['NIK'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">KK</label>
                            <div class="col-lg-6">
	                            <input type="text" class="form-control" id="kk" name="kk" value="<?= $penduduk['KK'] ?>"/>
	                        </div>
                            <button class="col-lg-1 btn btn-success" onclick="window.location='<?=site_url()?>/master/penduduk/kk?id=<?=$penduduk['KK']?>'">Lihat KK</button>
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
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['KABUPATEN_NAMA'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Kecamatan</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['KECAMATAN_NAMA'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Desa</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['DESA_NAMA'] ?>"/>
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
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['JENIS_KELAMIN_NAMA'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Hubungan Keluarga</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['HUBUNGAN_KELUARGA_NAMA'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Sekolah</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['SEKOLAH_NAMA'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Cacat</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['CACAT_NAMA'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Hamil</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['HAMIL_NAMA'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Penghasilan Perbulan</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="penghasilan" name="penghasilan" value="Rp. <?= number_format((double)$penduduk['PENGHASILAN_PERBULAN'],2,',','.') ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<label class="col-lg-3 control-label">Status Perkawinan</label>
                            <div class="col-lg-8">
	                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $penduduk['KAWIN_NAMA'] ?>"/>
	                        </div>
                        </div>
                        <div class="form-group col-lg-12">
                        	<input type="hidden" name="id_penduduk" value="<?= $penduduk['PENDUDUK_ID'] ?>"/>
                            <div class="col-lg-8 col-lg-offset-3">
	                            <button type="button" onclick="window.location.href='<?=site_url()?>/master/penduduk/edit_page?id_penduduk=<?=$penduduk['PENDUDUK_ID']?>'" class="btn btn-success">Edit</button>
	                        </div>
                        </div>
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
$(document).ready(function () {
        $($('.has_sub')[1]).addClass('open');
        });
</script>