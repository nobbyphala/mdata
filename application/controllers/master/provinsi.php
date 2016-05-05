<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/libraries/admin_controller.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of provinsi
 *
 * @author mozar
 */
class provinsi extends admin_controller {

    public $data = array('title' => 'initial upload');

    public function __construct() {
        parent::__construct();
    }

    function get_list_provinsi() {
        echo json_encode($this->db->query("select * from master_provinsi")->result_array());
    }

    function add_provinsi() {
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $this->load->model('provinsi_model');
        if ($this->provinsi_model->add_provinsi($kode, $nama)) {
            echo json_encode(array('res' => 'ok'));
        } else {
            echo json_encode(array('res' => 'fail'));
        }
    }

}
