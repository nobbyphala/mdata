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
 * Description of provinsi_model
 *
 * @author mozar
 */
class provinsi_model extends datatable {

    function add_provinsi($kode = '', $nama = '') {
        return $this->db->query("insert into master_provinsi(PROVINSI_KODE,PROVINSI_NAMA) values (?,?)", array($kode, $nama));
    }

}
