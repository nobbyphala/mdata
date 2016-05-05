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
 * Description of kecamatan
 *
 * @author mozar
 */
class kecamatan extends admin_controller {

    public $data = array('title' => 'Master Kecamatan');

    public function __construct() {
        parent::__construct();
        $this->load->model(array('kecamatan_model'));
    }

    function index(){
        $this->data['list_kabupaten']=$this->db->query("select * from master_kabupaten ORDER BY KABUPATEN_KODE, KABUPATEN_NAMA")->result_array();
        $this->data['id_kabupaten']=(int)$this->input->get('id_kabupaten');
        $this->load->view('kecamatan/view_kecamatan', $this->data);
    }

    function get_list_kecamatan() {
        echo json_encode($this->db->query("select * from master_kecamatan where KABUPATEN_ID=? ORDER BY KECAMATAN_KODE, KECAMATAN_NAMA", array(intval($this->input->get('id_kabupaten'))))->result_array());
    }

    function get_list_kecamatan_datatable(){
        echo json_encode($this->kecamatan_model->get_list_kecamatan_datatable($_POST));
    }

    function add_kecamatan() {
        $id_kabupaten = intval($this->input->post('id_kabupaten'));
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        
        $res=array('res'=>'fail');
        if ($this->kecamatan_model->add_kecamatan($id_kabupaten, $kode, $nama)) {
            $res['res']='ok';
        }
        echo json_encode($res);
    }
    function edit(){
        $id=(int)$this->input->post('id');
        $kode=$this->input->post('kode');
        $nama=$this->input->post('nama');
        $id_kabupaten=(int)$this->input->post('id_kabupaten');
        $arr=array($kode,$nama,$id_kabupaten,$id);
        $q=$this->db->query("select * from master_kabupaten where KABUPATEN_ID=?",array($id_kabupaten))->result_array();
        if(count($q)<1){
            echo "Kabupaten untuk kecamatan yang diedit tidak dapat ditemukan";
            exit(0);
        }
        if($this->db->query("update master_kecamatan set KECAMATAN_KODE=?, KECAMATAN_NAMA=?, KABUPATEN_ID=? WHERE KECAMATAN_ID=?",$arr)==1){
            echo 'ok';
        }else{
            echo 'Gagal mengupdate data kecamatan';
        }
    }
    function hapus(){
        $id=(int)$this->input->post('id');
        $q=$this->db->query("select * from master_kecamatan where KECAMATAN_ID=?",array($id))->result_array();
        if(count($q)>0){
            $sql="delete from master_kecamatan where KECAMATAN_ID=?";
            if($this->db->query($sql,array($id))==1){
                echo "ok";
            }else{
                echo "Gagal menghapus kecamatan";
            }
        }else{
            echo "Kecamatan tidak dapat ditemukan";
        }
    }
}
