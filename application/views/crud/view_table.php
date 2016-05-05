<table id="example" class="display" cellspacing="0" width="100%">

    <thead>
    <tr>
        <?php
          foreach ($column_alias as $val)
          {
              echo "<th>$val</th>";
          }
        ?>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <?php
        foreach ($column_alias as $val)
        {
            echo "<th>$val</th>";
        }
        ?>
    </tr>
    </tfoot>
    <tbody>
    <?php
    if($data!=NULL)
    {
        foreach ($data->result_array() as $val)
        {
            echo "<tr>";
            foreach ($column_name as $key)
            {
                echo "<td>$val[$key]</td>";
            }
            echo "</tr>";
        }
    }
    ?>
    </tbody>
</table>