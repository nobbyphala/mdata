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
class penghasilan extends admin_controller {

    public $data = array('title' => 'Master Penghasilan');

    public function __construct() {
        parent::__construct();
        $this->load->model('master_model');
    }
    function index(){
    	$this->load->view('master/view_penghasilan',$this->data);
    }
    function tambah(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
        $batas_atas = (int)$this->input->post('atas');
        $batas_bawah=(int)$this->input->post('bawah');
    	$res=$this->db->query("insert into master_penghasilan (PENGHASILAN_KODE,PENGHASILAN_NAMA,PENGHASILAN_ATAS,PENGHASILAN_BAWAH) values (?,?,?,?)",array($kode,$nama,$batas_atas,$batas_bawah));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo "Gagal menambah master penghasilan";
    	}
    }
    function edit(){
    	$id=(int)$this->input->post('id');
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
        $batas_atas = (int)$this->input->post('atas');
        $batas_bawah=(int)$this->input->post('bawah');
    	$res=$this->db->query("update master_penghasilan set PENGHASILAN_KODE=?, PENGHASILAN_NAMA=?, PENGHASILAN_ATAS=?, PENGHASILAN_BAWAH=? WHERE PENGHASILAN_ID=?",array($kode,$nama,$batas_atas,$batas_bawah,$id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo "Gagal mengedit master penghasilan";
    	}
    }
    function hapus(){
    	$id=(int)$this->input->post('id');
    	$res=$this->db->query("delete from master_penghasilan WHERE PENGHASILAN_ID=?",array($id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo "Gagal menghapus master penghasilan";
    	}
    }
    function get_list_datatable(){
    	echo json_encode($this->master_model->get_list_penghasilan_datatable($_POST));
    }
}