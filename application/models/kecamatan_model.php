<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kecamatan_model
 *
 * @author mozar
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . '/libraries/datatable.php';
class kecamatan_model  extends datatable {
    function add_kecamatan($id_kabupaten, $kode, $nama){
        return $this->db->query("insert into master_kecamatan (KABUPATEN_ID,KECAMATAN_KODE,KECAMATAN_NAMA) values(?,?,?)",array($id_kabupaten,$kode,$nama));
    }
    function get_list_kecamatan_datatable($request){
    	$id_kabupaten=(int)$this->input->post('id_kabupaten');
        $sql = "select kc.*, pr.PROVINSI_KODE, pr.PROVINSI_NAMA, kb.KABUPATEN_NAMA
                from master_kecamatan kc
                inner join master_kabupaten kb
                on kb.KABUPATEN_ID=kc.KABUPATEN_ID
                inner join master_provinsi pr
                on pr.PROVINSI_ID=kb.PROVINSI_ID
                ";
        if($id_kabupaten>0){
    	$sql = "select kc.*, pr.PROVINSI_KODE, pr.PROVINSI_NAMA, kb.KABUPATEN_NAMA
    			from master_kecamatan kc
    			inner join master_kabupaten kb
    			on kb.KABUPATEN_ID=kc.KABUPATEN_ID
    			inner join master_provinsi pr
    			on pr.PROVINSI_ID=kb.PROVINSI_ID
    			where kb.KABUPATEN_ID='$id_kabupaten'
    			";
        }
        $columns = array(
            0=>array('name' => 'KECAMATAN_ID'),
            1=>array('name' => 'KECAMATAN_KODE'),
            2=>array('name' => 'KECAMATAN_NAMA'),
            4=>array('name' => 'PROVINSI_NAMA'),
            3=>array('name' => 'KABUPATEN_NAMA'),
            5=>array('name' => 'PROVINSI_ID'),
            6=>array('name' => 'KABUPATEN_ID')
        );
        return $this->get_datatable($sql, $columns, $request);
    }
}
