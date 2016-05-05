<?php
$this->load->view('page/header');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" style="border-top-left-radius: 0px;border-top-right-radius: 0px;">
                <div class="panel-body">
                    <h2>Profil Kabupaten</h2>
                    <form action="<?php echo site_url() ?>/dataprofil/simpanprofil/kabupaten" method="post">
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten:</label>
                            <select class="form-control" name="kabupaten" id="kabupaten" onchange="redirect()">
                                <?php
                                    if($list_kabupaten!=NULL)
                                    {
                                        foreach($list_kabupaten as $kabupaten)
                                        {
                                            if($kabupaten->kode_kabupaten==$id_kabupaten){
                                                echo "<option selected value='$kabupaten->kode_kabupaten'>$kabupaten->nama_kabupaten</option>";
                                            }
                                            else
                                                echo "<option value='$kabupaten->kode_kabupaten'>$kabupaten->nama_kabupaten</option>";   
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="profil">Profil:</label>
                            <textarea class="form-control" id="profil" name="profil" rows="6"><?php echo $profil_kabupaten; ?></textarea>

                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="submit" value="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
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
    $(document).ready(function () {
        $($('.has_sub')[0]).addClass('open');
    });
</script>
<script src="<?php echo base_url(); ?>/static/plugin/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({selector: 'textarea#profil',
                 height: '300',
                plugins: "image",
        file_browser_callback: function(field_name, url, type, win) {
            if(type=='image') $('#imageupload_form input').click();
        }
                 });
</script>

<script>
    function redirect()
    {
        var id_kabupaten=document.getElementById("kabupaten").value;
        window.location="<?php echo site_url() ?>/dataprofil/profilkabupaten/"+id_kabupaten;
    }
</script>