<?php
$this->load->view('page/header');
?>

    <div class="container">
        <div style="margin-top:10px;" class="mainbox col-md-12">                    
            <div class="panel panel-info" >

                <div style="padding-top:20px" class="panel-body">
                    <button type="button" class="btn btn-sm btn-primary ng-scope" onclick="showTambahDesa()"><i class="fa fa-plus fa-fw"></i> Tambah Desa</button>
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
                                        $selected='';
                                        if($kb['KABUPATEN_ID']==$kecamatan['KABUPATEN_ID']){
                                            $selected=' selected="" ';
                                        }
                                        echo '<option '.$selected.' value="'.$kb['KABUPATEN_ID'].'">'.$kb['KABUPATEN_KODE'].' '.$kb['KABUPATEN_NAMA'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-lg-3 control-label">Kecamatan</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="select_kecamatan">
                                    <option value="0">Semua Kecamatan</option>
                                    <?php
                                    foreach ($list_kecamatan as $key => $kc) {
                                        $selected='';
                                        if($kc['KECAMATAN_ID']==$kecamatan['KECAMATAN_ID']){
                                            $selected=' selected="" ';
                                        }
                                        echo '<option '.$selected.' value="'.$kc['KECAMATAN_ID'].'">'.$kc['KECAMATAN_KODE'].' '.$kc['KECAMATAN_NAMA'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="page-tables">
                        <div class="table-responsive" style="; min-height: 200px;overflow-x: auto">
                            <table id="tabel_kecamatan" cellpadding="0" cellspacing="1" border="0" width="100%" style="white-space: nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Desa</th>
                                        <th>Nama Desa</th>
                                        <th>Kecamatan</th>
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
<input type="hidden" id="id_kecamatan_datatable" value="<?= $id_kecamatan ?>"/>
<div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Edit Desa</h4>
            </div>
            <div class="modal-body">
                <div class="page-tables">
                    
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Kabupaten</label>
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
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Kecamatan</label>
                        <div class="col-lg-5">
                            <select class="form-control" id="select_kecamatan_edit">
                            <?php
                            foreach ($list_kecamatan as $key => $kc) {
                                echo '<option value="'.$kc['KECAMATAN_ID'].'">'.$kc['KECAMATAN_KODE'].' '.$kc['KECAMATAN_NAMA'].'</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Kode Desa</label>
                        <div class="col-lg-5">
                            <input type="text" id="kode_desa_edit" placeholder="Kode Desa" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Nama Desa</label>
                        <div class="col-lg-5">
                            <input type="text" id="nama_desa_edit" placeholder="Nama Desa" class="form-control"/>
                        </div>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <input type="hidden" id="id_desa_edit" value='0'/>
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
                <h4 class="modal-title" id="judulModal">Hapus Desa</h4>
            </div>
            <div class="modal-body">
                <div id="div_hapus_keterangan"></div>
            </div>
            <input type="hidden" id="id_desa_hapus" value='0'/>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="hapus_desa()" id="">Hapus</button>
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
                                    $selected='';
                                    if($kb['KABUPATEN_ID']==$kecamatan['KABUPATEN_ID']){
                                        $selected=' selected="" ';
                                    }
                                    echo '<option '.$selected.' value="'.$kb['KABUPATEN_ID'].'">'.$kb['KABUPATEN_KODE'].' '.$kb['KABUPATEN_NAMA'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Kecamatan</label>
                        <div class="col-lg-8">
                            <select class="form-control" id="select_kecamatan_baru">
                                <?php
                                foreach ($list_kecamatan as $key => $kc) {
                                    $selected='';
                                    if($kc['KECAMATAN_ID']==$kecamatan['KECAMATAN_ID']){
                                        $selected=' selected="" ';
                                    }
                                    echo '<option '.$selected.' value="'.$kc['KECAMATAN_ID'].'">'.$kc['KECAMATAN_KODE'].' '.$kc['KECAMATAN_NAMA'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Kode Desa</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="kode_desa_baru"/>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 control-label">Nama Desa</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="nama_desa_baru"/>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="tambah_desa()" id="">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('page/footer');
?>

<script>
	var tabel_list_desa=null;
	var site_url = '<?= site_url()?>';
    var base_url='<?= base_url() ?>';
    $(document).ready(function () {
        $($('.has_sub')[1]).addClass('open');
        init_desa_datatable();
        $('#select_kecamatan').on('change',function(){
            init_desa_datatable();
        });
        $('#select_kabupaten').on('change',function(){
            init_desa_datatable();
            reqDataDropdown({
                target_element:'select_kecamatan',
                url:'master/kecamatan/get_list_kecamatan',
                param:{id_kabupaten:this.value},
                initial_text:'Semua Kecamatan',
                ret_array:['KECAMATAN_ID','KECAMATAN_KODE','KECAMATAN_NAMA']
                });
        });
        $('#select_kabupaten_baru').on('change',function(){
            init_desa_datatable();
            reqDataDropdown({
                target_element:'select_kecamatan_baru',
                url:'master/kecamatan/get_list_kecamatan',
                param:{id_kabupaten:this.value},
                ret_array:['KECAMATAN_ID','KECAMATAN_KODE','KECAMATAN_NAMA']
                });
        });
        $('#select_kabupaten_edit').on('change',function(){
            reqDataDropdown({
                target_element:'select_kecamatan_edit',
                url:'master/kecamatan/get_list_kecamatan',
                param:{id_kabupaten:this.value},
                ret_array:['KECAMATAN_ID','KECAMATAN_KODE','KECAMATAN_NAMA'],
                initial_text:'Pilih Kecamatan'
            });
        });
    });
    function init_desa_datatable(){
    	if (tabel_list_desa != null) {
            tabel_list_desa.fnDestroy();
        }
        tabel_list_desa = $('#tabel_kecamatan').dataTable({
            "processing": true,
            "serverSide": true,
            order: [[0, "asc"]],
            "columnDefs": [
                {"orderable": false, "targets": 6},
                {"searchable": false, "targets": 6}
            ],
            "ajax": {
                'method': 'post',
                'data': {
                    id_kecamatan:$('#select_kecamatan').val(),
                    id_kabupaten:$('#select_kabupaten').val()
                },
                "url": site_url + "/master/desa/get_list_desa_datatable",
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
                        '<ul class="dropdown-menu">'                         ;
                
                html += '<li><a href="javascript:showEditDialog('+id+','+index+')"><i class="fa fa-refresh fa-fw"></i> Ubah</a></li>';
                html += '<li><a href="javascript:showDeleteDialog(' + id + ','+index+')"><i class="fa fa-trash-o fa-fw"></i> Hapus</a></li>';
                
                html += '</ul>' +
                        '</div>';
                $('td', row).eq(6).html(html);
                $(row).attr({'id': 'kabupaten_' + id});
            }
        });
    }
    function showEditDialog(id,index){
        $('#modal_edit').modal('show');
        var data=tabel_list_desa.fnGetData()[index];
        console.log(data);
        var id_kabupaten=data[7];
        var id_kecamatan=data[8];
        $('#kode_desa_edit').val(data[1]);
        $('#nama_desa_edit').val(data[2]);
        $('#id_desa_edit').val(data[0]);
        $('#select_kecamatan_edit').val(id_kecamatan);
        $('#select_kabupaten_edit').val(id_kabupaten);
        if($('#select_kabupaten_edit').val()==null){
            reqDataDropdown({
                target_element:'select_kabupaten_edit',
                url:'master/kabupaten/get_list_all_kabupaten',
                param:{},
                ret_array:['KABUPATEN_ID','KABUPATEN_KODE','KABUPATEN_NAMA'],
                initial_text:'Pilih Kabupaten'
            });
        }else if($('#select_kecamatan_edit').val()==null){
            reqDataDropdown({
                target_element:'select_kecamatan_edit',
                url:'master/kecamatan/get_list_kecamatan',
                param:{id_kabupaten:id_kabupaten},
                ret_array:['KECAMATAN_ID','KECAMATAN_KODE','KECAMATAN_NAMA'],
                initial_text:'Pilih Kecamatan'
            });
        }
    }
    function simpan_perubahan(){
        $.ajax({
            type: "post",
            url: site_url + '/desa/edit',
            data: {
                kode:$('#kode_desa_edit').val(),
                nama:$('#nama_desa_edit').val(),
                id:$('#id_desa_edit').val(),
                id_kecamatan:$('#select_kecamatan_edit').val()
            },
            success: function (data) {
                if (data === 'ok') {
                    $('#modal_edit').modal('hide');
                    tabel_list_desa.fnDraw();
                } else {
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
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
                if (d.end_text != undefined && d.end_text.length > 0)
                    targetEl.append($('<option></option>').val('y').html(d.end_text));
                $('.snake_loader').remove();
            }
            , error: function (xhr, ajaxOptions, thrownError) {
                $('.snake_loader').remove();
            }
        });
        if(d.element_reset!=undefined){
        for (var i = 0, n_element_reset = d.element_reset.length; i < n_element_reset; i++) {
            var elmn = document.getElementById(d.element_reset[i]);
            while (elmn.children.length > 1) {
                elmn.children[1].remove();
            }
        }}
    }
    function showTambahDesa(){
        $('#modal_tambah').modal();
    }
    function tambah_desa(){
        $.ajax({
            type: "post",
            url: site_url + '/desa/add_desa',
            data: {
                id_kecamatan:$('#select_kecamatan_baru').val(),
                kode:$('#kode_desa_baru').val(),
                nama:$('#nama_desa_baru').val()
            },
            success: function (data) {
                var json = JSON.parse(data);
                if (json['res'] === 'ok') {
                    $('#modal_tambah').modal('hide');
                    tabel_list_desa.fnDraw();
                } else {
                    alert(json['res']);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    function showDeleteDialog(id,index){
        $('#modal_hapus').modal('show');
        $('#id_desa_hapus').val(id);
        var data=tabel_list_desa.fnGetData()[index];
        $('#div_hapus_keterangan').html('Anda akan menghapus Desa '+data[2]+'?');
    }
    function hapus_desa(){
        $.ajax({
            type: "post",
            url: site_url + '/desa/hapus',
            data: {
                id:$('#id_desa_hapus').val()
            },
            success: function (data) {
                if(data=='ok'){
                    $('#modal_hapus').modal('hide');
                    tabel_list_desa.fnDraw();
                }else{
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
</script>
