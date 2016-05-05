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

    <?php
    if($res!=NULL)
    {
        $no=0;
        foreach ($res->result() as $val)
        {
            $no++;
            echo "<tr>";
            echo "<td>$no</td>";
            echo "<td>$val->nama_kabupaten</td>";
            echo "<td>$val->nama_kecamatan</td>";
            echo "<td>$val->luas_panen</td>";
            echo "<td>$val->produktivitas</td>";
            echo "<td>$val->produksi</td>";
            echo "<td>$val->jenis_tanaman</td>";
            echo "<td>$val->tahun_data</td>";
            echo "</tr>";
        }
    }
?>
    </tbody>
</table>