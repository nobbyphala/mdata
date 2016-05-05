<?php
$this->load->view('page/header');
?>

    <div class="container">
        <div style="margin-top:10px;" class="mainbox col-lg-12">                    
            <div class="panel panel-info" >
                <div style="padding-top:10px" class="panel-body">
                    
                    <div class="clearfix"></div>
                    <div class="page-tables">
                        <div class="col-lg-12" style="" id="chart_container">
                        </div>
                        <div class="clearfix"></div>
                        <div class="table-responsive" style="; min-height: 200px;overflow-x: auto">
                            <table id="tabelPenduduk" cellpadding="0" cellspacing="1" border="0" width="100%" style="white-space: nowrap">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Provinsi</th>
                                        <th>Kabupaten</th>
                                        <th>Kecamatan</th>
                                        <th>Desa</th>
                                        <th>Alamat</th>
                                        <th>NIK</th>
                                        <th>KK</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Usia</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Hubungan Keluarga</th>
                                        <th>Sekolah</th>
                                        <th>Cacat</th>
                                        <th>Hamil</th>
                                        <th>Penghasilan Perbulan</th>
                                        <th>Status Kawin</th>
                                        <th>File Upload</th>
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

<div id="modalHapus" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="judulModal">Hapus Data Penduduk</h4>
            </div>
            <div class="modal-body" id="modal_hapus_body">
                <h2 id="teks_konfirmasi_hapus"></h2>
                <input type="hidden" id="id_penduduk_hapus"/>
                <div id="modal_hapus_keterangan"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="hapus_penduduk()" id="">Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('page/footer');
?>
<script type="text/javascript" src="<?= base_url() ?>static/highchart4.1.9/js/highcharts.js"></script>
<script>
    $(document).ready(function () {
        initTabelPenduduk();
        $($('.has_sub')[1]).addClass('open');

        kabupaten_berubah();
        $('#select_kabupaten').on('change', function () {
            initTabelPenduduk();
            kabupaten_berubah();
        });
        $('#select_kecamatan').on('change', function () {
            initTabelPenduduk();
            kecamatan_berubah();
        });
        $('#select_desa').on('change', function () {
            initTabelPenduduk();
        });
    });
    var base_url = "<?= base_url(); ?>";
    var site_url = "<?= site_url(); ?>";
    function showDeleteDialog(id,index){
        var data= tabel_penduduk.fnGetData()[index];
        $('#modalHapus').modal('show');
        $('#id_penduduk_hapus').val(id);
        $('#modal_hapus_keterangan').html("Anda akan menghapus <br/>"+data[2]+"<br/>Alamat "+data[7]+"<br/>Desa "+data[6]+"<br/>Kecamatan "+data[5]+"<br/>Kabupaten "+data[4]+"<br/>Provinsi "+data[3]);
    }
    function hapus_penduduk(){
        var id=$('#id_penduduk_hapus').val();
        $.ajax({
            type: "post",
            url: site_url + '/master/penduduk/hapus',
            data: {
                id:id
            },
            success: function (data) {
                if (data === 'ok') {
                    $('#modalHapus').modal('hide');
                    tabel_penduduk.fnDraw();
                    init_chart(true);
                } else {
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
    
    function kabupaten_berubah() {
        reqDataDropdown({
            'target_element': 'select_kecamatan',
            'initial_text': 'Semua Kecamatan',
            'end_text': '',
            'url': 'kecamatan/get_list_kecamatan',
            'param': {id_kabupaten: $('#select_kabupaten').val()},
            'ret_array': ['KECAMATAN_ID', 'KECAMATAN_KODE', 'KECAMATAN_NAMA'],
            'selected_value': '',
            'element_reset': ['select_desa']
        });
    }
    function kecamatan_berubah() {
        reqDataDropdown({
            'target_element': 'select_desa',
            'initial_text': 'Semua Desa',
            'end_text': '',
            'url': 'desa/get_list_desa',
            'param': {id_kecamatan: $('#select_kecamatan').val()},
            'ret_array': ['DESA_ID', 'DESA_KODE', 'DESA_NAMA'],
            'selected_value': '',
            'element_reset': []
        });
    }
   
    var tabel_penduduk=null;
    function initTabelPenduduk() {
        if (tabel_penduduk != null) {
            tabel_penduduk.fnDestroy();
        }
        tabel_penduduk = $('#tabelPenduduk').dataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            order: [[1, "asc"]],
            "columnDefs": [
                {"orderable": false, "targets": 0},
                {"searchable": false, "targets": 0}
            ],
            "ajax": {
                'method': 'post',
                'data': {
                    kk:'<?=$no_kk?>'
                },
                "url": site_url + "/master/penduduk/get_list_penduduk_kk_datatable",
                "dataSrc": function (json) {
                    jsonData = json.data;
                    return jsonData;
                }
            },
            "createdRow": function (row, data, index) {
                var id = data[1];
                var html = '<div class="btn-group">' +
                        '<button class="btn btn-default btn-xs dropdown-toggle btn-info" data-toggle="dropdown">Aksi <span class="caret"></span></button>' +
                        '<ul class="dropdown-menu">' +
                        '<li><a href="<?= site_url()?>/master/penduduk/detail?id_penduduk=' + id + '"><i class="fa fa-eye fa-fw"></i> Detail</a></li>';
                
                //html += '<li><a href="<?= site_url()?>/penduduk/edit"><i class="fa fa-refresh fa-fw"></i> Ubah</a></li>';
                //html += '<li><a href="javascript:showDeleteDialog(' + id + ','+index+')"><i class="fa fa-trash-o fa-fw"></i> Hapus</a></li>';
                
                html += '</ul>' +
                        '</div>';
                        $('td', row).eq(18).html(parseFloat(data[18]).formatMoney());
                $('td', row).eq(0).html(html);
                $('td', row).eq(1).html(index + 1);
                $(row).attr({'id': 'penduduk_' + id, id_penduduk: id, 'id_provinsi': data[12], 'id_kabupaten': data[13], 'id_kecamatan': data[14], 'id_desa': data[15]});
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
