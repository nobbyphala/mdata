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
class kawin extends admin_controller {

    public $data = array('title' => 'Master Status Perkawinan');

    public function __construct() {
        parent::__construct();
        $this->load->model('master_model');
    }
    function index(){
    	$this->load->view('master/view_status_perkawinan',$this->data);
    }
    function tambah(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
    	$res=$this->db->query("insert into master_kawin (KAWIN_KODE,KAWIN_NAMA) values (?,?)",array($kode,$nama));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo "Gagal menambah master status perkawinan";
    	}
    }
    function edit(){
    	$id=(int)$this->input->post('id');
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
    	$res=$this->db->query("update master_kawin set KAWIN_KODE=?, KAWIN_NAMA=? WHERE KAWIN_ID=?",array($kode,$nama,$id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo "Gagal mengedit master status perkawinan";
    	}
    }
    function hapus(){
    	$id=(int)$this->input->post('id');
    	$res=$this->db->query("delete from master_kawin WHERE KAWIN_ID=?",array($id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo "Gagal menghapus master status perkawinan";
    	}
    }
    function get_list_datatable(){
    	echo json_encode($this->master_model->get_list_kawin_datatable($_POST));
    }
}