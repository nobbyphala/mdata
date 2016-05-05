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
 * Description of kabupaten
 *
 * @author mozar
 */
class kabupaten extends admin_controller {

    public $data = array('title' => 'Master Kabupaten');

    public function __construct() {
        parent::__construct();
        $this->load->model(array('kabupaten_model'));
    }

    function index(){
        $this->data['list_provinsi']=$this->db->query("select * from master_provinsi ORDER BY PROVINSI_KODE, PROVINSI_NAMA")->result_array();
        $this->load->view('kabupaten/view_kabupaten', $this->data);
    }

    function get_list_kabupaten() {
        echo json_encode($this->db->query("select * from kabupaten #where PROVINSI_ID=? ORDER BY KABUPATEN_KODE, KABUPATEN_NAMA", array(intval($this->input->get('id_provinsi'))))->result_array());
    }
    function get_list_kabupaten_datatable() {
        echo json_encode($this->kabupaten_model->get_list_kabupaten_datatable($_POST));
    }

    function add_kabupaten() {
        $id_provinsi = $this->input->post('id_provinsi');
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $this->load->model('kabupaten_model');
        if ($this->kabupaten_model->add_kabupaten($id_provinsi, $kode, $nama)) {
            echo json_encode(array('res' => 'ok'));
        } else {
            echo json_encode(array('res' => 'fail'));
        }
    }
    function edit(){
        $id=(int)$this->input->post('id');
        $kode=$this->input->post('kode');
        $nama=$this->input->post('nama');
        if($this->db->query("update master_kabupaten set KABUPATEN_KODE=?, KABUPATEN_NAMA=? WHERE KABUPATEN_ID=?",array($kode,$nama,$id))==1){
            echo 'ok';
        }else{
            echo 'Gagal mengupdate kabupaten';
        }
    }
    function hapus(){
        $id=(int)$this->input->post('id');
        if($this->db->query("delete from master_kabupaten WHERE KABUPATEN_ID=?",array($id))==1){
            echo 'ok';
        }else{
            echo 'Gagal menghapus kabupaten';
        }
    }
}
