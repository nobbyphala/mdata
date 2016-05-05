<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of desa_model
 *
 * @author mozar
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . '/libraries/datatable.php';

class desa_model extends datatable {
    function add_desa($id_kecamatan,$kode,$nama){
        return $this->db->query("insert into master_desa (KECAMATAN_ID,DESA_KODE,DESA_NAMA) values (?,?,?)",array($id_kecamatan,$kode,$nama));
    }
    function get_list_desa_datatable($request){
    	$id_kecamatan=(int)$this->input->post('id_kecamatan');
        $id_kabupaten=(int)$this->input->post('id_kabupaten');
    	$sql = "select ds.*, pr.PROVINSI_KODE, pr.PROVINSI_NAMA, 
                kb.KABUPATEN_NAMA,kc.KECAMATAN_NAMA,pr.PROVINSI_ID,
                kb.KABUPATEN_ID
                from master_desa ds
                inner join master_kecamatan kc
                on kc.KECAMATAN_ID=ds.KECAMATAN_ID
                inner join master_kabupaten kb
                on kb.KABUPATEN_ID=kc.KABUPATEN_ID
                inner join master_provinsi pr
                on pr.PROVINSI_ID=kb.PROVINSI_ID
                    ";
        $sql="select ds.*, ortu.PROVINSI_ID, ortu.PROVINSI_NAMA,
                ortu.KABUPATEN_ID, ortu.KABUPATEN_NAMA, ortu.KECAMATAN_NAMA
                from master_desa ds
                left join (
                    select kc.KECAMATAN_NAMA, kb.KABUPATEN_ID, kb.KABUPATEN_NAMA,
                    pr.PROVINSI_ID, pr.PROVINSI_NAMA, kc.KECAMATAN_ID
                    from master_kecamatan kc
                    inner join master_kabupaten kb
                    on kb.KABUPATEN_ID=kc.KABUPATEN_ID
                    inner join master_provinsi pr
                    on pr.PROVINSI_ID=kb.PROVINSI_ID
                    ) ortu
                on ortu.KECAMATAN_ID=ds.KECAMATAN_ID";
        if($id_kabupaten>0){
            // $sql = "select ds.*, pr.PROVINSI_KODE, pr.PROVINSI_NAMA, 
            //         kb.KABUPATEN_NAMA,kc.KECAMATAN_NAMA,pr.PROVINSI_ID,
            //         kb.KABUPATEN_ID
            //         from master_desa ds
            //         inner join master_kecamatan kc
            //         on kc.KECAMATAN_ID=ds.KECAMATAN_ID
            //         inner  join master_kabupaten kb
            //         on kb.KABUPATEN_ID=kc.KABUPATEN_ID and kb.KABUPATEN_ID='$id_kabupaten'
            //         inner join master_provinsi pr
            //         on pr.PROVINSI_ID=kb.PROVINSI_ID
            //         ";
            $sql="select ds.*, ortu.PROVINSI_ID, ortu.PROVINSI_NAMA,
                ortu.KABUPATEN_ID, ortu.KABUPATEN_NAMA, ortu.KECAMATAN_NAMA
                from master_desa ds
                left join (
                    select kc.KECAMATAN_NAMA, kb.KABUPATEN_ID, kb.KABUPATEN_NAMA,
                    pr.PROVINSI_ID, pr.PROVINSI_NAMA, kc.KECAMATAN_ID
                    from master_kecamatan kc
                    inner join master_kabupaten kb
                    on kb.KABUPATEN_ID=kc.KABUPATEN_ID
                    inner join master_provinsi pr
                    on pr.PROVINSI_ID=kb.PROVINSI_ID
                    where kb.KABUPATEN_ID='$id_kabupaten'
                    ) ortu
                on ortu.KECAMATAN_ID=ds.KECAMATAN_ID";
            if($id_kecamatan>0){
                $sql = "select ds.*, pr.PROVINSI_KODE, pr.PROVINSI_NAMA, 
                        kb.KABUPATEN_NAMA,kc.KECAMATAN_NAMA,pr.PROVINSI_ID,
                        kb.KABUPATEN_ID
                        from master_desa ds
                        inner join master_kecamatan kc
                        on kc.KECAMATAN_ID=ds.KECAMATAN_ID and kc.KECAMATAN_ID='$id_kecamatan'
                        inner join master_kabupaten kb
                        on kb.KABUPATEN_ID=kc.KABUPATEN_ID
                        inner join master_provinsi pr
                        on pr.PROVINSI_ID=kb.PROVINSI_ID
                        
                        ";
            }
        }
        $columns = array(
            0=>array('name' => 'DESA_ID'),
            1=>array('name' => 'DESA_KODE'),
            2=>array('name' => 'DESA_NAMA'),
            3=>array('name' => 'KECAMATAN_NAMA'),
            4=>array('name' => 'KABUPATEN_NAMA'),
            5=>array('name' => 'PROVINSI_NAMA'),
            6=>array('name' => 'PROVINSI_ID'),
            7=>array('name' => 'KABUPATEN_ID'),
            8=>array('name' => 'KECAMATAN_ID')
        );
        return $this->get_datatable($sql, $columns, $request);
    }
}
