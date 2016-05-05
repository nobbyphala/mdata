<?php
$this->load->view('page/header');
?>


    <div class="container">
        <div style="margin-top:10px;" class="mainbox col-md-12">                    
            <div class="panel panel-info" >
                <div style="padding-top:20px" class="panel-body">
                    <button type="button" class="btn btn-sm btn-primary ng-scope" onclick="showTambahKecamatan()"><i class="fa fa-plus fa-fw"></i> Tambah Kecamatan</button>
                    <div class="clearfix">
                        <br/>
                    </div>
                    <div class="page-tables">
                        <div class="form-group col-lg-6">
                            <label class="col-lg-3 control-label">Kabupaten</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="select_kabupaten">
                                    <option value="0">Semua Kabupaten</option>
                                    <?php
                                    foreach ($list_kabupaten as $key => $kb) {
                                        echo '<option value="'.$kb['KABUPATEN_ID'].'">'.$kb['KABUPATEN_KODE'].' '.$kb['KABUPATEN_NAMA'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="page-tables">
                        <div class="table-responsive" style="; min-height: 200px;">
                            <table id="tabel_kecamatan" cellpadding="0" cellspacing="1" border="0" width="100%" style="white-space: nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kecamatan</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Kabupaten</th>
                                        <th>Provinsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

<div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Edit Desa</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    
                    <div class="form-group">
                        <label class="log-lg-3 control-label">Kabupaten</label>
                        <div class="col-lg-5">
                            <select class="form-control" id="select_kabupaten_edit">
                            <?php
                            foreach ($list_kabupaten as $key => $kb) {
                                echo '<option value="'.$kb['KABUPATEN_ID'].'">'.$kb['KABUPATEN_KODE'].' '.$kb['KABUPATEN_NAMA'].'</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="log-lg-3 control-label">Kode Kecamatan</label>
                        <div class="col-lg-5">
                            <input type="text" id="kode_kecamatan_edit" placeholder="Kode Kecamatan" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="log-lg-3 control-label">Nama Kecamatan</label>
                        <div class="col-lg-5">
                            <input type="text" id="nama_kecamatan_edit" placeholder="Nama Kecamatan" class="form-control"/>
                        </div>
                    </div>
                    
                </div>
            </div>
            <input type="hidden" id="id_kecamatan_edit" value='0'/>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="simpan_perubahan()" id="">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_hapus" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Hapus Kecamatan</h4>
            </div>
            <div class="modal-body">
                <div id="div_hapus_keterangan"></div>
            </div>
            <input type="hidden" id="id_kecamatan_hapus" value='0'/>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="hapus_kecamatan()" id="">Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_tambah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Tambah Kecamatan</h4>
            </div>
            <div class="modal-body">
                <div class="page-tables">
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Kabupaten</label>
                        <div class="col-lg-8">
                            <select class="form-control" id="select_kabupaten_baru">
                                <?php
                                foreach ($list_kabupaten as $key => $kb) {
                                    echo '<option value="'.$kb['KABUPATEN_ID'].'">'.$kb['KABUPATEN_KODE'].' '.$kb['KABUPATEN_NAMA'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Kode Kecamatan</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="kode_kecamatan_baru"/>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Nama Kecamatan</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="nama_kecamatan_baru"/>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tambah_kecamatan()" id="">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="id_kabupaten_datatable" value="<?= $id_kabupaten ?>"/>
<?php
$this->load->view('page/footer');
?>

<script>
	var tabel_list_kecamatan=null;
	var site_url = '<?= site_url()?>';
    $(document).ready(function () {
        init_kecamatan_datatable();
        $($('.has_sub')[1]).addClass('open');
        $('#select_kabupaten').on('change',function(){
            init_kecamatan_datatable();
        });
    });
    function init_kecamatan_datatable(){
    	if (tabel_list_kecamatan != null) {
            tabel_list_kecamatan.fnDestroy();
        }
        tabel_list_kecamatan = $('#tabel_kecamatan').dataTable({
            "processing": true,
            "serverSide": true,
            order: [[0, "asc"]],
            "columnDefs": [
                {"orderable": false, "targets": 5},
                {"searchable": false, "targets": 5}
            ],
            "ajax": {
                'method': 'post',
                'data': {
                    id_kabupaten:$('#select_kabupaten').val()
                },
                "url": site_url + "/master/kecamatan/get_list_kecamatan_datatable",
                "dataSrc": function (json) {
                    jsonData = json.data;
                    return jsonData;
                }
            },
            "createdRow": function (row, data, index) {
                var id = data[0];
                $('td', row).eq(0).html(index + 1);
                var html = '<div class="btn-group">' +
                        '<button class="btn btn-default btn-xs dropdown-toggle btn-info" data-toggle="dropdown">Aksi <span class="caret"></span></button>' +
                        '<ul class="dropdown-menu">' +
                        '<li><a href="<?= site_url()?>/desa?id_kecamatan=' + id + '"><i class="fa fa-eye fa-fw"></i> Daftar Desa</a></li>';
                
                html += '<li><a href="javascript:showEditDialog('+id+','+index+')"><i class="fa fa-refresh fa-fw"></i> Ubah</a></li>';
                html += '<li><a href="javascript:showDeleteDialog(' + id + ','+index+')"><i class="fa fa-trash-o fa-fw"></i> Hapus</a></li>';
                
                html += '</ul>' +
                        '</div>';
                $('td', row).eq(5).html(html);
                $(row).attr({'id': 'kabupaten_' + id});
            }
        });
    }
    function showEditDialog(id,index){
        $('#modal_edit').modal('show');
        $('#id_kecamatan_edit').val(id);
        var data = tabel_list_kecamatan.fnGetData()[index];
        console.log(data);
        $('#kode_kecamatan_edit').val(data[1]);
        $('#nama_kecamatan_edit').val(data[2]);
    }
    function showDeleteDialog(id,index){
        $('#modal_hapus').modal('show');
        $('#id_kecamatan_hapus').val(id);
        var data = tabel_list_kecamatan.fnGetData()[index];
        $('#div_hapus_keterangan').html('Anda akan menghapus kecamatan '+data[2]+'?');
    }
    function simpan_perubahan(){
        $.ajax({
            type: "post",
            url: site_url + '/kecamatan/edit',
            data: {
                kode:$('#kode_kecamatan_edit').val(),
                nama:$('#nama_kecamatan_edit').val(),
                id:$('#id_kecamatan_edit').val(),
                id_kabupaten:$('#select_kabupaten_edit').val()
            },
            success: function (data) {
                if (data === 'ok') {
                    $('#modal_edit').modal('hide');
                    tabel_list_kecamatan.fnDraw();
                } else {
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function hapus_kecamatan(){
        $.ajax({
            type: "post",
            url: site_url + '/kecamatan/hapus',
            data: {
                id:$('#id_kecamatan_hapus').val()
            },
            success: function (data) {
                if (data === 'ok') {
                    $('#modal_hapus').modal('hide');
                    tabel_list_kecamatan.fnDraw();
                } else {
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function showTambahKecamatan(){
        $('#modal_tambah').modal('show');
    }
    function tambah_kecamatan(){
        $.ajax({
            type: "post",
            url: site_url + '/kecamatan/add_kecamatan',
            data: {
                id_kabupaten:$('#select_kabupaten_baru').val(),
                kode:$('#kode_kecamatan_baru').val(),
                nama:$('#nama_kecamatan_baru').val()
            },
            success: function (data) {
                var json = JSON.parse(data);
                if (json['res'] === 'ok') {
                    $('#modal_tambah').modal('hide');
                    tabel_list_kecamatan.fnDraw();
                } else {
                    alert(json['res']);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
</script>