<?php
$this->load->view('panen/header');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" style="border-top-left-radius: 0px;border-top-right-radius: 0px;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Pertanian | <?php echo "$jenis_tanaman"?></h2>
                            <br>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <select id="kabupaten" name="kabupaten" class="form-control" onchange="updatekecamatan();initialtable();">
                                <option value="0">Semua Kabupaten</option>
                                <?php
                                if($kabupaten!=NULL)
                                {
                                    foreach ($kabupaten->result() as $val)
                                    {
                                        echo "<option value='$val->id_kabupaten'>$val->nama_kabupaten</option>";
                                    }
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-md-4" id="selkecamatan">
                            <select id="kecamatan" name="kecamatan" class="form-control" onchange="initialtable();">
                                <option value="0" selected="selected">Semua Kecamatan</option>
                            </select>
                        </div>
                        <div class="col-md-4" id="">
                        <select id="tanaman"  class="form-control" onchange="gantitanaman()" >
                            <option>Pilih Jenis Tanaman</option>
                            <option>Padi Sawah</option>
                            <option>Padi Ladang</option>
                            <option>Jagung</option>
                            <option>Ubi Kayu</option>
                            <option>Ubi Jalar</option>
                            <option>Kacang Tanah</option>
                            <option>Kedelai</option>
                            <option>Kacang Hijau</option>
                            <option>Bentul</option>
                        </select>
                    </div>
                    </div>

                    <div class="row" >
                        <div class="col-md-12">
                            <div id="bar"></div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 50px">
                        <div class="col-lg-12" >
                            <?php echo $output ?>
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



<script>
    var chart= Morris.Bar({
        element: 'bar',
        data: [],
        xkey: 'nama_kecamatan',
        ykeys: ['total'],
        labels: [<?php echo "'$jenis_tanaman'"?>]
    });
    function updatekecamatan()
    {
        var x=document.getElementById("kabupaten").value;
        $.ajax({url: "<?php echo site_url('pertanian/getajaxkecamatan')."/";?>"+x.toString(), success: function(result){
            $("#selkecamatan").html(result);
        }});
    }

    function initialtable()
    {
        var x=document.getElementById("kabupaten").value;
        var y=document.getElementById("kecamatan").value;

        $.ajax({url: "<?php echo site_url('pertanian/getdatacoba/')."/".$jenis_tanaman;?>"+"/"+x.toString()+"/"+y.toString(), success: function(result){
            $("#data").html(result);
            $('#example').DataTable();
        }});

        $.getJSON("<?php echo site_url('pertanian/getAjaxPanen')."/";?>" + x.toString() + "/" + y.toString() + "/" + "<?php echo $jenis_tanaman; ?>", function (json) {
            var el=document.getElementById('bar');
            if(json==0)
            {
                el.style.display="none";

            }
            else
            {
                el.style.display="block";
                chart.setData(json);
            }
        });
    }
    $(document).ready(function () {

        $($('.has_sub')[3]).addClass('open');
        updatekecamatan();
        initialtable();
    });
</script>

<script>
    function gantitanaman() {
        var x= document.getElementById('tanaman').value;

        window.location="<?php echo site_url('pertanian/getdatapanendemo').'/'?>"+x;
    }
</script>