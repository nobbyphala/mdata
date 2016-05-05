<?php
$this->load->view('page/header');
?>
    <div class="container">
        <div style="margin-top:10px;" class="mainbox col-md-12">                    
            <div class="panel panel-info" >
                <div class="panel-heading" style="height: 50px; padding: 0px" >
                    <div class="panel-title col-md-6 text-center" style="height: 100%; margin: 0px; padding-top: 12px"><a href="<?= site_url() ?>/cobaupload">Upload Excel</a></div>
                    <div class="panel-title col-md-6 text-center" style="height: 100%; margin: 0px; background-color: white; padding-top: 12px">Hasil Upload</div>
                </div>     
                <div style="padding-top:30px" class="panel-body">
                    <!--<div class="page-tables" id="div_edit_penduduk_1" style="display: none">
                        <div class="form-group col-lg-3">
                            <select class="form-control" id="select_provinsi" name="select_provinsi"></select>
                        </div>
                        <div class="form-group col-lg-3">
                            <select class="form-control" id="select_kabupaten" name="select_kabupaten"></select>
                        </div>
                        <div class="form-group col-lg-3">
                            <select class="form-control" id="select_kecamatan" name="select_kecamatan"></select>
                        </div>

                        <div class="form-group col-lg-3">
                            <select class="form-control" id="select_desa" name="select_desa"></select>
                        </div>
                        <div class="form-group col-lg-3">
                            <select class="form-control" id="select_mode" name="select_mode">
                                <option value="terpilih">Update hanya untuk data tercentang</option>
                                <option value="kesamaan">Update semua data </option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <button type="button" class="btn btn-primary" onclick="simpanPerubahan()">Simpan</button>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>
                    <div class="page-tables" id="div___" style="">
                        <button type="button" class="btn btn-danger" onclick="">Hapus Semua</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="page-tables">
                        <div class="table-responsive" style="; min-height: 200px;overflow-x: auto">
                            <form method="post" action="<?php echo site_url('/pertanian/insertdatapanenfromexcel/')?>">
                                <input type="hidden" name="filepath" value="<?php echo $filepath; ?>">
                                <input type="hidden" name="tanaman" value="<?php echo $tanaman; ?>">
                            <table id="" cellpadding="0" cellspacing="1" border="0" width="100%" style="white-space: nowrap" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onchange="check_semua();" id="checkbox_check_semua"/> <button onclick="hapus_tercentang()" class="btn btn-xs btn-danger"><i class="fa fa-minus fa-fw"></i> Hapus</button></th>
                                        <th>No</th>
                                        <th>ID_KABUPATEN</th>
                                        <th>ID_KECAMATAN</th>
                                        <th>Kecamatan</th>
                                        <th>Luas Panen</th>
                                        <th>Produktivitas</th>
                                        <th>Produksi</th>
                                        <th>Tahun Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $no_id=0;
                                        foreach ($data_val as $val)
                                        {
                                            $no_id++;
                                            echo "<tr>";
                                                echo "<td><input type='checkbox' name='row[]' id='row' value='$no_id'/></td>";
                                                echo "<td>$val[1]</td>";
                                                echo "<td>$val[2]</td>";
                                                echo "<td>$val[3]</td>";
                                                echo "<td>$val[4]</td>";
                                                echo "<td>$val[5]</td>";
                                                echo "<td>$val[6]</td>";
                                                echo "<td>$val[7]</td>";
                                                echo "<td>$val[8]</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                                <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>
<div id="modalTambahProvinsi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Tambah Provinsi</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="kode_provinsi_baru" placeholder="Kode Provinsi"/>
                    <input type="text" id="nama_provinsi_baru" placeholder="Nama Provinsi"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tambahProvinsi()" id="">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<div id="modalTambahKabupaten" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Tambah Kabupaten</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="kode_kabupaten_baru" placeholder="Kode Kabupaten"/>
                    <input type="text" id="nama_kabupaten_baru" placeholder="Nama Kabupaten"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tambahKabupaten()" id="">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<div id="modalTambahKecamatan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Tambah Kecamatan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="kode_kecamatan_baru" placeholder="Kode Kecamatan"/>
                    <input type="text" id="nama_kecamatan_baru" placeholder="Nama Kecamatan"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tambahKecamatan()" id="">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<div id="modalTambahDesa" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Tambah Desa</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="kode_desa_baru" placeholder="Kode Desa"/>
                    <input type="text" id="nama_desa_baru" placeholder="Nama Desa"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tambahDesa()" id="">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<div id="modalHapus" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Hapus Data Upload</h4>
            </div>
            <div class="modal-body">
                <h2 id="teks_konfirmasi_hapus"></h2>
                <input type="hidden" id="id_hapus"/>
                <input type="hidden" id="mode_hapus" value="single"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="do_hapus()" id="">Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('page/footer');
?>
<script>
    $(document).ready(function () {
        $($('.has_sub')[2]).addClass('open');
        initTabelHasilUpload();
        $('#select_provinsi').on('change', function () {
            if (this.value !== 'x' && this.value !== 'y') {
                last_id_provinsi = this.value;
//                last_id_provinsi = '';
                provinsi_berubah();
            } else if (this.value === 'y') {
                $('#modalTambahProvinsi').modal('show');
            } else if (this.value === 'x') {
            }
        });
        $('#select_kabupaten').on('change', function () {
            if (this.value !== 'x' && this.value !== 'y') {
                last_id_kabupaten = this.value;
//                last_id_kabupaten = '';
                kabupaten_berubah();
            } else if (this.value === 'y') {
                $('#modalTambahKabupaten').modal('show');
            }
        });
        $('#select_kecamatan').on('change', function () {
            if (this.value !== 'x' && this.value !== 'y') {
                last_id_kecamatan = this.value;
//                last_id_kecamatan = '';
                kecamatan_berubah();
            } else if (this.value === 'y') {
                $('#modalTambahKecamatan').modal('show');
            }
        });
        $('#select_desa').on('change', function () {
            if (this.value === 'y') {
                $('#modalTambahDesa').modal('show');
            }
        });
    });
    var tabelHasilUpload = null;
    var base_url = "<?= base_url(); ?>";
    var site_url = "<?= site_url(); ?>";
    function simpanPerubahan() {
        var id_upload = [];
        var checks = $('.check_upload_penduduk');
        for (var i = 0, n = checks.length; i < n; i++) {
            var check = $(checks[i]);
            if (check.is(':checked')) {

                id_upload.push(check.parent().parent().attr('id_upload'));
            }
        }
        $.ajax({
            type: "post",
            url: site_url + '/initial_upload/simpan_perubahan',
            data: {
                provinsi: $('#select_provinsi').val(),
                kabupaten: $('#select_kabupaten').val(),
                kecamatan: $('#select_kecamatan').val(),
                desa: $('#select_desa').val(),
                mode_simpan: $('#select_mode').val(),
                id_upload: id_upload
            },
            success: function (data) {
                var json = JSON.parse(data);
                if (json['res'] === 'ok') {
                    $('#div_edit_penduduk_1').hide();
                    tabelHasilUpload.fnDraw();
                } else {
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function hapus(elmt) {
        $('#teks_konfirmasi_hapus').html("Apakah Anda yakin menghapus data upload?");
        $('#mode_hapus').val('single');
        $('#id_hapus').val($(elmt).parent().parent().attr('id_upload'));
        $('#modalHapus').modal('show');
    }
    function hapus_tercentang() {
        $('#teks_konfirmasi_hapus').html("Apakah Anda yakin menghapus data upload yang tercentang?");
        $('#mode_hapus').val('tercentang');
        $('#modalHapus').modal('show');
    }
    function do_hapus() {
        var mode_hapus = $('#mode_hapus').val();
        var id_hapus = [];
        if (mode_hapus === 'single') {
            id_hapus.push($('#id_hapus').val());
        } else if (mode_hapus === 'tercentang') {
            var checks = $('.check_upload_penduduk');
            for (var i = 0, n = checks.length; i < n; i++) {
                var check = $(checks[i]);
                if (check.is(':checked')) {
                    id_hapus.push(check.parent().parent().attr('id_upload'));
                    console.log(id_hapus);
                }
            }
        }
        console.log(id_hapus);
        $.ajax({
            type: "post",
            url: site_url + '/initial_upload/hapus',
            data: {
                id: id_hapus
            },
            success: function (data) {
                $('#div_edit_penduduk_1').hide();
                $('#modalHapus').modal('hide');
                tabelHasilUpload.fnDraw();

            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function tambahProvinsi() {
        var kode_provinsi = $('#kode_provinsi_baru').val();
        var nama_provinsi = $('#nama_provinsi_baru').val();
        $.ajax({
            type: "post",
            url: site_url + '/master/provinsi/add_provinsi',
            data: {kode: kode_provinsi, nama: nama_provinsi},
            success: function (data) {
                var json = JSON.parse(data);
                if (json['res'] === 'ok') {
                    $('#modalTambahProvinsi').modal('hide');
                    init_list_provinsi();
                } else {
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function tambahKabupaten() {
        var kode = $('#kode_kabupaten_baru').val();
        var nama = $('#nama_kabupaten_baru').val();
        var id_provinsi = $('#select_provinsi').val();
        $.ajax({
            type: "post",
            url: site_url + '/master/kabupaten/add_kabupaten',
            data: {kode: kode, nama: nama, id_provinsi: id_provinsi},
            success: function (data) {
                var json = JSON.parse(data);
                if (json['res'] === 'ok') {
                    $('#modalTambahKabupaten').modal('hide');
                    provinsi_berubah();
                } else {
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function tambahKecamatan() {
        var kode = $('#kode_kecamatan_baru').val();
        var nama = $('#nama_kecamatan_baru').val();
        var id_kabupaten = $('#select_kabupaten').val();
        $.ajax({
            type: "post",
            url: site_url + '/master/kecamatan/add_kecamatan',
            data: {kode: kode, nama: nama, id_kabupaten: id_kabupaten},
            success: function (data) {
                var json = JSON.parse(data);
                if (json['res'] === 'ok') {
                    $('#modalTambahKecamatan').modal('hide');
                    kabupaten_berubah();
                } else {
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function tambahDesa() {
        var kode = $('#kode_desa_baru').val();
        var nama = $('#nama_desa_baru').val();
        var id_kecamatan = $('#select_kecamatan').val();
        $.ajax({
            type: "post",
            url: site_url + '/master/desa/add_desa',
            data: {kode: kode, nama: nama, id_kecamatan: id_kecamatan},
            success: function (data) {
                var json = JSON.parse(data);
                if (json['res'] === 'ok') {
                    $('#modalTambahDesa').modal('hide');
                    kecamatan_berubah();
                } else {
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function provinsi_berubah() {
        reqDataDropdown({
            'target_element': 'select_kabupaten',
            'initial_text': 'Pilih Kabupaten',
            'end_text': 'Tambah Kabupaten',
            'url': 'master/kabupaten/get_list_kabupaten',
            'param': {id_provinsi: last_id_provinsi},
            'ret_array': ['KABUPATEN_ID', 'KABUPATEN_KODE', 'KABUPATEN_NAMA'],
            'selected_value': last_id_kabupaten,
            'element_reset': ['select_kecamatan', 'select_desa']
        });
    }
    function kabupaten_berubah() {
        reqDataDropdown({
            'target_element': 'select_kecamatan',
            'initial_text': 'Pilih Kecamatan',
            'end_text': 'Tambah Kecamatan',
            'url': 'master/kecamatan/get_list_kecamatan',
            'param': {id_kabupaten: last_id_kabupaten},
            'ret_array': ['KECAMATAN_ID', 'KECAMATAN_KODE', 'KECAMATAN_NAMA'],
            'selected_value': last_id_kecamatan,
            'element_reset': ['select_desa']
        });
    }
    function kecamatan_berubah() {
        reqDataDropdown({
            'target_element': 'select_desa',
            'initial_text': 'Pilih Desa',
            'end_text': 'Tambah Desa',
            'url': 'master/desa/get_list_desa',
            'param': {id_kecamatan: last_id_kecamatan},
            'ret_array': ['DESA_ID', 'DESA_KODE', 'DESA_NAMA'],
            'selected_value': last_id_desa,
            'element_reset': []
        });
    }
    function init_list_provinsi() {
        reqDataDropdown({
            'target_element': 'select_provinsi',
            'initial_text': 'Pilih Provinsi',
            'end_text': 'Tambah Provinsi',
            'url': 'master/provinsi/get_list_provinsi',
            'param': {},
            'ret_array': ['PROVINSI_ID', 'PROVINSI_KODE', 'PROVINSI_NAMA'],
            'selected_value': last_id_provinsi,
            'element_reset': ['select_kabupaten', 'select_kecamatan', 'select_desa']
        });
    }
    function initTabelHasilUpload() {
        if (tabelHasilUpload != null) {
            tabelHasilUpload.fnDestroy();
        }
        tabelHasilUpload = $('#tabelHasilUpload').dataTable({
            "processing": true,
            "serverSide": true,
            order: [[1, "asc"]],
            "columnDefs": [
                {"orderable": false, "targets": 0},
                {"searchable": false, "targets": 0}
            ],
            "ajax": {
                'method': 'post',
                'data': {
                },
                "url": site_url + "/initial_upload/get_list_hasil_upload_datatable",
                "dataSrc": function (json) {
                    jsonData = json.data;
                    return jsonData;
                }
            },
            "createdRow": function (row, data, index) {
                var id = data[1];
                $('td', row).eq(0).html('<input type="checkbox" class="form-controls check_upload_penduduk" onchange="show_edit(this);" /> <button onclick="hapus(this)" class="btn btn-xs btn-danger"><i class="fa fa-minus fa-fw"></i> Hapus</button>');
                $('td', row).eq(1).html(index + 1);
                $('td', row).eq(12).html(data[0]);
                $(row).attr({'id': 'upload_' + id, id_upload: id, 'id_provinsi': data[12], 'id_kabupaten': data[13], 'id_kecamatan': data[14], 'id_desa': data[15]});
            }
        });
    }
    function show_edit(elmnt) {
        var jumlah_dicentang = hitung_jumlah_dicentang();
        if (jumlah_dicentang > 0) {
            $('#div_edit_penduduk_1').show();
            edit_penduduk();
        } else {
            $('#div_edit_penduduk_1').hide();
        }
    }
    function check_semua() {
        if (hitung_jumlah_dicentang() > 0) {
            var checks = $('.check_upload_penduduk');
            for (var i = 0, n = checks.length; i < n; i++) {
                var check = $(checks[i]);
                check.prop('checked', false);
                $('#checkbox_check_semua').prop('checked', false);
                $('#div_edit_penduduk_1').hide();
            }
        } else {
            var checks = $('.check_upload_penduduk');
            for (var i = 0, n = checks.length; i < n; i++) {
                var check = $(checks[i]);
                check.prop('checked', true);
                $('#checkbox_check_semua').prop('checked', true);
                $('#div_edit_penduduk_1').show();
                edit_penduduk();
            }
        }
    }
    var last_id_provinsi = 0, last_id_kabupaten = 0, last_id_kecamatan = 0, last_id_desa = 0, init_id_provinsi = 0;
    function edit_penduduk() {
        var checks = $('.check_upload_penduduk');
        var tr = null;
        for (var i = 0, n = checks.length; i < n; i++) {
            var check = $(checks[i]);
            if (check.is(':checked')) {
                tr = check.parent().parent();
                break;
            }
        }
        if (tr == null) {
            return;
        }
        var id_provinsi = tr.attr('id_provinsi');
        var id_kabupaten = tr.attr('id_kabupaten');
        var id_kecamatan = tr.attr('id_kecamatan');
        var id_desa = tr.attr('id_desa');
        var provinsi = $('#select_provinsi');
        //jika drop down provinsi tidak memiliki data

        //jika id provinsi masih belum pernah diedit
        if (id_provinsi == undefined)
            id_provinsi = '';
        if (id_desa == undefined)
            id_desa = '';
        if (id_kecamatan == undefined)
            id_kecamatan = '';
        if (id_kabupaten == undefined)
            id_kabupaten = '';
        last_id_desa = id_desa;
        console.log('dhdgas');
        if (provinsi.children().length < 2) {
            if (init_id_provinsi !== id_provinsi) {
                last_id_provinsi = init_id_provinsi = id_provinsi;
                init_list_provinsi();
                last_id_provinsi = '';
            }
        }
        if (id_provinsi.length > 0) {
            if (last_id_provinsi !== id_provinsi) {
                last_id_provinsi = id_provinsi;
                provinsi_berubah();
            }
            if (id_kabupaten.length > 0) {
                if (last_id_kabupaten !== id_kabupaten) {
                    last_id_kabupaten = id_kabupaten;
                    kabupaten_berubah();
                }
                if (id_kecamatan.length > 0) {
                    if (last_id_kecamatan !== id_kecamatan) {
                        last_id_kecamatan = id_kecamatan;
                        kecamatan_berubah();
                    }
                }
            }
        } else {
            ///console.log('belum ada provinsi');
        }
    }
    function hitung_jumlah_dicentang() {
        var checks = $('.check_upload_penduduk');
        var hasil = 0;
        for (var i = 0, n = checks.length; i < n; i++) {
            var check = $(checks[i]);
            if (check.is(':checked')) {
                hasil++;
            }
        }
        console.log('jumlah dicentang ' + hasil);
        return hasil;
    }
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
    function hapus_semua(){
        $.ajax({
            type: "post",
            url: site_url + '/initial_upload/hapus_semua',
            data: {},
            success: function (data) {
                if (data === 'ok') {
                    tabelHasilUpload.fnDraw();
                } else {
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
</script>
