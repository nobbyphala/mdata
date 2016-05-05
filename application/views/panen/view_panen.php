<?php
$this->load->view('page/header');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" style="border-top-left-radius: 0px;border-top-right-radius: 0px;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Pertanian | Luas Lahan Panen</h2>
                            <br>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah" style="margin-bottom: 10px;">Tambah Data</button>

                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-lg-4">
                            <select id="kabupaten" name="kabupaten" class="form-control">
                                <option value="0">Semua Kabupaten</option>

                            </select>
                        </div>
                        <div class="col-lg-4">
                            <select id="kecamatan" name="kecamatan" class="form-control">
                                <option value="0">Semua Kecamatan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 50px">
                        <div class="col-lg-12">
                            <table id="example" class="display" cellspacing="0" width="100%">

                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kabupaten</th>
                                    <th>Kecamatan</th>
                                    <th>Luas Panen</th>
                                    <th>Produktivitas</th>
                                    <th>Produksi</th>
                                    <th>Jenis Tanaman</th>
                                    <th>Tahun Data</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kabupaten</th>
                                    <th>Kecamatan</th>
                                    <th>Luas Panen</th>
                                    <th>Produktivitas</th>
                                    <th>Produksi</th>
                                    <th>Jenis Tanaman</th>
                                    <th>Tahun Data</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<iframe id="form_target" name="form_target" style="display:none"></iframe>
<form id="imageupload_form" action="<?php echo base_url()?>/upload/img/" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
    <input name="image" type="file" onchange="$('#imageupload_form').submit();this.value='';">
</form>

<?php
$this->load->view('page/footer');
?>

<!-- Modal -->
<div id="modalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Kabupaten</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url();?>/kecamatan/tambahkecamatan">
                    <div class="form-group">
                        <label for="id_kabupaten">Kabupaten:</label>
                        <select name="id_kabupaten" id="id_kabupaten" class="form-control">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kode_kecamatan">Kode Kecamatan:</label>
                        <input type="text" class="form-control" name="kode_kecamatan" id="kode_kecamatan">
                    </div>
                    <div class="form-group">
                        <label for="nama_kecamatan">Nama Kabupaten:</label>
                        <input type="text" class="form-control" name="nama_kecamatan" id="nama_kecamatan">
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-success">Submit</button>
                    <button type="reset" name="reset" class="btn btn-danger">Resett</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        $($('.has_sub')[0]).addClass('open');
        $('#example').DataTable();
    });
</script>
