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
class hamil extends admin_controller {

    public $data = array('title' => 'Master Status Kehamilan');

    public function __construct() {
        parent::__construct();
        $this->load->model('master_model');
    }
    function index(){
    	$this->load->view('master/view_hamil',$this->data);
    }
    function tambah(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
    	$sql="insert into master_hamil (HAMIL_KODE,HAMIL_NAMA) values (?,?)";
    	$res=$this->db->query($sql,array($kode,$nama));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal menambah data master hamil';
    	}
    }
    function hapus(){
    	$id=(int)$this->input->post('id');
    	$sql="delete from master_hamil WHERE HAMIL_ID=?";
    	$res=$this->db->query($sql,array($id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal menghapus data master hamil';
    	}
    }
    function edit(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
    	$id=(int)$this->input->post('id');
    	$sql="update master_hamil set HAMIL_KODE=?, HAMIL_NAMA=? WHERE HAMIL_ID=?";
    	$res=$this->db->query($sql,array($kode,$nama,$id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal mengedit data master hamil';
    	}
    }
    function get_list_datatable(){
    	echo json_encode($this->master_model->get_list_hamil_datatable($_POST));
    }
}