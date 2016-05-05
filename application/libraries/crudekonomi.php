<?php

class crudekonomi extends CI_Controller{

    public $config;

    public function exec()
    {

    }

    public function generatetable($column_alias, $column_name)
    {
        $data["column_alias"]=$column_alias;
        $data["column_name"]=$column_name;
        $data["data"]=$this->db->query("SELECT * FROM panen;");

        $this->load->view("crud/view_table",$data);
    }
    
}