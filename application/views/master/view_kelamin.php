<?php
$this->load->view('page/header');
?>


    <div class="container">
        <div style="margin-top:10px;" class="mainbox col-md-12">                    
            <div class="panel panel-info" >
                <div style="padding-top:20px" class="panel-body">
                    <button type="button" class="btn btn-sm btn-primary ng-scope" onclick="showTambahData()"><i class="fa fa-plus fa-fw"></i> Tambah Data</button>
                    <div class="clearfix">
                        <br/>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="page-tables">
                        <div class="table-responsive" style="; min-height: 200px;">
                            <table id="my_datatable" cellpadding="0" cellspacing="1" border="0" width="100%" style="white-space: nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Jenis Kelamin</th>
                                        <th>Nama Jenis Kelamin</th>
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
                <h4 class="modal-title" id="judulModal">Edit Data</h4>
            </div>
            <div class="modal-body">
                <div class="page-tables">
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Kode Jenis Kelamin</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="kode_edit"/>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Nama Jenis Kelamin</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="nama_edit"/>
                        </div>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <input type="hidden" id="id_edit" value='0'/>
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
                <h4 class="modal-title" id="judulModal">Hapus Data</h4>
            </div>
            <div class="modal-body">
                <div id="div_hapus_keterangan"></div>
            </div>
            <input type="hidden" id="id_hapus" value='0'/>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="hapus_data()" id="">Hapus</button>
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
                <h4 class="modal-title" id="judulModal">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="page-tables">
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Kode Jenis Kelamin</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="kode_baru"/>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Nama Jenis Kelamin</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="nama_baru"/>
                        </div>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tambah_data()" id="">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('page/footer');
?>

<script>
	var my_datatable=null;
	var site_url = '<?= site_url()?>';
    $(document).ready(function () {
        init_datatable();
        $($('.has_sub')[1]).addClass('open');
        $('#select_kabupaten').on('change',function(){
            init_datatable();
        });
    });
    function init_datatable(){
    	if (my_datatable != null) {
            my_datatable.fnDestroy();
        }
        my_datatable = $('#my_datatable').dataTable({
            "processing": true,
            "serverSide": true,
            order: [[0, "asc"]],
            "columnDefs": [
                {"orderable": false, "targets": 3},
                {"searchable": false, "targets": 3}
            ],
            "ajax": {
                'method': 'post',
                'data': {
                },
                "url": site_url + "/master/jenis_kelamin/get_list_datatable",
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
                        '<ul class="dropdown-menu">';
                
                html += '<li><a href="javascript:showEditDialog('+id+','+index+')"><i class="fa fa-refresh fa-fw"></i> Ubah</a></li>';
                html += '<li><a href="javascript:showDeleteDialog(' + id + ','+index+')"><i class="fa fa-trash-o fa-fw"></i> Hapus</a></li>';
                
                html += '</ul>' +
                        '</div>';
                $('td', row).eq(3).html(html);
                $(row).attr({'id': 'kabupaten_' + id});
            }
        });
    }
    function showEditDialog(id,index){
        $('#modal_edit').modal('show');
        var data = my_datatable.fnGetData()[index];
        console.log(data);
        $('#kode_edit').val(data[1]);
        $('#nama_edit').val(data[2]);
        $('#id_edit').val(id);
    }
    function showDeleteDialog(id,index){
        $('#modal_hapus').modal('show');
        $('#id_hapus').val(id);
        var data = my_datatable.fnGetData()[index];
        $('#div_hapus_keterangan').html('Anda akan menghapus '+data[2]+'?');
    }
    function simpan_perubahan(){
        $.ajax({
            type: "post",
            url: site_url + '/master/jenis_kelamin/edit',
            data: {
                kode:$('#kode_edit').val(),
                nama:$('#nama_edit').val(),
                id:$('#id_edit').val()
            },
            success: function (data) {
                if (data === 'ok') {
                    $('#modal_edit').modal('hide');
                    my_datatable.fnDraw();
                } else {
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function hapus_data(){
        $.ajax({
            type: "post",
            url: site_url + '/master/jenis_kelamin/hapus',
            data: {
                id:$('#id_hapus').val()
            },
            success: function (data) {
                if (data === 'ok') {
                    $('#modal_hapus').modal('hide');
                    my_datatable.fnDraw();
                } else {
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function showTambahData(){
        $('#modal_tambah').modal('show');
        $('#kode_baru').val('');
        $('#nama_baru').val('');
    }
    function tambah_data(){
        $.ajax({
            type: "post",
            url: site_url + '/master/jenis_kelamin/tambah',
            data: {
                kode:$('#kode_baru').val(),
                nama:$('#nama_baru').val()
            },
            success: function (data) {
                if (data === 'ok') {
                    $('#modal_tambah').modal('hide');
                    my_datatable.fnDraw();
                } else {
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
</script>