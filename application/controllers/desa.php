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
 * Description of desa
 *
 * @author mozar
 */
class desa extends admin_controller {

    public $data = array('title' => 'Master Desa');

    public function __construct() {
        parent::__construct();
        $this->load->model('desa_model');
    }
    function index(){
        $this->data['id_kecamatan']=(int)$this->input->get('id_kecamatan');
        $this->data['list_kabupaten']=$this->db->query("select * from master_kabupaten")->result_array();
        $kecamatan=null;
        $this->data['list_kecamatan']=null;
        $q=$this->db->query("select * from master_kecamatan where KECAMATAN_ID=?",array($this->data['id_kecamatan']))->result_array();
        if(count($q)>0){
            $kecamatan=$q[0];
            $this->data['list_kecamatan']=$this->db->query("select * from master_kecamatan where KABUPATEN_ID=?",array($kecamatan['KABUPATEN_ID']))->result_array();
            
        }
        $this->data['kecamatan']=$kecamatan;
        
        $this->load->view('desa/view_desa', $this->data);
    }
    function get_list_desa() {
        echo json_encode($this->db->query("select * from master_desa where KECAMATAN_ID=? order by DESA_KODE, DESA_NAMA", array(intval($this->input->get('id_kecamatan'))))->result_array());
    }
    function get_list_desa_datatable(){
        echo json_encode($this->desa_model->get_list_desa_datatable($_POST));
    }
    function add_desa() {
        $id_kecamatan = intval($this->input->post('id_kecamatan'));
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        
        $res=array('res'=>'fail');
        if($this->desa_model->add_desa($id_kecamatan,$kode,$nama)){
            $res['res']='ok';
        }
        echo json_encode($res);
    }
    function edit(){
        $id=(int)$this->input->post('id');
        $kode=$this->input->post('kode');
        $nama=$this->input->post('nama');
        $id_kecamatan=(int)$this->input->post('id_kecamatan');
        $q=$this->db->query("select * from master_kecamatan where KECAMATAN_ID=?",array($id_kecamatan))->result_array();
        if(count($q)<1){
            echo "Kecamatan untuk desa yang diedit tidak dapat ditemukan";
            exit(0);
        }
        if($this->db->query("update master_desa set DESA_KODE=?, DESA_NAMA=?, KECAMATAN_ID=? WHERE DESA_ID=?",array($kode,$nama,$id_kecamatan,$id))==1){
            echo "ok";
        }else{
            echo "gagal mengupdate desa";
        }
    }
    function hapus(){
        $id=(int)$this->input->post('id');
        if($this->db->query("delete from master_desa where DESA_ID=?",array($id))==1){
            echo 'ok';
        }else{
            echo 'Gagal menghapus data master desa';
        }
    }
}