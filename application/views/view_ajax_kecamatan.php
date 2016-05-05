<select id="kecamatan" name="kecamatan" class="form-control" onchange="initialtable();">
    <option value="0" selected="selected">Semua Kecamatan</option>
    <?php
        if($kecamatan->num_rows()>0)
        {
            foreach ($kecamatan->result() as $val)
            {
                echo "<option value=\"$val->id_kecamatan\">$val->nama_kecamatan</option>";
            }
        }
    ?>
</select>