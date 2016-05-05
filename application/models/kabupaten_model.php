<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . '/libraries/datatable.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kabupaten_model
 *
 * @author mozar
 */
class kabupaten_model extends datatable {
    function add_kabupaten($id_provinsi,$kode,$nama){
        return $this->db->query("insert into master_kabupaten (PROVINSI_ID,KABUPATEN_KODE,KABUPATEN_NAMA) values (?,?,?)",array($id_provinsi,$kode,$nama));
    }
    function get_list_kabupaten_datatable($request){
    	/*$sql = "select kb.*, pr.PROVINSI_KODE, pr.PROVINSI_NAMA
    			from master_kabupaten kb
    			inner join master_provinsi pr
    			on pr.PROVINSI_ID=kb.PROVINSI_ID";*/

        $sql = "SELECT * FROM kabupaten;";
        $columns = array(
            /*0=>array('name' => 'KABUPATEN_ID'),
            1=>array('name' => 'KABUPATEN_KODE'),
            2=>array('name' => 'KABUPATEN_NAMA'),
            3=>array('name' => 'PROVINSI_NAMA'),
            4=>array('name' => 'PROVINSI_ID')*/
        );

        $columns = array(
            0=>array('name' => 'ID_KABUPATEN'),
            1=>array('name' => 'KODE_KABUPATEN'),
            2=>array('name' => 'NAMA_KABUPATEN')#,
            #3=>array('name' => 'PROVINSI_NAMA'),
            #4=>array('name' => 'PROVINSI_ID')
        );
        return $this->get_datatable($sql, $columns, $request);
    }
}
